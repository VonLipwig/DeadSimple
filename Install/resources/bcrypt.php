<?php
/*
  By Marco Arment <me@marco.org>.
  This code is released in the public domain.

  THERE IS ABSOLUTELY NO WARRANTY.

  Usage example:

  // In a registration or password-change form:
  $hash_for_user = Bcrypt::hash($_POST['password']);

  // In a login form:
  $is_correct = Bcrypt::check($_POST['password'], $stored_hash_for_user);

  // In a login form when migrating entries gradually from a legacy SHA-1 hash:
  $is_correct = Bcrypt::check(
      $_POST['password'], 
      $stored_hash_for_user, 
      function($password, $hash) { return $hash == sha1($password); }
  );
  
  if ($is_correct && Bcrypt::is_legacy_hash($stored_hash_for_user)) {
      $user->store_new_hash(Bcrypt::hash($_POST['password']));
  }

*/

class Bcrypt
{
    const DEFAULT_WORK_FACTOR = 8;

    public static function hash($password, $work_factor = 0)
    {
        if (version_compare(PHP_VERSION, '5.3') < 0) throw new Exception('Bcrypt requires PHP 5.3 or above');

        if ($work_factor < 4 || $work_factor > 31) $work_factor = self::DEFAULT_WORK_FACTOR;
        $salt = 
            '$2a$' . str_pad($work_factor, 2, '0', STR_PAD_LEFT) . '$' .
            substr(
                strtr(base64_encode(self::pseudoRandomKey(16)), '+', '.'), 
                0, 22
            )
        ;
        return crypt($password, $salt);
    }

    public static function check($password, $stored_hash, $legacy_handler = NULL)
    {
        if (version_compare(PHP_VERSION, '5.3') < 0) throw new Exception('Bcrypt requires PHP 5.3 or above');

        if (self::is_legacy_hash($stored_hash)) {
            if ($legacy_handler) return call_user_func($legacy_handler, $password, $stored_hash);
            else throw new Exception('Unsupported hash format');
        }

        return crypt($password, $stored_hash) == $stored_hash;
    }

    public static function pseudoRandomKey($size) {
            if (function_exists('openssl_random_pseudo_bytes')) {
                $rnd = openssl_random_pseudo_bytes($size, $strong);
                if($strong === TRUE) return $rnd;
            }

            $sha=''; $rnd='';
            for ($i=0;$i<$size;$i++) {
                $sha = hash('sha256',$sha.mt_rand());
                $char = mt_rand(0,62);
                $rnd .= chr(hexdec($sha[$char].$sha[$char+1]));
            }

            return $rnd;
    }

    public static function is_legacy_hash($hash) { return substr($hash, 0, 4) != '$2a$'; }
}