<?php
/*
	By Jason Stanley <contact@jasonstanley.co.uk>.
	This code is released in the public domain.

	THERE IS ABSOLUTELY NO WARRANTY.

	Simple Validation Class
 */

class Validation 
{
	// Container for validation rules
	private $_rules = array();

	// Container for validation errors
	private $_errors = array();

	/**
	 * Field => Rules
	 */
	public function check($field, $rules)
	{
		$this->_rules[$field] = $rules;
	}

	/**
	 * Check if the input matches the validation rules.
	 */
	public function run()
	{
		if ( count($this->_rules) == 0)
		{
			exit('No validation rules to validate');
		}

		// Loop through rules and check
		foreach($this->_rules as $field => $rules)
		{
			$this->_parse($field, $rules);
		}

		return count($this->_errors) ? false : true;
	}

	/**
	 * "Notify's" error messages
	 */
	public function notify()
	{
		foreach($this->_errors as $name => $errors)
		{
			foreach($errors as $error)
			{
				Notify::store($error, 'error');
			}
		}
	}

	/**
	 * Explodes rules and checks them.
	 */
	private function _parse($field, $rules)
	{
		$rules = explode('|', $rules);

		foreach($rules as $rule)
		{
			$function = '_'.$rule;

			// Check if rule has a parameter
			if (strpos('.', $rule) !== false)
			{
				$parts = explode('.', $rule);
				$function = '_'.$parts[0];
				$param = $parts[1];

				$this->$function($field, $param);
			}
			else
			{
				$this->$function($field);
			}
		}
	}

	/**
	 * Required
	 */
	private function _required($field)
	{
		if ( ! is_array($_POST[$field]))
		{
			$validates = (trim($_POST[$field]) == '') ? FALSE : TRUE;
		}
		else
		{
			$validates = ( ! empty($_POST[$field]));
		}

		// Set error
		if ( ! $validates)
		{
			$this->_errors[$field]['required'] = "The `$field` field must be filled in.";
		}
	}

	/**
	 * Valid Email
	 */
	private function _email($field)
	{
		$validates = ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST[$field])) ? FALSE : TRUE;
		
		// Set error
		if ( ! $validates)
		{
			$this->_errors[$field]['email'] = "The `$field` field should contain an email address";
		}
	}
}