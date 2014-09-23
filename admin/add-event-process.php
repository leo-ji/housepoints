<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
if(login_check($mysqli) !== true) {
    header("HTTP/1.0 404 Not Found");
    require("../404.php");
    exit;
}

require("../class.php");

if(!isset($_POST['event-name'])){
    header("Location: index.php");
    exit;
}

$styled_event = mysql_real_escape_string($_POST['event-name']);
$auth_user = mysql_real_escape_string($_POST['auth-user']);
$pegasus = mysql_real_escape_string($_POST['pegasus']);
$griffin = mysql_real_escape_string($_POST['griffin']);
$dragon = mysql_real_escape_string($_POST['dragon']);
$phoenix = mysql_real_escape_string($_POST['phoenix']);

if($auth_user == ""){
    $auth_user = "Parry";
}

$event_name = str_replace(' ', '', $styled_event);
$event_name = strtolower($event_name);

if(event_add_points($event_name, $auth_user, $styled_event, $pegasus, $griffin, $dragon, $phoenix, $database)){
    header("Location: index.php?add-event=true");
}else{
    header("Location: index.php?add-event=error");

}

?>