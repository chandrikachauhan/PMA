<?php 
session_start();
date_default_timezone_set("Asia/Kolkata");
include('settings_db.php');
function page_header(){
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            <?php 
                $abc=$_SERVER['REQUEST_URI'];
                echo $abc;
                ?>
        </title>
        <link rel="shortcut icon" type="image/jpg" href="upload_image/logo.gif"/>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
        <link href="css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous"/>
        <link href="css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/morris.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/raphael-min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
<?php } ?>
<?php function page_header_end(){ ?>
    </head>
    <body class="sb-nav-fixed">
<?php } ?>
<?php function navigation(){ 
    ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

            <a class="navbar-brand" href="index.php">Weknow Technologies</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                       <!--  <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a -->
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="logout.php" style="color: red;">Logout&nbsp;&nbsp;&nbsp;<img src="upload_image/exit.png" height="30px" width="30px"></a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon" style="color: white;"><i class="fa fa-tachometer"></i></div>
                                Dashboard
                            </a>
                            <?php 
                             $select_nav = "SELECT * FROM navigation WHERE `parent` IN ('P')";
                                $sql = execute_query($select_nav);
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $row['sno']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row['sno']; ?>" style="cursor: pointer;">
                                <div class="sb-nav-link-icon"><i class="fa <?php echo $row['icon_image'];?>"></i></div>
                               <?php echo $row['link_description']; ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapse<?php echo $row['sno']; ?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php 
                                    if($_SESSION['types']=='admin'){
                                    $sql_p = 'SELECT * FROM `navigation` WHERE `parent`="'.$row['sno'].'"';
                                    $result_p = execute_query($sql_p);
                                    while ($row_p= mysqli_fetch_array($result_p)) {
                                    ?>
                                    <a class="nav-link" href="<?php echo $row_p['hyper_link']; ?>"><?php echo $row_p['link_description']; ?></a>
                                    <?php }}
                                    elseif ($_SESSION['types']=='employee') {
                                         $sql_p = 'SELECT * FROM `navigation` WHERE `parent`="'.$row['sno'].'"';
                                    $result_p = execute_query($sql_p);
                                    while ($row_p= mysqli_fetch_array($result_p)) {
                                        $select_access = "SELECT * FROM user_access WHERE nav_sno='".$row_p['sno']."' AND user_id='".$_SESSION['names']."'";
                                        $user = execute_query($select_access);
                                        if(mysqli_num_rows($user) == 1){
                                    ?>
                                    <a class="nav-link" href="<?php echo $row_p['hyper_link']; ?>"><?php echo $row_p['link_description']; ?></a>
                                    <?php }}
                                     } ?>
                                </nav>
                            </div>
                        <?php  }?>
                          
                             <?php 
                             $select_nav = "SELECT * FROM navigation WHERE `parent` IN ('')";
                                $sql = execute_query($select_nav);
                                while($row = mysqli_fetch_array($sql)){
                            ?>
                            <a class="nav-link" href="<?php echo $row['hyper_link']?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                               <?php 
                               
                                echo $row['link_description'];
                                ?>
                            </a>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Developed by:</div>
                        chandrika chauhan
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
            <?php } ?>
            <?php function page_footer(){ ?>              
                </div>
                </main> 
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class=" text-center"><?php echo date('Y')?>| 
                                <a href="http://www.weknowtech.in/" target="_blank">&nbsp;Developed by Weknow Technologies Pvt. Ltd.</a></div>
                        
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <!-- <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

<?php
     } 
?>