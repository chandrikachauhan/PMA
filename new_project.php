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
if (isset($_GET['del'])) {
    $query = "DELETE FROM allot_project WHERE sno='". $_GET['del']."'";

    if ($db->query($query) === TRUE) {
        //echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }
}
?>
 <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Allotment Modul Report
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                 <th>Employee Name</th>
                                                <th> Assigned Module</th>
                                                <th>Project Name</th>
                                                <th>Start Time</th>
                                                 <th>End Time</th>
                                                 <th>Date</th>
                                                <!-- <th>Edit</th> -->
                                                  <!-- <th>Delete</th> -->


                                            </tr>
                                        </thead>
                                      <!--   <tfoot>
                                            <tr>
                                                <th>Sno</th>
                                                 <th>Employee Name</th>
                                                <th> Assigned Module</th>
                                                <th>Project Name</th>
                                                <th>Start Time</th>
                                                 <th>End Time</th>
                                                 <th>Date</th>

                                                
                                            </tr>
                                        </tfoot> -->
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
                                                <td><?php echo  $emp['emp_name']?></td>
                                                <td><?php echo  $row['module']?></td>
                                                <td><?php echo  $emp_p['project_name']?></td>
                                                <td><?php echo  $row['start_date']?></td>
                                                <td><?php echo  $row['end_date']?></td>
                                                <td><?php echo  date('d-m-Y',strtotime(($row['date'])));?></td>

                                               <!--   <td><a href="allot_module.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td> -->
                                                <!-- <td><a onclick="(confirm('Are you sure'))" href="new_project.php?del=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td> -->
                                               
                                               
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