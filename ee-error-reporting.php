

// EE Error Handling

$eeNoticeEmail = 'emailname@mysite.dude';

$eeDevMode = FALSE; // TRUE = Errors will be displayed. FALSE = Errors are emailed to the notice email address

if($eeDevMode) {
	
	error_reporting (E_ALL ^ E_NOTICE);
	ini_set("log_errors", TRUE);
	ini_set ('display_errors', TRUE);
	ini_set("error_log", "ee-error.log");
	
	$eeError = "Looking for Errors (Love) in all the wrong places... "; // Don't ask...
	trigger_error($eeError, E_USER_ERROR);
	
} else {
	
	// Error handler to email function
	function customError($errnum, $errstr, $errfile, $errline) {
		
		global $eeNoticeEmail; // Get the address to send to
		error_log ('PHP Error\n\n
		[' . $errnum . '] ' . $errstr . '\n\n
		File: ' . $errfile . '\n\n
		Line: ' . $errline, 
		1,
		$eeNoticeEmail, 
		'From: ' . $eeNoticeEmail);
	}
	set_error_handler("customError", E_ALL ^ E_NOTICE); // Set error handler
}
