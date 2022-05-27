<?php 
// error_reporting(0);
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
if(isset($_GET['del_id']))
{
    $del = "DELETE FROM add_project WHERE sno='".$_GET['del_id']."'";
    $dels = execute_query($del);
    if($dels){
}
}
page_header();
page_header_end();
navigation();
?>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Project Report
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            	<th>S.No.</th>
                                                <th>Project Name</th>
                                                <th>Description</th>
                                                <th>Project Type</th>
                                                <th>Start Date</th>
                                                <th>Demo Date</th>
                                                <th>End Date </th>
                                                <th>Upload Date</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        	$i = 1;
                                        	$selected = "SELECT * FROM add_project order by sno DESC";
                                        	$sql = execute_query($selected);
                                        	while($row = mysqli_fetch_array($sql))
                                        	{
                                                $select_type ="SELECT * FROM project_type WHERE sno='".$row['project_type']."'";
                                                $sqls = execute_query($select_type);
                                                $rows = mysqli_fetch_array($sqls);

                                        		?>
                                        		<tr>
                                        		<td><?php echo $i;?></td>
                                        		<td><?php echo $row['project_name'];?></td>
                                                <td><?php echo $row['description'];?></td>
                                        		<td><?php echo $rows['type_name'];?></td>
                                        		<td><?php echo date('d-m-Y',strtotime($row['start_date']));?></td>
                                        		<td><?php echo date('d-m-Y',strtotime($row['demo_date']));?></td>
                                        		<td><?php echo date('d-m-Y',strtotime($row['end_date']));?></td>
                                        		<td><?php echo date('d-m-Y',strtotime($row['create_date']));?></td>
                                        		<td><a href="add_project.php?e_id=<?php echo $row['sno'];?>" class="btn btn-warning">Edit</a></td>
                                        		<td><a onclick="confirm('Are you sure')" href="add_project_report.php?del_id=<?php echo $row['sno'];?>" class="btn btn-danger">Delete</a></td>
                                        	</tr>
                                        		<?php
                                                $i++;
                                        	}
                                        	?>
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php echo page_footer(); ?>
<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>