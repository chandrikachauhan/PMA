<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header('location:login.php');
}
page_header();
page_header_end();
navigation();
$msg = '';
$mg ='';
if(isset($_POST['submit']))
{
	
		if($_POST['message']!='')
		{
			if($_POST['edit_sno']!='')
	    {
	        $data_update = "UPDATE message SET allot_modul_sno='".$_POST['allot_modul_sno']."',emp_name='".$_POST['emp_name']."',edited_by='".$_SESSION['names']."',message='".$_POST['message']."', edited_time='".time()."' WHERE sno='".$_POST['edit_sno']."'";
	        $up = execute_query($data_update);
	        if($up)
	        {
	            $msg.="update is success";
	        }
	        else{
	            $msg.="not success";
	        }
	    }
		else{
		    $inserted = "INSERT INTO message(allot_modul_sno,emp_name,message,created_by,created_time,`date`)VALUES('".$_POST['allot_modul_sno']."','".$_POST['emp_name']."','".$_POST['message']."','".$_SESSION['names']."','".time()."','".date('y-m-d')."')";
			 $sql = execute_query($inserted);
			 if($sql)
			 {
			    $msg.="success";
			 }else{
			 $msg.="not success";
			}
		}
	}
}
if(isset($_GET['id']))
{
    $select_dat = "SELECT * FROM message WHERE sno='".$_GET['id']."'";
    $sql_edit = execute_query($select_dat);
    $fetch_data = mysqli_fetch_array($sql_edit);
}
if(isset($_GET['del']))
{
	$data_del ="DELETE FROM message WHERE sno ='".$_GET['del']."'";
    $sql_del = execute_query($data_del);
    if($sql_del)
    {
    	$mg.="Delete Successfull";
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

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg ">
            <div class="card-header"><?php echo $msg;?><h3 class="text-center font-weight-light ">SEND MESSAGE</h3></div>
                <div class="card-body">
                    <form action="send_message.php" method="post">
                    	<div class="form-row">
                        <div class="col-md-6">              
                        <div class="form-group">
                            <label class="small " for="project_name">Module Name </label>
                            <select class="form-control " name="allot_modul_sno" id="project_name">
                            <?php
                                $sql = "SELECT * FROM  allot_project";
                                $result = $db->query($sql);

                                     while($row = $result->fetch_assoc()) {
                                         echo '<option value="'.$row['sno'].'" ';
                                        if(isset($_GET['id'])){if($fetch_data['allot_modul_sno']==$row['sno']){echo 'selected';}}
                                        echo '>'.$row['module'].'</option>';
                                           }
                            ?>
                          
                            </select>
                        </div>
                  		</div>
                  		  <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="emp_name">Employee Name</label>
                                    <select class="form-control " name="emp_name" id="emp_name" required>
                                    <?php
                                        $query = "SELECT * FROM add_employee";
                                        $res = $db->query($query);

                                         if ($res->num_rows > 0){
                                             while($row_emp = $res->fetch_assoc()) { 
                                                echo '<option value="'.$row_emp['sno'].'" ';
                                                if(isset($_GET['id'])){if($fetch_data['emp_name'] == $row_emp['sno']){echo 'selected';}}
                                                echo '>'.$row_emp['emp_name'].'</option>';
                                                    }
                                                }
                                    ?>
                                  
                                    </select>
                                </div>
                            </div>
                  		</div>
                        <div class="form-row">
                               
                                    <label class="small mb-1" for="module">Message</label>
                                    <textarea required class="form-control " id="module" type="text" placeholder="Write Your Message................" name="message" ><?php if(isset($_GET['id'])){echo $fetch_data['message'];}?></textarea>
                                
                        </div>                                                         
                        <div class="form-group mt-4 mb-0">
                            <input type="hidden" name="edit_sno" value="<?php if(isset($_GET['id'])){echo $fetch_data['sno'];}?>">
                            <input type="submit" class="btn btn-success" name="submit" value="Send">
                        </div>
                    </form>
                </div>
                                  
            </div>
        </div>
    </div>
     <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                YOUR MESSAGE HERE
                                <h3 style="color: green;"><?php echo $mg;?></h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Module Name</th>
                                                <th> Employee Name</th>
                                                <th>Message</th>
                                                <th>Edit</th>
                                                  <th>Delete</th>


                                            </tr>
                                        </thead>
                                     <!--    <tfoot>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Module Name</th>
                                                <th> Employee Name</th>
                                                <th>Message</th>
                                                <th>Edit</th>
                                                  <th>Delete</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM message order by sno DESC";
                                           
                                                  $result = $db->query($sql);

                                                    if ($result->num_rows > 0) {
                                                      // output data of each row
                                                      while($row = $result->fetch_assoc()) { 
                                                        if($row['emp_name'])
                                                        {
                                                            $select_emp = "SELECT * FROM add_employee WHERE sno='".$row['emp_name']."'";
                                                            $result_emp = $db->query($select_emp);
                                                            $emp =$result_emp->fetch_assoc();
                                                        }
                                                        if($row['allot_modul_sno'])
                                                        {
                                                            $select_emp_p = "SELECT * FROM allot_project WHERE sno='".$row['allot_modul_sno']."'";
                                                            $result_emp_p = $db->query($select_emp_p);
                                                            $emp_p =$result_emp_p->fetch_assoc();
                                                        }
                                            ?>
                                            <tr>
                                                <td><img src="upload_image/<?php echo $emp['photo']?>" alt="upload_image<?php echo $emp['photo']?>" style="height:80px;width: 80px; border-radius:50%;"> </td>
                                                <td><?php echo  $emp_p['module']?></td>
                                                <td><?php echo  $emp['emp_name']?></td>
                                                <td><?php echo  $row['message']?></td>
                                                 <td><a href="send_message.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                                <td><a href="send_message.php?del=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td>
                                               
                                               
                                            </tr>
                                          <?php
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