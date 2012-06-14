<?php if ( ! defined('APP_PATH')) exit('Permission Denied');

/**
 * Configure Database Connection
 */
ORM::configure('mysql:host=localhost;dbname=blog');
ORM::configure('username', 'root');
ORM::configure('password', '');