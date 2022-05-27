
<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
page_header();
page_header_end();
navigation();
if(isset($_POST['submit'])){
    if ($_POST['edit_sno']!='') {

         $query = "UPDATE project_type SET 
        type_name='".$_POST['type_name']."',
        edit_by='".$_SESSION['names']."',
        edit_time=now()
       WHERE sno='".$_POST['edit_sno']."'";

  
        if ($db->query($query) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $db->error;
        }

    }
    else{
        $sql = "INSERT INTO project_type (type_name,created_by,created_time) VALUES ('".$_POST['type_name']."','".$_SESSION['names']."',now())";
                        // echo $sql;
        if ($db->query($sql) === TRUE) {
                  //echo "Record deleted successfully";
        }
        else {
            echo "Error deleting record: " . $db->error;
        }
    }
}
?>

<?php
if (isset($_GET['del'])) {
    $del=$_GET['del'];
    //echo $id;
    $query = "DELETE FROM project_type WHERE sno='$del'";

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
                                                
      $s = "SELECT * FROM project_type where sno='$id'";                                       
      $result = $db->query($s);
                                                                                                
      $row_edit = $result->fetch_assoc();  
      }                                    
                                                                                        

      ?>

<div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg ">
                                    <div class="card-header"><h3 class="text-center font-weight-light ">Project Type</h3></div>
                                    <div class="card-body">
                                        <form action="project_type.php" method="post">
                                        
                                        
                                            <div class="form-group">
                                                <label class="small mb-1" for="type">Type</label>
                                                <input class="form-control py-4" id="type" type="text" placeholder="Add New Project" name="type_name"  value="<?php if(isset($_GET['id'])){echo $row_edit['type_name'];}?>"/>
                                            </div>
                                         
                                            
                                            <div class="form-group mt-4 mb-0">
                                                <input type="hidden" name="edit_sno" id="edit_sno" value="<?php if(isset($_GET['id'])){echo $row_edit['sno'];}?>">
                                                <input type="submit" class="btn btn-success" name="submit" value="Add">
                                            </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
  
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Project Type Report
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Type Name</th>
                                                <th>Created By</th>
                                                <th>Created Time</th>
                                                <th>Edited By</th>
                                                <th>Edited Time</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM project_type order by sno DESC";
                                           
                                                  $result = $db->query($sql);

                                                    if ($result->num_rows > 0) {
                                                      // output data of each row
                                                      while($row = $result->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $a;?></td>
                                                <td><?php echo  $row['type_name']?></td>
                                                 <?php 
                                                    $sel_user = "SELECT * FROM user WHERE sno = '".$row['edit_by']."'";
                                                    $sql_user = execute_query($sel_user);
                                                    $row_user = mysqli_fetch_array($sql_user);
                                                ?>
                                                <td><?php echo  $row_user['emp_id']?></td>
                                                <td><?php echo  date('h:i:s A',strtotime($row['created_time']));?></td>
                                                <td><?php echo $row_user['emp_id']?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['edit_time']));?></td>
                                                 <td><a href="project_type.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                                <td><a href="project_type.php?del=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td>
                                               
                                               
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


    <?php echo page_footer(); ?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>