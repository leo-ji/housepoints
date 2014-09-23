<?php

define('PAGE_TITLE', "Add Spirit Event");

require('head.php');


?>
<style type="text/css">
    <?php
    for($i=0; $i<$house_number; $i++){
            $printedstyle = ".coloured." . $everything[$i]['name'] . " {background-color: #" . $everything[$i]['colour'] . ";}
        ";
            print $printedstyle;
            }
    ?>
</style>
<div class="row">
<div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-pencil"></i>
                    <h3 class="box-title">Spirit Points Event Form</h3>
                </div>
                <form action="add-spirit-process.php" method="post" role="form">
                <div class="box-body">
                    <p><i class="fa fa-warning"></i>&nbsp;&nbsp;<strong>Warning:</strong> This form will add spirit points immediately after submission.</p>
                    <div class="form-group">
                        <h3>Event Details</h3>
                        <div class="input-group">
                            <span for="event-name" class="admin-update input-group-addon">Event Name</span><input type="text" maxlength="30" name="event-name" class="form-control" placeholder="Type the name of the event here." required="required"/>
                        </div><br/><div class="input-group">
                            <span for="auth-user" class="admin-update input-group-addon">Organiser Name</span><input type="text" maxlength="30" name="auth-user" class="form-control" placeholder="Type the name of the organiser here. Defaults to 'Parry'."/>
                        </div>
                    </div>
                    <div class="form-group">
                        <h3>Points</h3>
                    <div class="input-group">
                    <span for="update-pegasus" class="admin-update coloured pegasus input-group-addon">Pegasus</span><input type="number" name="pegasus" class="form-control" placeholder="0" min="0" required="required"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="update-griffin" class="admin-update coloured griffin input-group-addon">Griffin</span><input type="number" name="griffin" class="form-control" placeholder="0" min="0" required="required"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="update-dragon" class="admin-update coloured dragon input-group-addon">Dragon</span><input type="number" name="dragon" class="form-control" placeholder="0" min="0" required="required"/>
                    </div><br/>
                    <div class="input-group">
                    <span for="update-phoenix" class="admin-update coloured phoenix input-group-addon">Phoenix</span><input type="number" name="phoenix" class="form-control" placeholder="0" min="0" required="required"/>
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