<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header('location:login.php');
}

page_header();
page_header_end();
navigation();

?>

<?php
$msg ='';
if(isset($_POST['submit'])){
     if($_POST['edit_sno']!='')
    {
        $data_update = "UPDATE project_allotment SET
         project_name='".$_POST['project_name']."',
        project_type='".$_POST['project_type']."',
         description='".$_POST['description']."',
         pmo_name='".$_POST['emp_name']."',
         pmo_contact='".$_POST['pmo_contact']."',
         pmo_email='".$_POST['pmo_email']."',
         starting_date='".$_POST['start_date']."',
         demo_date='".$_POST['demo_date']."',
         end_date='".$_POST['end_date']."',
         edited_by='".$_SESSION['names']."',
         edited_time='".time()."'
          WHERE sno='".$_POST['edit_sno']."'";
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
    $s = "INSERT INTO project_allotment (project_name,project_type,description,pmo_name,pmo_contact,pmo_email,starting_date,demo_date,end_date,created_by,created_time) 
        VALUES ('".$_POST['project_name']."','".$_POST['project_type']."','".$_POST['description']."','".$_POST['emp_name']."','".$_POST['pmo_contact']."','".$_POST['pmo_email']."','".$_POST['start_date']."','".$_POST['demo_date']."','".$_POST['end_date']."','".$_SESSION['names']."','".time()."')";
        // echo $sql;
     if ($db->query($s) === TRUE) {
        echo "Allot Project Successfull";
    } else {
        echo "Error  record: " . $db->error;
    }
}
}

?>

<?php
if (isset($_GET['del'])) {
    $query = "DELETE FROM project_allotment WHERE sno='". $_GET['del']."'";

    if ($db->query($query) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }
}

?>


 <?php
      if(isset($_GET['id']))
     {
       $id=$_GET['id'];
                                                
      $q = "SELECT * FROM project_allotment where sno='$id'";                                       
      $result = $db->query($q);
                                                                                                
      $row_edit = $result->fetch_assoc();  
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
            <div class="card-header"><?php echo $msg;?><h3 class="text-center font-weight-light ">Project Allotment</h3></div>
                <div class="card-body">
                    <form action="allot_project.php" method="post">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="project_name">Select Project   </label>
                                    <select class="form-control " name="project_name" id="project_name">
                                    <?php
                                        $query = "SELECT * FROM add_project";
                                        $res = $db->query($query);

                                         if ($res->num_rows > 0){
                                             while($row_pro = $res->fetch_assoc()) { 
                                                echo '<option value="'.$row_pro['sno'].'" ';
                                                if(isset($_GET['id'])){if($row_edit['project_name'] == $row_pro['sno']){echo 'selected';}}
                                                echo '>'.$row_pro['project_name'].'</option>';
                                                    }
                                                }
                                    ?>
                                  
                                    </select>
                                </div>
                            </div>                
                            <div class="col-md-6">
                                <label class="small mb-1" for="project_type">Project Type </label>
                                    <select class="form-control " name="project_type" id="project_type">
                                        <option value="mini_project" <?php if(isset($_GET['id'])){if($row_edit['project_type'] == 'mini_project'){echo 'selected';}} ?>>Mini Project</option>
                                        <option value="macro_project" <?php if(isset($_GET['id'])){if($row_edit['project_type'] == 'macro_project'){echo 'selected';}} ?>>Macro Project</option>
                                        <option value="marketing" <?php if(isset($_GET['id'])){if($row_edit['project_type'] == 'marketing'){echo 'selected';}} ?>>Marketing</option>
                                    </select>
                                </div>
                        </div>
                         <div class="form-group">
                                <label class="small mb-1" for="description">Project Description</label>
                                <input class="form-control " id="description" type="text" placeholder="Project Description" name="description" value="<?php if(isset($_GET['id'])){echo $row_edit['description'];}?>"/>
                         </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="emp_name">Select PMO   </label>
                                    <select class="form-control " name="emp_name" id="emp_name">
                                    <?php
                                        $query = "SELECT * FROM add_employee";
                                        $res = $db->query($query);

                                         if ($res->num_rows > 0){
                                             while($row_emp = $res->fetch_assoc()) { 
                                                echo '<option value="'.$row_emp['sno'].'" ';
                                                if(isset($_GET['id'])){if($row_edit['pmo_name'] == $row_emp['sno']){echo 'selected';}}
                                                echo '>'.$row_emp['emp_name'].'</option>';
                                                    }
                                                }
                                    ?>
                                  
                                    </select>
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="small mb-1" for="pmo_contact">PMO Contact No.</label>
                                    <input class="form-control " id="pmo_contact" type="text" placeholder="PMO Contact" name="pmo_contact" value="<?php if(isset($_GET['id'])){echo $row_edit['pmo_contact'];}?>"/>
                                </div>
                               
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="pmo_email">PMO Email Id</label>
                                    <input class="form-control " id="pmo_email" type="Email" name="pmo_email" placeholder="PMO Email Id" value="<?php if(isset($_GET['id'])){echo $row_edit['pmo_email'];}?>"/>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="start_date">Start Date</label>
                                    <input class="form-control " id="start_date" type="date" name="start_date" value="<?php if(isset($_GET['id'])){echo $row_edit['starting_date'];}?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="demo_date">Demo Date</label>
                                    <input class="form-control " id="demo_date" type="date" name="demo_date" value="<?php if(isset($_GET['id'])){echo $row_edit['demo_date'];}?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="end_date">End Date</label>
                                    <input class="form-control " id="end_date" type="date" name="end_date"
                                    value="<?php if(isset($_GET['id'])){echo $row_edit['end_date'];}?>"/>
                                </div>
                            </div>
                        </div>
                                         
                                            
                        <div class="form-group mt-4 mb-0">
                            <input type="hidden" name="edit_sno" value="<?php if(isset($_GET['id'])){echo $row_edit['sno'];}?>">
                            <input type="submit" class="btn btn-success" name="submit" value="Save">
                        </div>
                    </form>
                </div>
                                  
            </div>
        </div>
    </div>


   <!--  <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol> -->
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Alloted Project Report
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Project Name</th>
                                                <th> Project Type</th>
                                                 <th> Description</th>
                                                <th>Pmo Name</th>
                                                <th>Pmo Mob.No.</th>
                                                <th>Pmo Email</th>
                                                <th>Starting Date</th>
                                                <th>Demo Date</th>       
                                                 <th>End Date</th>
                                                  <th>Created By</th>
                                                 <th> Created Time</th>
                                                <th>Edit</th>
                                                  <th>Delete</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM project_allotment order by sno DESC";
                                           
                                                  $result = $db->query($sql);

                                                    if ($result->num_rows > 0) {
                                                      // output data of each row
                                                      while($row = $result->fetch_assoc()) { 
                                                          if($row['pmo_name'])
                                                        {
                                                            $select_emp = "SELECT * FROM add_employee WHERE sno='".$row['pmo_name']."'";
                                                            $result_emp = $db->query($select_emp);
                                                            $emp =$result_emp->fetch_assoc();
                                                        }
                                                        if($row['project_name'])
                                                        {
                                                            $select_emp_p = "SELECT * FROM add_project WHERE sno='".$row['project_name']."'";
                                                            $result_emp_p = $db->query($select_emp_p);
                                                            $emp_p =$result_emp_p->fetch_assoc();
                                                        }
                                                     
                                            ?>
                                            <tr>
                                                <td><?php echo $a;?></td>
                                                <td><?php echo  $emp_p['project_name']?></td>
                                                <td><?php echo  $row['project_type']?></td>
                                                <td><?php echo  $row['description']?></td>
                                                <td><?php echo  $emp['emp_name']?></td>
                                                <td><?php echo  $row['pmo_contact']?></td>
                                                <td><?php echo  $row['pmo_email']?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['starting_date']));?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['demo_date']));?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['end_date']));?></td>
                                                <td><?php echo  $emp['emp_name']?></td>
                                                <td><?php echo  date('h:i:s A',$row['created_time']);?></td>
                                                 <td><a href="allot_project.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                                <td><a href="allot_project.php?del=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td>
                                               
                                               
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
                    
                <br>

<?php
page_footer();
?>

<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>