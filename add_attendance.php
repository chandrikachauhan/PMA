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
$date = date('Y-m-d');
$msg ='';
if(isset($_POST['submit']))
{
	$select_att = "SELECT * FROM attendance WHERE emp_id ='".$_SESSION['names']."' and created_time ='".date('Y-m-d')."'";
	$sql_att = execute_query($select_att);
	if(mysqli_num_rows($sql_att)==0)
	{
       
		$select_user = "SELECT * FROM user WHERE sno ='".$_POST['user_sno']."'";
		$sql_user = execute_query($select_user);
		while ($row_user = mysqli_fetch_array($sql_user)) {
		$insert_user = "INSERT INTO attendance(emp_id,emp_name,present,`time`,created_by,created_time) VALUES('".$row_user['sno']."','".$row_user['emp_sno']."','".$_POST['present']."','".time()."','".$_SESSION['names']."','".date('Y-m-d')."')";
            // echo $insert_user;
		  $sql_users = execute_query($insert_user);

			if($sql_users)
			{
				$msg.="Attendance Add Successful";
			}
			else{
				$msg.="Attendance Add Not Successful";
			}
    	}
    }
    else{
       $msg.="<h4 class='text-danger'>Attendance already taken today !!!</h4>";
    }
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
        color: green;
    }
</style>


  <div class="card mb-4">
                            <div class="card-header text-center">
                                <i class="fas fa-table mr-1 "></i>
                                <b>Employee Attendance</b>
                            </div>
                            <div class="card-body">
                                <?php if(!$msg==''){?>
                            	<div class="alert alert-success">
                            		<?php echo $msg;?>
                            	</div>
                            <?php }?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Employee Id</th>
                                                <th>Employee Name</th>
                                                <th> Email</th>
                                                <th>Date</th>
                                                <th>Present</th>
                                                  <th>Add</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM user WHERE sno='".$_SESSION['names']."'";
                                                $result = $db->query($sql);
                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()){      
                                            ?>
                                            <tr>
                                                <form action="add_attendance.php" method="post">
                                                <input type="hidden" name="user_sno" value="<?php echo $row['sno'];?>">
                                                <td><?php echo  $row['emp_id']?></td>
                                                <?php 
                                                $select_emp = "SELECT * FROM add_employee WHERE sno='".$row['emp_sno']."'";
                                                $sql_emp = execute_query($select_emp);
                                                $row_emp = mysqli_fetch_array($sql_emp);


                                                ?>
                                                <td><?php echo  $row_emp['emp_name']?></td>
                                                <td><?php echo  $row_emp['email']?></td>
                                                <td><?php echo  Date('d-m-Y');?></td>                                         <td><input type="checkbox" name="present" value="Present" required></td>
                                                <td><input type="Submit" name="submit" class="btn btn-success" value="Add"></td>
                                               
                                               </form>
                                            </tr>
                                          <?php
                                          $a++;
                                                }
                                            }
                                          ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php
page_footer();
?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable();
} ); 
</script>