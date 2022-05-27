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
        $data_update = "UPDATE allot_project SET project_name='".$_POST['project_name']."',module='".$_POST['module']."',emp_name='".$_POST['emp_name']."',start_date='".$_POST['start_date']."',end_date='".$_POST['end_date']."',edited_by='".$_SESSION['names']."',edited_time='".time()."' WHERE sno='".$_POST['edit_sno']."'";
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
    $s = "INSERT INTO allot_project (project_name,module,emp_name,start_date,end_date,created_by,created_time,`date`) 
        VALUES ('".$_POST['project_name']."','".$_POST['module']."','".$_POST['emp_name']."','".$_POST['start_date']."','".$_POST['end_date']."','".$_SESSION['names']."','".time()."','".date('d-m-Y')."')";
        // echo $sql;
     if ($db->query($s) === TRUE) {
        //succes
        $_POST['submit']='';
    } else {
        echo "Error  record: " . $db->error;
    }
}
}

?>

<?php
if (isset($_GET['del'])) {
    $query = "DELETE FROM allot_project WHERE sno='". $_GET['del']."'";

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
                                                
      $q = "SELECT * FROM allot_project where sno='$id'";                                       
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
            <div class="card-header"><?php echo $msg;?><h3 class="text-center font-weight-light ">Allot Module</h3></div>
                <div class="card-body">
                    <form action="allot_module.php" method="post">
                                        
                        <div class="form-group">
                            <label class="small " for="project_name">Project Name </label>
                            <select class="form-control " name="project_name" id="project_name">
                            <?php
                                $sql = "SELECT * FROM add_project";
                                $result = $db->query($sql);

                                     while($row = $result->fetch_assoc()) {
                                         echo '<option value="'.$row['sno'].'" ';
                                        if(isset($_GET['id'])){if($row_edit['project_name']==$row['sno']){echo 'selected';}}
                                        echo '>'.$row['project_name'].'</option>';
                                                    }
                            ?>
                          
                            </select>
                        </div>
                  
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="module">Assigned Module</label>
                                    <input class="form-control " id="module" type="text" placeholder="Assigned Module" name="module"  value="<?php if(isset($_GET['id'])){echo $row_edit['module'];}?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="emp_name">Select Employee   </label>
                                    <select class="form-control " name="emp_name" id="emp_name">
                                    <?php
                                        $query = "SELECT * FROM add_employee";
                                        $res = $db->query($query);

                                         if ($res->num_rows > 0){
                                             while($row_emp = $res->fetch_assoc()) { 
                                                echo '<option value="'.$row_emp['sno'].'" ';
                                                if(isset($_GET['id'])){if($row_edit['emp_name'] == $row_emp['sno']){echo 'selected';}}
                                                echo '>'.$row_emp['emp_name'].'</option>';
                                                    }
                                                }
                                    ?>
                                  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="start_date">Start Date</label>
                                    <input class="form-control " id="start_date" type="time" name="start_date"  value="<?php if(isset($_GET['id'])){echo $row_edit['start_date'];}?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="end_date">End Date</label>
                                    <input class="form-control " id="end_date" type="time" name="end_date"  value="<?php if(isset($_GET['id'])){echo $row_edit['end_date'];}?>"/>
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
                                Alloted Module Report
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Project Name</th>
                                                <th> Assigned Module</th>
                                                <th>Employee Name</th>
                                                <th>Start Time</th>
                                                 <th>End Time</th>
                                                <th>Edit</th>
                                                  <th>Delete</th>


                                            </tr>
                                        </thead>
                                  
                                        <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM allot_project order by sno DESC";
                                           
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
                                                <td><?php echo  $row['module']?></td>
                                                <td><?php echo  $emp['emp_name']?></td>
                                                <td><?php echo  $row['start_date']?></td>
                                                <td><?php echo  $row['end_date']?></td>
                                                 <td><a href="allot_module.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                                <td><a href="allot_module.php?del=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td>
                                               
                                               
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
 <!-- <?php
                 $sql = 'select * from course order by abs(course_desc)';
                 $res = execute_query($sql);
                while($row = mysqli_fetch_array($res)) {
                  echo '<option value="'.$row['sno'].'" ';
                  if($rows['course_id']==$row['sno']){echo 'selected';}
                  echo '>'.$row['course_desc'].'</option>';
                }
              ?> -->
<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>