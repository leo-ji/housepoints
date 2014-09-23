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

if(!isset($_POST['quick-update-pegasus'])){
    header("Location: index.php");
    exit;
}

$pegasus = mysql_real_escape_string($_POST['quick-update-pegasus']);
$griffin = mysql_real_escape_string($_POST['quick-update-griffin']);
$dragon = mysql_real_escape_string($_POST['quick-update-dragon']);
$phoenix = mysql_real_escape_string($_POST['quick-update-phoenix']);
$auth_user = "Parry";
$event_name = "quickupdate";
$styled_event = "Quick Update (Unspecified)";

if($pegasus == 0 AND $griffin == 0 AND $dragon == 0 AND $phoenix == 0){
    header("Location: index.php?quick-update=nothing");
    exit;
}

if(event_add_points($event_name, $auth_user, $styled_event, $pegasus, $griffin, $dragon, $phoenix, $database)){
    header("Location: index.php?quick-update=true");
}else{
    header("Location: index.php?quick-update=error");

}

?>