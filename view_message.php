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
    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                ALL MESSAGE HERE
                             
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
                                        <!-- <tfoot>
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