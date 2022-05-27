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
$msg='';
$id='';
if(isset($_POST['submit']))
{ 
    if($_POST['access_sno']!='')
    {
        $update_data = "UPDATE user SET emp_sno='".$_POST['user_name']."',password='".$_POST['password']."',type='".$_POST['type']."',edited_by='".$_SESSION['names']."',edited_time='".time('y-m-d h:i:s')."',emp_id='".$_POST['emp_id']."' WHERE sno='".$_POST['edit_sno']."'";
        $data_update = execute_query($update_data);
        $id = mysqli_insert_id($db);
           if($data_update)
          {
            $msg.="Data Update Successfull";
            $del = "DELETE FROM user_access WHERE user_id='".$_POST['edit_sno']."'";
            execute_query($del);
              $sqls = "SELECT * FROM navigation";
                $sql_nav = execute_query($sqls);
             while($nav = mysqli_fetch_array($sql_nav))
            {
                if (isset($_POST['check_'.$nav['sno']])){
                  $insert_user = "INSERT INTO user_access(user_id,nav_sno,edited_by,edition_time)VALUES('".$_POST['edit_sno']."','".$_POST['check_'.$nav['sno']]."','".$_SESSION['names']."','".time('y-m-d h:i:s')."')";
                  $up = execute_query($insert_user);
                }
            }
          }else
          {
            $msg.="Data Update Not Successfull";
          }
    }
    else{
        $insert_data = "INSERT INTO user(emp_sno,password,type,created_by,created_time,emp_id)VALUES('".$_POST['user_name']."','".$_POST['password']."','".$_POST['type']."','".$_SESSION['names']."','".time('y-m-d h:i:s')."','".$_POST['emp_id']."')";
        $data_insert = execute_query($insert_data);
        $id = mysqli_insert_id($db);
           if($data_insert)
          {
            $msg.="Data Inserted Successfull";
          }else
          {
            $msg.="Data Inserted Not Successfull";
          }
        if($id>0)
        {
                $sqls = "SELECT * FROM navigation";
                $sql_nav = execute_query($sqls);
            while($nav = mysqli_fetch_array($sql_nav))
            {
                if (isset($_POST['check_'.$nav['sno']])){
                  $insert_user = "INSERT INTO user_access(user_id,nav_sno,created_by,creation_time)VALUES('".$id."','".$_POST['check_'.$nav['sno']]."','".$_SESSION['names']."','".time('y-m-d h:i:s')."')";
                  $up = execute_query($insert_user);
                }
            }
        }
    }
}
if(isset($_GET['edit']))
{
    $select_edit ="SELECT * FROM user_access";
    $sql_edit = execute_query($select_edit);
    $row_edit = mysqli_fetch_array($sql_edit);
    $pass ="SELECT * FROM user WHERE sno='".$row_edit['user_id']."'";
    $sql_pass = execute_query($pass);
    $row_user_edit = mysqli_fetch_array($sql_pass);
}

?>
<style type="text/css">
  tr{
    font-size: 15px; 
    font-weight: bold;
    text-align: center;
    /*text-transform: uppercase;*/
  }
  tr td input
  {
    height:20px;
    width: 20px;
  }
</style>
  <form action="user_access.php" method="post">
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg ">
            <div class="card-header"><?php echo $msg;?><h3 class="text-center font-weight-light ">USER ACCESS</h3></div>
                <div class="card-body">
                    	<div class="form-row">
                        <div class="col-md-6">              
                        <div class="form-group">
                            <label>Employee Name </label>
                            <select class="form-control" name="user_name" required>
                              <option></option>
                              <?php 
                              $select_user = "SELECT * FROM add_employee";
                              $sql_user = execute_query($select_user);
                              while ($row_user = mysqli_fetch_array($sql_user)) {
                               ?>
                               <option value="<?php echo $row_user['sno'];?>" <?php if(isset($_GET['edit'])){
                                if($row_user_edit['emp_sno']==$row_user['sno']){
                                  echo "selected";
                                }
                               }?>><?php echo $row_user['emp_name']?></option>
                               <?php
                              }
                              ?>
                            </select>
                        </div>
                  		</div>
                  		  <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" mb-1">Employee Password</label>
                            		<input type="password" class="form-control" name="password" placeholder="Enter Employee Password" value="<?php if(isset($_GET['edit'])){echo $row_user_edit['password'];}?>">

                                </div>
                            </div>
                  		</div>
                  		<div class="form-row">
                        <div class="col-md-6">              
                        <div class="form-group">
                            <label class="smalls " for="project_name">Employee Id </label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['edit'])){echo $row_user_edit['emp_id'];}?>" name="emp_id" placeholder="Enter Employee Id">
                        </div>
                  		</div>
                      <div class="col-md-6">              
                        <div class="form-group">
                            <label class="smalls " for="project_name">Type </label>
                            <select class="form-control" name="type">
                              <option></option>
                              <option value="admin"<?php if(isset($_GET['edit'])){if($row_user_edit['type']=="admin"){echo "selected";}}?>>admin</option>
                              <option value="employee" <?php if(isset($_GET['edit'])){if($row_user_edit['type']=="employee"){echo "selected";}}?> >employee</option>
                            </select>
                        </div>
                      </div>
                  		</div>
                
                </div>
                                  
            </div>
        </div>
    </div>

			
             <div class="card mb-4">
                            <div class="card-header">
                              <i class="fas fa-table mr-1"></i>
                               CHOOSE OPTION TO ACCESS USER
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                      <tbody>
                                     <?php 
                            			$select_nav = "SELECT * FROM navigation WHERE `parent` IN ('P')";
                                		$sql = execute_query($select_nav);
                                	while($row = mysqli_fetch_array($sql))
                                    {
                            		?>
                                      	<tr>
	                                      	<td><?php echo $row['link_description']; ?></td>
	                                      	<td></td>
	                                      	<td></td>
	                                    </tr>
	                                      	<?php 
                                    		$sql_p = 'SELECT * FROM `navigation` WHERE `parent`="'.$row['sno'].'"';
                                    		$result_p = execute_query($sql_p);
                                        while ($row_p= mysqli_fetch_array($result_p)) 
                                        {
                                            
                            				?>
                            				<tr>
                            					<td></td>
                            					<td><input type="checkbox" class="checkname" id="sub_sno" class="submit'.$row['sno'].'" name="check_<?php echo $row_p['sno'];?>" value="<?php echo $row_p['sno'];?>" 
                                                    <?php 
                                                    if(isset($_GET['edit'])){
                                                        $select_edit ="SELECT * FROM user_access WHERE `nav_sno`='".$row_p['sno']."' AND `user_id`='".$row_user_edit['sno']."'";
                                                        $sql_edit = execute_query($select_edit);
                                                        echo $select_edit;
                                                        $row_edit = mysqli_fetch_array($sql_edit);
                                                        if(mysqli_num_rows($sql_edit)>0){
                                                            echo "checked";
                                                        }
                                                    }
                                                    ?>></td>
                            					<td><?php echo $row_p['link_description']; ?></td>
                            				</tr>
                                    <?php 
                                        }
                                    }

                                    ?>
                                       <?php 
                                        $select_nav = "SELECT * FROM navigation WHERE `parent` IN ('')";
                                        $sql = execute_query($select_nav);
                                    while($row = mysqli_fetch_array($sql))
                                    {
                                    ?>
                                    <tr>
                                        <td>                                           
                                            <?php echo $row['link_description'];?>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="check_<?php echo $row['sno'];?>" value="<?php echo $row['sno']?>" <?php if(isset($_GET['edit'])){
                                              if($row_edit['nav_sno']==$row['sno']){
                                            echo "checked";}}?>>
                                        </td>
                                        <td></td>
                                    <?php 
                                    } 
                                    ?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                <div class="form-row">
                       <div class="col-md-4"> </div>
              		  <div class="col-md-4">       
                      <input type="hidden" name="edit_sno" value="<?php if(isset($_GET['edit'])){echo $row_user_edit['sno'];}?>">                                                                      
                      <input type="hidden" name="access_sno" value="<?php if(isset($_GET['edit'])){ echo $_GET['edit'];}?>">                                                                      
                        <input type="submit" class="btn btn-success form-control" name="submit" value="Submit">                     </div>
                    <div class="col-md-4"> </div>
                </div>
              </form>
<?php
page_footer();
?>
<script type="text/javascript">
 
</script>