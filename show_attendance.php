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
?>
 <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Attendance Report
                             
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Empoloyee Id</th>
                                                <th> Employee Name</th>
                                                <th>Attendance</th>
                                                <th>Day</th>
                                                <th>Date</th>
                                                  <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $select_att = "SELECT * FROM attendance order by sno desc";
                                           $sql_att = execute_query($select_att);
                                           $date = date('d-m-Y');
                                           $a=1;
                                            while($row_att = mysqli_fetch_array($sql_att))
                                            {
                                           	?>
                                           	<tr>
                                           	<td><?php echo $a;?></td>
                                            <?php 
                                            $select_user = "SELECT * FROM user WHERE sno ='".$row_att['emp_id']."'";
                                            $sql_user = execute_query($select_user);
                                            $row_user = mysqli_fetch_array($sql_user);
                                            ?>
                                           	<td><?php echo $row_user['emp_id'];?></td>
                                           	<?php 
                                                $select_emp = "SELECT * FROM add_employee WHERE sno='".$row_att['emp_name']."'";
                                                $sql_emp = execute_query($select_emp);
                                                $row_emp = mysqli_fetch_array($sql_emp);
                                                ?>
                                                <td><?php echo  $row_emp['emp_name'];?></td>
                                           	<td>
                                           	<?php 
                                           	
                                           		if($date == date('d-m-Y',strtotime($row_att['created_time'])))
                                           		{
                                           			?>
                                          				<b style="color: green;"><?php echo $row_att['present']?></b>
                                          			<?php 
                                          		}
                                          		else{
                                          			?>
                                                  <b><?php echo $row_att['present']?></b>
                                          			<?php
                                          		}
                                          	
                                          		?>
                                           			
                                           		</td>
                                           	<td><?php
                                           	echo date('l',strtotime($row_att['created_time']));?></td>
                                           	<td><?php
                                           	echo date('d-m-Y ',strtotime($row_att['created_time']));?></td>
                                           	<td><?php
                                            echo date('h:i:sa',$row_att['time']);?></td>
                                           	</tr>
                                           	<?php
                                            $a++;
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