<?php

if(isset($_GET['freeze'])){
    if($_GET['freeze']=='nomore'){
        $freezealert = 'nomore';
    }elseif($_GET['freeze']=='yes'){
        $freezealert = 'frozen';
    }
}


if(isset($_GET['add-event'])){
    if($_GET['add-event']=='true'){
        $event_added = "already";
    }elseif($_GET['add-event']=='error'){
        $event_added = "error";
    }
}
if(isset($_GET['quick-update'])){
    if($_GET['quick-update']=='true'){
        $quick_update = "already";
    }elseif($_GET['quick-update']=='error'){
        $quick_update = "error";
    }elseif($_GET['quick-update']=='nothing'){
        $quick_update = 'nothing';
    }
}

define('PAGE_TITLE', "Dashboard");

require('head.php');

?><style type="text/css">
        
.board-house-colour-holder {width: 25px; vertical-align: middle;}

.board-house-colour {width: 25px; height: 25px;
                        -webkit-border-radius: 50%;
                        border-radius: 50%;
                        }
</style>
<div class="row">
    
    <div class="col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-header">
                                    <i class="fa fa-location-arrow"></i>
                                    <h3 class="box-title">Current Standing</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                    <table class="current-standing table">
        <?php
        foreach ($everything as $key => $row) {
            $points[$key] = $row['points'];
            }
        array_multisort($points, SORT_DESC, $everything);
        for($i=0; $i<$house_number; $i++){
            print '<tr class="board-house-standing"><td class="board-house-colour-holder"><div class="board-house-colour coloured ' . $everything[$i]['name'] . '"></div></td><td class="board-house-name ' . $everything[$i]['name'] . '">' . $everything[$i]['styled_name'] . '</td><td class="board-house-points ' . $everything[$i]['name'] . '">' . $everything[$i]['points'] . '</td></tr>';
        }
        ?>
       </table>
            </div>
        </div>
    </div>
    
            
        <div class="col-md-3">
            <?php
                    if(!file_exists("../freeze.txt")){ ?>
            <div class="box box-danger">
                <div class="box-header">
                    <i class="fa fa-lock"></i>
                    <h3 class="box-title">Freeze Updates</h3>
                </div>
                <div class="box-body">
                    <a href="freeze-updates.php"><button class="btn btn-danger btn-flat btn-block">Freeze Updates Now</button></a>
                </div>
                <div class="box-footer">
                    <i class="fa fa-warning"></i> <strong>Warning:</strong> Pressing this button will freeze the current standing board for visitors to the site, and disable the history board for visitors. The administrator console will not be affected.
                </div>
            </div>
            <?php } else { ?>
                <div class="box box-warning">
                <div class="box-header">
                    <i class="fa fa-lock"></i>
                    <h3 class="box-title">Unfreeze Updates</h3>
                </div>
                <div class="box-body">
                    <a href="freeze-updates.php"><button class="btn btn-warning btn-flat btn-block">Unfreeze Updates Now</button></a>
                </div>
                <div class="box-footer">
                    <i class="fa fa-warning"></i> <strong>Warning:</strong> Pressing this button will unfreeze the current standing board for visitors so they can see the latest scores. It will also re-enable the history board for visitors. The administrator console will not be affected.
                </div>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header">
                    <i class="fa fa-question"></i>
                    <h3 class="box-title">Need Help?</h3>
                </div>
                <div class="box-body">
                    <a href="#"><button class="btn btn-primary btn-block disabled">Documentation</button></a>
                    <br/>
                    <a href="mailto:leo.lj.ji@gmail.com"><button class="btn btn-default btn-block">Contact Developer</button></a>
                </div>
                <div class="box-footer">
                    This software application was coded by Leo J. for Jane Parry, Senior Leader, Sha Tin College.
                </div>
            </div>
        </div>
        
</div>

    <div class="row">
                <div class="col-md-6">
                        <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bars"></i>
                                    <h3 class="box-title">House Points Recent Changes</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body board">
                                    <table class="table table-striped">
                                    <tr><th>Event</th><th class="create-timestamp">Time Created</th><th class="auth-user">Organiser</th><th class="coloured pegasus">Pegasus</th><th class="coloured griffin">Griffin</th><th class="coloured dragon">Dragon</th><th class="coloured phoenix">Phoenix</th></tr>
                                        <?php
                                            for($i=0; $i<count($history); $i++){
                                                $printedrow = "<tr><td>" . $history[$i]['styled_event'];
                                                $printedrow .= "</td><td>" . $history[$i]['date_created'];
                                                $printedrow .= "</td><td>" . $history[$i]['auth_user'];
                                                for($j=1; $j<=$house_number; $j++){
                                                    $printedrow .= "</td><td>";
                                                    $thishouse = "house" . $j . "_amount";
                                                    $printedrow .= $history[$i][$thishouse];
                                                }
                                                $printedrow .="</td></tr>";
                                                print $printedrow;
                                            }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                </div>
        <div class="col-md-6">
                        <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bars"></i>
                                    <h3 class="box-title">Spirit Points Recent Changes</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body board">
                                    <table class="table table-striped">
                                    <tr><th>Event</th><th class="create-timestamp">Time Created</th><th class="auth-user">Organiser</th><th class="coloured pegasus">Pegasus</th><th class="coloured griffin">Griffin</th><th class="coloured dragon">Dragon</th><th class="coloured phoenix">Phoenix</th></tr>
                                        <?php
                                            for($i=0; $i<count($spirit_history); $i++){
                                                $printedrow = "<tr><td>" . $spirit_history[$i]['styled_event'];
                                                $printedrow .= "</td><td>" . $spirit_history[$i]['date_created'];
                                                $printedrow .= "</td><td>" . $spirit_history[$i]['auth_user'];
                                                for($j=1; $j<=$house_number; $j++){
                                                    $printedrow .= "</td><td>";
                                                    $thishouse = "house" . $j . "_amount";
                                                    $printedrow .= $spirit_history[$i][$thishouse];
                                                }
                                                $printedrow .="</td></tr>";
                                                print $printedrow;
                                            }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil"></i>
                    <h3 class="box-title">Make a Quick Change</h3>
                </div>
                <form action="quick-update.php" method="post" role="form">
                <div class="box-body">
                    <div class="form-group">
                    <div class="input-group">
                    <span for="quick-update-pegasus" class="admin-quick-update coloured pegasus input-group-addon">Pegasus</span><input type="number" min="0" name="quick-update-pegasus" class="form-control" placeholder="0"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="quick-update-griffin" class="admin-quick-update coloured griffin input-group-addon">Griffin</span><input type="number" min="0" name="quick-update-griffin" class="form-control" placeholder="0"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="quick-update-dragon" class="admin-quick-update coloured dragon input-group-addon">Dragon</span><input type="number" min="0" name="quick-update-dragon" class="form-control" placeholder="0"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="quick-update-phoenix" class="admin-quick-update coloured phoenix input-group-addon">Phoenix</span><input type="number" min="0" name="quick-update-phoenix" class="form-control" placeholder="0"/>
                    </div>
                    </div>
                </div>
                <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>    
            </div>
        </div>
    </div>

<?php

require('foot.php');

?>