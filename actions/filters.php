<?php 

	function mysql_escape($db, $value)
		{

			$filterd = mysqli_real_escape_string($db, $value);
			return $filterd;
		}

	function filter_sring($value)
		{

			$filterd = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			return $filterd;
		}

	function filter_email($value)
		{
			
			$filterd = filter_var($value, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);
			return $filterd;
		}
	function filter_int($value)
		{
			
			$filterd = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
			return $filterd;
		}
	function filter_chars($value)
		{
			
			$filterd = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
			return $filterd;
		}
?>