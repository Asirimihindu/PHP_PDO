<?php
//Start Session
session_start();

//Include Configuration
require_once('config/config.php');

//Helper Function Files
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');

//Autoload Classes

include_once('libraries/Database.php');
include_once('libraries/Template.php');
include_once('libraries/Topic_.php');
include_once('libraries/User.php');
include_once('libraries/Validator.php');


/*
function __autoload($class_name){
	require_once('libraries/'.$class_name . '.php');
}
*/
?>