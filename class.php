<?php

// Calls in the Mysql class plugin. 
include_once('class.MySQL.php');

// Calls in the entire database into a $database object. We'll generally be dealing with this object as we go along.
$database = new MySQL('stc_house_points', 'stc', 'stc', 'localhost');

// This calls all the details about the houses. 
$everything = $database->select('house_meta');

// This counts the number of houses in the system. Eventually, it'll be used to develop this into a flexible multi-house system.
$house_number = count($everything);

// Line called to add details about the house cup.
$history = $database->select('history');

// Line called to add details about the spirit cup.
$spirit_history = $database->select('spirit_history');

// If there's more than one row in the database, then the query returns a two-dimensional array. If there's only one row, then the query returns a one-dimensional array of just that row. Since this wasn't realised during the coding process, the index page and other tables have hard-coded two-dimensional array management in their code. Rather than completely rewrite the code, these two statements check to see if the variable is one-dimensional, and if it is, then turns it into a two-dimensional array.
if (count($history) == count($history, COUNT_RECURSIVE)) {
    $history = array($history);
}

if (count($spirit_history) == count($spirit_history, COUNT_RECURSIVE)) {
    $spirit_history = array($spirit_history);
}

// This function is used to add and manipulate points in the system.
function event_add_points($event, $auth_user, $styled_event, $house1_amount, $house2_amount, $house3_amount, $house4_amount, $database, $which_table = 'history'){
    // This block adds an extra row to the history, which allows a record to be kept. The default value is the main house history table, but calls to edit the spirit cup are considered.
    $insertarray = array(
                         'event' => $event,
                         'auth_user' => $auth_user,
                         'styled_event' => $styled_event,
                         'house1_amount' => $house1_amount,
                         'house2_amount' => $house2_amount,
                         'house3_amount' => $house3_amount,
                         'house4_amount' => $house4_amount,
                         );
    $this_a = $database->insert($which_table, $insertarray);
    
    // This block calls on the current values for each of the houses and adds the respective value to each house. In future developments, this will be expanded so that it can be a flexible multi-house system.
    for($i=1;$i<=count($database->select('house_meta'));$i++){
        $current_points = $database->select('house_meta', array('id'=>$i) ,null,null,null,null,'points');
        $points_now = $current_points['points'];
        switch($i){
            case 1:
                $new_amount = $house1_amount;
                break;
            case 2:
                $new_amount = $house2_amount;
                break;
            case 3:
                $new_amount = $house3_amount;
                break;
            case 4:
                $new_amount = $house4_amount;
                break;
            default:
                break;
        }
        $new_points = $points_now + $new_amount;
        $this_b = $database->update('house_meta', array("points"=>$new_points), array('id'=>$i));
    }
    
    // this verifies if the operation had successfully operated.
    if($this_a && $this_b){
        return true;
    }else{
        return false;
    }
}

?>