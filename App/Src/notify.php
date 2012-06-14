<?php
/*
	By Jason Stanley <contact@jasonstanley.co.uk>.
	This code is released in the public domain.

	THERE IS ABSOLUTELY NO WARRANTY.

	Simple Class to store and display messages between requests.
 */

class Notify 
{

	/**
	 * Save a message to be viewed on the next page load.
	 * First parameter is the message you want to save.
	 * Second parameter is the type of message - this is optional.
	 */
	public static function store($message, $type='notification')
	{
		$_SESSION['notify'][] = array(
			'message'	=> $message,
			'type'		=> $type
		);
	}

	/**
	 * Return an array of all notifications
	 * By default wipes notifications.
	 */
	public static function notifications($save=false)
	{
		$messages = $_SESSION['notify'];

		// Clear Notifications
		if ( ! $save)
		{
			unset($_SESSION['notify']);
		}

		return $messages;
	}

	/**
	 * Return formatted messages. Specify the type to show a type of message
	 */
	public static function formatted($type=false, $save=false)
	{
		$messages = '';
		if (isset($_SESSION['notify']) && is_array($_SESSION['notify']))
		{
			foreach($_SESSION['notify'] as $msg)
			{
				// Store message in a string
				if ($type && $msg['type'] == $type)
				{
					$messages .= '<p class="notify '.$msg['type'].'">' . $msg['message'] . '</p>';
				} elseif ( ! $type) {
					$messages .= '<p class="notify '.$msg['type'].'">' . $msg['message'] . '</p>';
				}

				// Clear notifications
				if ( ! $save)
				{
					unset($_SESSION['notify']);
				}
			}
		}

		return $messages;
	}
}