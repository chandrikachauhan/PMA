<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
page_header();
page_header_end();
navigation();
$msg = '';
if(isset($_POST['submit']))
{
    $select_status ="SELECT * FROM `status` WHERE project_name='".$_POST['project_sno']."'";
        $sql_status = execute_query($select_status);
        $total =0;
        $row_status = mysqli_fetch_array($sql_status);
    $select_s = "SELECT * FROM status  where `project_name`='".$row_status['project_name']."' order by sno desc limit 1";
        $sql_s = execute_query($select_s);
        $row_s =mysqli_fetch_array($sql_s);
        $total = $row_s['work_percentage'] + $_POST['work_percentage'];
    $insert_data = "INSERT INTO status(project_name,work_percentage,complate,created_by,created_time)VALUES('".$_POST['project_sno']."','".$total."','".$_POST['com']."','".$_SESSION['names']."','".date('d-m-Y')."')";
    $sql = execute_query($insert_data);
    if($sql)
    {
        $msg.="Insert Data Successful";
        if($_POST['com'] =="complate")
        {
            $update ="UPDATE add_project set project_status='".$_POST['com']."' WHERE sno='".$_POST['project_sno']."'";
            $sql_p = execute_query($update);
            if($sql_p)
            {
                $msg.="Update successful";
            }
        }

    }
    else{
        echo "not inserted";
    }
    
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
            <div class="card-header"><?php echo $msg;?><h3 class="text-center font-weight-light ">Upload Status</h3></div>
                <div class="card-body">
                    <form action="add_status.php" method="post">
                    	<div class="form-row">
                        <div class="col-md-6">              
                        <div class="form-group">
                            <label class="small " for="project_name">Project Name </label>
                            <select class="form-control " name="project_sno" id="project_name">
                            <?php
                                $sql = "SELECT * FROM  add_project WHERE project_status !='complate'";
                                $result = $db->query($sql);

                                     while($row = $result->fetch_assoc()) {
                                         echo '<option value="'.$row['sno'].'" ';
                                        if(isset($_GET['id'])){if($fetch_data['allot_modul_sno']==$row['sno']){echo 'selected';}}
                                        echo '>'.$row['project_name'].'</option>';
                                           }
                            ?>
                          
                            </select>
                        </div>
                  		</div>
                  		  <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="emp_name">Work Percentage</label>
                                    <input type="number" class="form-control" placeholder="Enter Work Ratio" name="work_percentage" id="emp_name" required>
                                </div>
                            </div>
                  		</div>
                        <div class="form-row">
                        	<div class="col-md-6">
                                    <label class="small mb-1" for="module">Project Complete</label>
                                    <select name="com" class="form-control">
                                    	<option value="not_complate">Not Complete</option>
                                    	<option value="complate">Complete</option>
                                    </select>
                               </div>
                               <!-- <div class="col-md-6">
                                    <label class="small mb-1" for="module">Project Complate</label>
                                    <select name="com" class="form-control">
                                    	<option value="complate">Complate</option>
                                    	<option value="not_complate">Not Complate</option>
                                    </select>
                               </div>  -->     
                        </div>                                                         
                        <div class="form-group mt-4 mb-0">
                            <input type="hidden" name="edit_sno" value="<?php if(isset($_GET['id'])){echo $fetch_data['sno'];}?>">
                            <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        </div>
                    </form>
                </div>
                                  
            </div>
        </div>
    </div>
<?php echo page_footer(); ?>