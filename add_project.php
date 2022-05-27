<?php 
// error_reporting(0);
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
page_header();
page_header_end();
navigation();
if(isset($_POST['submit']))
{
    if($_POST['edit_sno']!='')
    {
        $data_update = "UPDATE add_project SET project_name='".$_POST['project_name']."',project_type='".$_POST['project_type']."',start_date='".$_POST['start_date']."',demo_date='".$_POST['demo_date']."',end_date='".$_POST['end_date']."',edit_by='".$_SESSION['names']."',description='".$_POST['description']."',client_name='".$_POST['client_name']."',number='".$_POST['number']."',email='".$_POST['email']."',address='".$_POST['address']."', edit_time='".time()."' WHERE sno='".$_POST['edit_sno']."'";
        $up = execute_query($data_update);
        if($up)
        {
            echo "update is success";
        }
        else{
            echo "not success";
        }
    }
    else{
     $inserted = "INSERT INTO add_project(project_name,project_type,start_date,demo_date,end_date,description,client_name,`number`,email,address,created_by,created_time,create_date)VALUES('".$_POST['project_name']."','".$_POST['project_type']."','".$_POST['start_date']."','".$_POST['demo_date']."','".$_POST['end_date']."','".$_POST['description']."','".$_POST['client_name']."','".$_POST['number']."','".$_POST['email']."','".$_POST['address']."','".$_SESSION['names']."','".time()."','".date('y-m-d')."')";
 $sql = execute_query($inserted);
 if($sql)
 {
    echo "success";
 }
}
}
if(isset($_GET['e_id']))
{
    $select_dat = "SELECT * FROM add_project WHERE sno='".$_GET['e_id']."'";
    $sql_edit = execute_query($select_dat);
    $fetch_data = mysqli_fetch_array($sql_edit);
}
?>

<style type="text/css">
    label
    {
        font-size: 14px;
    }
     ::placeholder
    {
        font-size: 14px;
      
    }
    option
    {
        font-size: 14px;
    }
</style>

 <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg ">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><b>Add Project</b></h3></div>
                                    <div class="card-body" style="font-size: 16px; font-weight: bold;">
                                        <form action="add_project.php" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Project Name</label>
                                                        <input class="form-control " id="inputFirstName" type="text" placeholder="Enter first Name" name="project_name" value="<?php if(isset($_GET['e_id'])){echo $fetch_data['project_name'];}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Project Type</label>
                                                        <select  class="form-control" name="project_type">
                                                        <?php 
                                                        $selected = "SELECT * FROM project_type";
                                                        $sqls = execute_query($selected);
                                                        while($row = mysqli_fetch_array($sqls))
                                                        {
                                                             echo '<option value="'.$row['sno'].'" ';
                                                            if(isset($_GET['e_id'])){if($row['sno']==$fetch_data['project_type']){echo 'selected';}}
                                                            echo '>'.$row['type_name'].'</option>';
                                                    }
                                                        ?>	
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Name</label>
                                                        <input class="form-control" id="inputPassword" type="text" placeholder="Enter Client Name" name="client_name"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['client_name'];}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Contact Number</label>
                                                        <input class="form-control " id="inputConfirmPassword" type="number" placeholder="Enter Client Contact Number" name="number"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['number'];}?>" />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Email</label>
                                                        <input class="form-control " id="inputPassword" type="email" placeholder="Enter Client Email Id" name="email"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['email'];}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Address</label>
                                                        <input class="form-control " id="inputConfirmPassword" type="text" placeholder="Enter Client Address" name="address"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['address'];}?>" />
                                                    </div>
                                                </div>
                                            </div> <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Start Timing</label>
                                                        <input class="form-control " id="inputPassword" type="date" placeholder="Enter password" name="start_date"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['start_date'];}?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Demo Timing</label>
                                                        <input class="form-control " id="inputConfirmPassword" type="date" placeholder="Confirm password" name="demo_date"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['demo_date'];}?>" />
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">End Time</label>
                                                        <input class="form-control " id="inputPassword" type="date" placeholder="Enter password" name="end_date"  value="<?php if(isset($_GET['e_id'])){echo $fetch_data['end_date'];}?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Description</label>
                                                        <textarea class="form-control " id="inputPassword" type="date" placeholder="Enter Project Description" name="description" ><?php if(isset($_GET['e_id'])){ echo $fetch_data['description'];}?></textarea>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input type="hidden" name="edit_sno"  value="<?php if(isset($_GET['e_id'])){echo $_GET['e_id'];}?>">
                                                <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block"></div>
                                        </form>
                                    </div>
                                   <!--  <div class="card-footer text-center">
                                        <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
<?php
page_footer();

?>