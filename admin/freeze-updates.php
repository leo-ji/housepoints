<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
if(login_check($mysqli) !== true) {
    header("HTTP/1.0 404 Not Found");
    require("../404.php");
    exit;
}

include_once("../class.php");

if(file_exists("../freeze.txt")){
    $frozen = true;
}else{
    $fh = fopen("../freeze.txt", "w") or exit;
}

if($frozen){
    unlink("../freeze.txt");
    header('Location: index.php?freeze=nomore');
    exit;
}

$file_message = date('r');

foreach ($everything as $key => $row) {
            $points[$key] = $row['points'];
            }
        array_multisort($points, SORT_DESC, $everything);

for($j=0; $j<$house_number; $j++){
    $file_message .= "\n";
    $file_message .= $everything[$j]['name'];
    $file_message .= "\n";
    $file_message .= $everything[$j]['styled_name'];
    $file_message .= "\n";
    $file_message .= $everything[$j]['points'];
}

fwrite($fh, $file_message);
fclose($fh);

header('Location: index.php?freeze=yes');

?>