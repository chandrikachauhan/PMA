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

                        <!-- <h1 class="mt-4">Dashboard</h1> -->
                       <!--  <ol class="breadcrumb mb-4 ">
                            <li class="breadcrumb-item active text-center">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        SHOW PROJECT STATUS HERE
                                    </div>
                                  <?php 
                                    $select_sta ="SELECT * FROM `status` group by project_name";
                                    $sql_sta = execute_query($select_sta);
                                    $chart_data = [];
                                    while($row = mysqli_fetch_array($sql_sta))
                                        {
                                            $select_s = "SELECT * FROM status  where `project_name`='".$row['project_name']."' order by sno desc limit 1";
                                            $sql_s = execute_query($select_s);
                                            $row_s =mysqli_fetch_array($sql_s);
                                            $select_p_n ="SELECT * FROM add_project WHERE sno='".$row_s['project_name']."'";
                                            $sql_p_n = execute_query($select_p_n);
                                            $row_p_n =mysqli_fetch_array($sql_p_n);
                                            $chart_data[] = array('year'=>$row_p_n['project_name'],'value'=>(int)$row_s['work_percentage']);
                                        }                                       
                                        
                                    ?>
                                        <div id="chart" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>

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
                                                <th>Sr.No.</th>
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
                                           $select_att = "SELECT * FROM attendance WHERE created_time='".date('Y-m-d')."'";
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
                                                        <b style="color: green;"><?php echo $row_att['present'];?></b>
                                                    <?php 
                                                }
                                                else{
                                                    ?>
                                                        <b style="color:red;">Absent</b>
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
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} ); 
</script>
<script type="text/javascript">
new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: <?php echo json_encode($chart_data);?>,
   // barColors:'Green',
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'],
  barColors: ["green"]
});
</script>