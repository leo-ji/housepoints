<?php
// Include database connection and functions here.  See 3.1.
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start(); 
if(login_check($mysqli) !== true) {
    header("Location: login.php");
    exit;
}


if(file_exists("../freeze.txt")){
    $freezealert = 'frozen';
}

include_once('../class.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SC House Points | <?php print PAGE_TITLE; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        <?php
        for($i=0; $i<$house_number; $i++){
            $printedstyle = ".coloured." . $everything[$i]['name'] . " {background-color: #" . $everything[$i]['colour'] . ";}
        ";
            print $printedstyle;
            }
        ?>
    </style>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
    
            <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                SC Points
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="../">Return to Front Page</a>
                    </li>
                    <li>
                        <a href="includes/logout.php">Log out</a>
                    </li>
                </ul>
            </nav>
        </header>
            <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/<?php print $_SESSION['photo_filename']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php print $_SESSION['styled_name'];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li <?php if(PAGE_TITLE == "Dashboard"){print "class='active'";}?>>
                            <a href="index.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li <?php if(PAGE_TITLE == "Add House Event"){print "class='active'";}?>>
                            <a href="add-event.php">
                                <i class="fa fa-plus"></i> <span>Add House Event</span>
                            </a>
                        </li>
                        <li <?php if(PAGE_TITLE == "Add Spirit Event"){print "class='active'";}?>>
                            <a href="add-spirit-event.php">
                                <i class="fa fa-plus"></i> <span>Add Spirit Event</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php print PAGE_TITLE; ?>
                    </h1>
                    <ol class="breadcrumb">
                        
                        <li><a href="index.php" <?php if(PAGE_TITLE == "Dashboard"){?> class="active"<?php } ?>><i class="fa fa-dashboard"></i> Home</a></li>
                        <?php if(PAGE_TITLE != "Dashboard"){?><li class="active"><?php print PAGE_TITLE; ?></li><?php } ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<?php if($quick_update == "error"){?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-warning alert-dismissable">
        <i class="fa fa-warning"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Error updating the database. Contact the developer to ensure that there has not been data corruption.
    </div>
    </div>
</div>
<?php
} elseif($quick_update == "already") { ?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Quick update successful.
    </div>
    </div>
</div>
<?php }elseif($quick_update=='nothing'){
    ?>
    <div class="row">
    <div class="col-md-12">
    <div class="alert alert-warning alert-dismissable">
        <i class="fa fa-warning"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        No data was input. Please try again.
    </div>
    </div>
</div>
<?php }
if($event_added == "error"){?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-warning alert-dismissable">
        <i class="fa fa-warning"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Error updating the database. Contact the developer to ensure that there has not been data corruption.
    </div>
    </div>
</div>
<?php
} elseif($event_added == "already") { ?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Successfully added new event!
    </div>
    </div>
</div>
<?php }

if($freezealert == "frozen"){?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-warning">
        <i class="fa fa-warning"></i>
        Updates are frozen. Any visitors to this site will not see the latest Current Standing of points, and cannot view the history board. This administrator console is unaffected.
    </div>
    </div>
</div>
<?php
} elseif($freezealert == 'nomore') { ?>
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         Updates are unfrozen. This means that any visitors to the site will be able to see changes made to house points, and can now view the history board. The administrator console continues to be unaffected.
    </div>
    </div>
</div>
<?php } ?>
