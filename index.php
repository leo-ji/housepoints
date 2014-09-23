<?php

include_once('class.php');
if(file_exists("freeze.txt")){
    $update_frozen = true;
    $frozen_text = file_get_contents('freeze.txt');
    $frozen_array = explode("\n", $frozen_text);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sha Tin College House Points</title>
    <link rel="stylesheet" type="text/css" href="base.css" media="all">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen and (min-width: 900px)" />
    <link rel="stylesheet" type="text/css" href="medium.css" media="screen and (max-width: 899px)" />
    <style type="text/css">
        <?php
        for($i=0; $i<$house_number; $i++){
            $printedstyle = ".coloured." . $everything[$i]['name'] . " {background-color: #" . $everything[$i]['colour'] . ";}
        ";
            print $printedstyle;
            }
        if($update_frozen){
            print "body {padding-top: 30px;}";
        }
        ?>
    </style>
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<body>
    
<?php if($update_frozen){?>
<div class="frozen-banner-holder"><div class="frozen-banner"><i class="fa fa-warning"></i> Updates on this site have been temporarily frozen. The points displayed are the situation as of <?php print $frozen_array[0]; ?>. </div></div>
<?php } ?>
<div class="board">
    <table class="current-standing">
        <tr><th colspan="3" class="current-standing">Current Standing</th></tr>
        <?php
        if(!$update_frozen){
        foreach ($everything as $key => $row) {
            $points[$key] = $row['points'];
            }
        array_multisort($points, SORT_DESC, $everything);
        for($i=0; $i<$house_number; $i++){
            print '<tr class="board-house-standing"><td class="board-house-colour-holder"><div class="board-house-colour coloured ' . $everything[$i]['name'        ] . '"></div></td><td class="board-house-name ' . $everything[$i]['name'] . '">' . $everything[$i]['styled_name'] . '</td><td class="board-house-points ' . $everything[$i]['name'] . '">' . $everything[$i]['points'] . '</td></tr>';
        }
        }else{
        for($i=1; $i<count($frozen_array); $i=$i+3){
            print '<tr class="board-house-standing"><td class="board-house-colour-holder"><div class="board-house-colour coloured ' . $frozen_array[$i] . '"></div></td><td class="board-house-name ' . $frozen_array[$i] . '">' . $frozen_array[$i+1] . '</td><td class="board-house-points ' . $$frozen_array[$i] . '">' . $frozen_array[$i+2] . '</td></tr>';
        }
        }
        ?>
       </table>
</div>

<div class="linksto">
        <div class="adminlink-holder"><a href="admin/" class="adminlink">Administrator Interface</a></div>
        <div class="credit-points"><img src="sc-logo-flat.png" class="logo" /></div>
</div>

<div class="house-points-history-holder">
    <?php if(!$update_frozen) { ?>
    <h3 class="points-history-title house-points">House Points</h3>
    
    <table class="house-points-history">
        <thead><tr><th>Event</th><th class="coloured pegasus">Pegasus</th><th class="coloured griffin">Griffin</th><th class="coloured dragon">Dragon</th><th class="coloured phoenix">Phoenix</th></tr></thead><tbody>
        <?php
            for($i=0; $i<count($history); $i++){
                $printedrow = "<tr><td>" . $history[$i]['styled_event'];
                for($j=1; $j<=$house_number; $j++){
                    $printedrow .= "</td><td>";
                    $thishouse = "house" . $j . "_amount";
                    $printedrow .= $history[$i][$thishouse];
                    $this_house_sum[$j] += $history[$i][$thishouse];
                }
                $printedrow .="</td></tr>";
                print $printedrow;
            }
        ?></tbody><tfoot>
        <?php
            print "<tr><td>Total";
            foreach($this_house_sum as $value){
                print "</td><td>";
                print $value;
            }
            print "</td></tr>";
        ?>
        </tfoot>

    </table>
    <?php
    }else{ ?>
    <div class="house-points-history-frozen"><h3>Sorry! Updates have been frozen by this system's administrator. You're going to have to live on the edge without knowing what the recent scores have been.</h3></div>
    <?php } ?>
    </div>
<div class="spirit-points-history-holder">
    <?php if(!$update_frozen) { ?>
    <h3 class="points-history-title spirit-points">Spirit Points</h3>
    <table class="spirit-points-history">
        <thead><tr><th>Event</th><th class="coloured pegasus">Pegasus</th><th class="coloured griffin">Griffin</th><th class="coloured dragon">Dragon</th><th class="coloured phoenix">Phoenix</th></tr></thead><tbody>
        <?php
            for($i=0; $i<count($spirit_history); $i++){
                $printedrow = "<tr><td>" . $spirit_history[$i]['styled_event'];
                for($j=1; $j<=$house_number; $j++){
                    $printedrow .= "</td><td>";
                    $thishouse = "house" . $j . "_amount";
                    $printedrow .= $spirit_history[$i][$thishouse];
                    $this_house_spirit_sum[$j] += $spirit_history[$i][$thishouse];
                }
                $printedrow .="</td></tr>";
                print $printedrow;
            }
            ?></tbody><tfoot>
        <?php
            print "<tr><td>Total";
            foreach($this_house_spirit_sum as $value){
                print "</td><td>";
                print $value;
            }
            print "</td></tr>";
        ?>
        </tfoot>
    </table>
    <?php } ?>
</div>
</body>
</html>
