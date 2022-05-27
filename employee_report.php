<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
page_header();
page_header_end();
navigation();
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  
$sql = "DELETE FROM add_employee WHERE sno='$id'";

if ($db->query($sql) === TRUE) {
  //echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $db->error;
}
}
?>

<style type="text/css">
    thead
    {
        
    }
</style>
    
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    Employee Report
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>Company Name</th>
                            <th>Father's Name</th>
                            <th>Mother's Name</th>
                            <th>Language</th>
                            <th>Contact</th>
                            <th>Designation</th>
                            <th>Aadhar No.</th>
                            <th>Pan No.</th>
                            <th>ESIC No.</th>
                            <th>Account</th>
                            <th>Bank</th>
                            <th>IFSC Code</th>
                            <th>DOB</th>
                            <th>Joining Date</th>
                            <th>Basic Salary</th>
                            <th>Pincode</th>
                            <th>State</th>
                            <th>Address</th>
                            <th>Delete</th>
                            <th>Edit</th>

                        </tr>
                         <tbody>
                                            <?php
                                            $a=1;
                                                $sql = "SELECT * FROM add_employee order by sno DESC";
                                           
                                                  $result = $db->query($sql);

                                                    if ($result->num_rows > 0) {
                                                      while($row = $result->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td><?php echo  $a; ?></td>
                                                <td><?php echo  $row['emp_name']?></td>
                                                <td><?php echo  $row['email']?></td>
                                                <td><?php echo  $row['cmpny_name']?></td>
                                                <td><?php echo  $row['fname']?></td>
                                                <td><?php echo  $row['mname']?></td>
                                                <td><?php echo  $row['language']?></td>
                                                 <td><?php echo  $row['contact']?></td>
                                                <td><?php echo  $row['emp_desi']?></td>
                                                <td><?php echo  $row['adhar']?></td>
                                                <td><?php echo  $row['pan']?></td>
                                                <td><?php echo  $row['esic']?></td>
                                                <td><?php echo  $row['account']?></td>
                                                <td><?php echo  $row['bank']?></td>
                                                <td><?php echo  $row['ifsc']?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['dob']));?></td>
                                                <td><?php echo  date('d-m-Y',strtotime($row['doj']));?></td>
                                                <td><?php echo  $row['basic_salary']?></td>
                                                <td><?php echo  $row['pincode']?></td>
                                                <td><?php echo  $row['state']?></td>
                                                <td><?php echo  $row['address']?></td>
                                                 <td><a href="edit_employee.php?id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                                <td><a href="employee_report.php?id=<?php echo $row['sno'];?>"  class="btn btn-danger">Delete</a></td>
                                               
                                               
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