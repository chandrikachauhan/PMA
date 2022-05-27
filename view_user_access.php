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
$msg ='';
if(isset($_GET['del']))
{
	$delete = "DELETE FROM user_access WHERE sno='".$_GET['del']."'";
	$sql_del = execute_query($delete);
	if($sql_del){
		$msg.="DELETE SUCCESSFULL";
	}
	else{
		$msg.="DELETE NOT SUCCESSFULL";
	}
	
}

?>
    <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
       USER ACCESS REPORT <h5 style="color: red;"><?php echo $msg;?></h5>
     
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.NO.</th>
                        <th>Employee Name</th>
                         <th>Employee Id</th>
                         <th>Employee Email</th>
                         <th>Mobile No.</th>
                        <th>Services</th>
                        <th>Edit</th>
                          <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	$a=1;
                	$select_access = "SELECT * FROM user_access group by user_id";
                	$sql_access = execute_query($select_access);
                	while ($row_access = mysqli_fetch_array($sql_access)) {
                		?>
                		<tr>
                			<td><?php echo $a;?></td>
                			<?php 
                				$sel_user = "SELECT * FROM user WHERE sno = '".$row_access['user_id']."'";
                				$sql_user = execute_query($sel_user);
                				$row_user = mysqli_fetch_array($sql_user);

                				$sel_emp = "SELECT * FROM add_employee WHERE sno = '".$row_user['emp_sno']."'";
                				$sql_emp = execute_query($sel_emp);
                				$row_emp = mysqli_fetch_array($sql_emp);
                			?>
                			<td><?php echo $row_emp['emp_name'];?></td>
                			<td><?php echo $row_user['emp_id'];?></td>
                			<td><?php echo $row_emp['email'];?></td>
                			<td><?php echo $row_emp['contact'];?></td>
                			<td><a class="btn btn-secondary" onClick="create_new_modal('<?php echo 'modal_service'.$row_user['sno'];?>');">Service&nbsp;<span class="fa fa-eye"></span></a></td>
                			<td><a href="user_access.php?edit=<?php echo $row_access['sno'];?>" class="btn btn-warning">Edit</a>
                            <!-- Modal -->
                            <div class="modal fade" id="<?php echo 'modal_service'.$row_user['sno'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">OUR SERVICES</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>SERVICES DETAILES</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                $select_navigation = "SELECT * FROM navigation WHERE `parent` IN('p')";
                                                $sql_navigation = execute_query($select_navigation);
                                                while($row_navigation = mysqli_fetch_array($sql_navigation)){
                                                    
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                <?php 
                                                                    echo $row_navigation['link_description'];
                                                                ?>
                                                            </th>
                                                        </tr>
                                                        <?php 
                                                        $select_navigations = "SELECT * FROM navigation WHERE `parent`='".$row_navigation['sno']."'";
                                                        $sql_navigations = execute_query($select_navigations);
                                                    while($row_navigations = mysqli_fetch_array($sql_navigations)){
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php 
                                                                $select_nav ="SELECT * FROM user_access where `nav_sno`='".$row_navigations['sno']."' AND `user_id`='".$row_user['sno']."'";
                                                                $sql_nav = execute_query($select_nav);
                                                                $row_nav = mysqli_fetch_array($sql_nav);
                                                                if(mysqli_num_rows($sql_nav)==1){
                                                                    echo $row_navigations['link_description']."<b style='color:green;font-size:24px;'>&#10003;</b>";
                                                                }else{
                                                                    echo $row_navigations['link_description']; 
                                                                }?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                <?php
                                                $a++;
                                                }
                                            }
                                            $select_navigation = "SELECT * FROM navigation WHERE `parent` IN('')";
                                                $sql_navigation = execute_query($select_navigation);
                                                while($row_navigation = mysqli_fetch_array($sql_navigation)){
                                        ?>
                                        <body>
                                            <tr>
                                                <td>
                                                                <?php 
                                                                if($row_nav['nav_sno'] == $row_navigation['sno']){
                                                                    echo $row_navigation['link_description']."<b style='color:green;font-size:24px;'>&#10003;</b>";
                                                                }else{
                                                                    echo $row_navigation['link_description'];
                                                                }?>
                                                            </td>
                                            </tr>
                                        </body>
                                    <?php }?>
                                      </table>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            </td>
                			<td><a href="view_user_access.php?del=<?php echo $row_access['sno'];?>" class="btn btn-danger">Delete</a></td>
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
    function create_new_modal(modal_name){
      $('#'+modal_name).modal('show');
    }
</script>