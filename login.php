<!DOCTYPE html>
<?php 
include('scripts/settings_db.php');
session_start();
$msg ='';
if(isset($_SESSION['names']))
{
	header('location:index.php');
}
if(isset($_POST['submit']))
{
  $select = "SELECT * FROM user WHERE emp_id ='".$_POST['name']."' AND password ='".$_POST['password']."'";
  $sql = execute_query($select);
  if(mysqli_num_rows($sql)>0)
  {
  	$row = mysqli_fetch_array($sql);
    $_SESSION['types'] = $row['type'];
  	$_SESSION['names'] = $row['sno'];
  	header('location:index.php');
  }
  else{
  	$msg.="Password Not Match Please Try Again";
  }
}
?>

<style type="text/css">
    ::placeholder
    {
        font-size: 14px;
    }
    
</style>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Weknow Technologies</title>
        <link rel="shortcut icon" type="image/jpg" href="upload_image/logo.gif"/>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <p style="color: red;"> <?php echo $msg;?></p>
                                        <h3 class="text-center font-weight-light"><b>Login</b></h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="login.php" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Employee Id</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter Employee Id"  name="name" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck" style="font-size:14px">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between  mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                               <input type="submit" name="submit" value="Login" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="http://www.weknowtech.in/">Weknow Technologies</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PMA 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                              <a href="http://www.weknowtech.in/">Weknow Technologies</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
