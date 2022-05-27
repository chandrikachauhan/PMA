
<?php 
include('scripts/setting.php');
if(!isset($_SESSION['names']))
{
    header("location:login.php");
}
$id='';
page_header();
page_header_end();
navigation();
if(isset($_POST['submit'])){
    $lon = implode(",",$_POST['language']);
        $sql = "INSERT INTO add_employee (emp_name, fname, mname,cmpny_name,contact,emp_desi,adhar,pan,esic,account,bank,ifsc,dob,doj,basic_salary,state,pincode,address,created_by,create_time,qualification,email,experties,specialist,language) 
        VALUES ('".$_POST['emp_name']."','".$_POST['fname']."','".$_POST['mname']."','".$_POST['company']."','".$_POST['contact']."','".$_POST['emp_desi']."','".$_POST['adhar']."','".$_POST['pan']."','".$_POST['esic']."','".$_POST['account']."','".$_POST['bank']."','".$_POST['ifsc']."','".$_POST['dob']."','".$_POST['doj']."','".$_POST['basic_salary']."','".$_POST['state']."','".$_POST['pincode']."','".$_POST['address']."','".$_SESSION['names']."','".time()."','".$_POST['qualification']."','".$_POST['email']."','".$_POST['experties']."','".$_POST['specialist']."','".$lon."')";
        $sqls = execute_query($sql);
        $id = mysqli_insert_id($db);
        if($sqls)
        {
            echo "<p style='color:green'>Add Employee Successfull</p>";
        }
        else{
            echo "Not Success";
        }
        if ($id!='') {
    if($_FILES['file']['name']==''){                                
        $newfilename='';
    }
    elseif($_FILES['file']['name']!=''){
    $allowed =  array('gif','png' ,'jpg', 'jpeg' , 'pdf', 'JPG');
    $filename = $_FILES['file']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
        $msg_photo = '<div class="alert alert-danger">Invalid Image.</div>';
    }
    else{
        $temp = explode(".", $_FILES["file"]["name"]);
        $newfilename = $id.'.'. end($temp); 
        $updates = "UPDATE add_employee SET photo ='$newfilename' where sno='$id'";
       execute_query($updates);
        if(move_uploaded_file($_FILES["file"]["tmp_name"], "upload_image/".$newfilename)){
        
        }
        else{
            $msg_photo ='<h5>Upload Failed.</h5>';
            
        }
    }
}
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
        
    }
</style>

<div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-lg ">
                <div class="card-header">
                    <h3 class="text-center font-weight-light ">Employee Details</h3></div>
                        <div class="card-body">
                            <form action="add_employee.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                                <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class=" mb-1" for="empname">Employee Name</label>
                                                        <input class="form-control " id="empname" type="text" placeholder="Enter Employee Name" name="emp_name" required />
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="fname">Father's Name</label>
                                                        <input class="form-control " id="fname" type="text" placeholder="Enter Father's Name" name="fname" required/>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="mname">Mother's Name</label>
                                                        <input class="form-control " id="mname" type="text" placeholder="Enter Mother's Name" name="mname" required/>
                                                    </div>
                                                </div>
                                               
                                                 <div class="col-md-6">
                                                 
                                                     <div class="form-group">
                                                        <label class=" mb-1" for="title">Email</label>
                                                        <input class="form-control " id="title" type="email" placeholder="Enter Employee Email" name="email" required/>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" mb-1" for="company">Company Name</label>
                                                <input class="form-control " id="cmpny_name" type="text" placeholder="Enter Company Name" name="company" required/>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label class=" mb-1" for="company">Highest Qualification</label>
                                                <input class="form-control " id="cmpny_name" type="text" placeholder="Enter Employee Highest Qualification" name="qualification" required/>
                                            </div>
                                            </div>
                                            </div>
                                           
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="fname">Employee Experties</label>
                                                        <select  class="form-control" name="experties" required>
                                                            <option></option>  
                                                            <option value="General Adminstration">General Adminstration</option> 
                                                            <option value="Management">Management</option> 
                                                            <option value="Development">Development</option> 
                                                            <option value="Desiging">Desiging</option>
                                                            <option value="Accounting">Accounting</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="mname">Employee Specialty</label>
                                                        <input class="form-control " id="mname" type="text" placeholder="Enter Employee Specialty" name="specialist" required/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="des">Designation</label>
                                                        <input class="form-control " id="emp_desi" type="text" placeholder="Enter Designation" name="emp_desi" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="contact">Contact</label>
                                                        <input class="form-control " id="contact" type="text" placeholder="Contact Details" name="contact" required/>
                                                    </div>
                                                </div>
                                            </div>
                                              
                                              <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="adhar">Aadhar Number</label>
                                                        <input class="form-control " id="adhar" type="text" placeholder="Enter Aadhar Number" name="adhar" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="pan">Pan Number</label>
                                                        <input class="form-control " id="pan" type="text" placeholder="Enter Pan Number" name="pan" required/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="esic">ESIC Number</label>
                                                        <input class="form-control " id="esic" type="text" placeholder="Enter ESIC Number" name="esic" required/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="Account">Account Number</label>
                                                        <input class="form-control " id="Account" type="text" placeholder="Enter Account Number" name="account" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="Bank">Bank</label>
                                                        <input class="form-control " id="bank" type="text" placeholder="Enter Bank Name" name="bank" required/>
                                                    </div>
                                                </div>
                                            </div>
                                                  <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="esic">IFSC Code</label>
                                                        <input class="form-control " id="IFSC" type="text" placeholder="Enter IFSC Code" name="ifsc" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="dob">Date Of Birth</label>
                                                        <input class="form-control " id="dob" type="date" name="dob" required/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="doj">Date Of Joining</label>
                                                        <input class="form-control " id="doj" type="date" name="doj" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="state">State</label>
                                                        <input class="form-control " id="state" type="text" placeholder="State" name="state" required/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="Pincode">Pincode</label>
                                                        <input class="form-control " id="Pincode" type="text" name="pincode" placeholder="Enter Pincode Number" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="Basic">Basic Salary</label>
                                                        <input class="form-control " id="Basic" type="text" placeholder="Basic Salary" name="basic_salary" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1" for="Pincode">Address</label>
                                                        <input class="form-control" id="Pincode" type="text" name="address" placeholder="Enter Employee Address" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class=" mb-1">Photo</label>
                                                        <input type="file" name="file" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <b>Which of the following programming langauage do you have experience in?</b>
                                                <br>
                                            </div>
                                              <div>
                                                  <p class="btn btn-primary" onclick="lon_show()" onclick="lon_hide()" id="sh">Show Language</p>
                                                  <p class="btn btn-warning" onclick="lon_hide()" id="hi" style="display: none;">Hide Language</p>

                                              </div>
                                           
                                       <div class="row" id="lon" style="display: none;">
                                        <div class="col-md-6">
                                            <table class="table  table-hover" id="dataTable" width="100%" cellspacing="0">
                                             <tr>
                                                   <td>HTML5</td>
                                                   <td><input type="checkbox" name="language[]" value="HTML5"></td>
                                               </tr>
                                               <tr>
                                                   <td>CSS3</td>
                                                   <td><input type="checkbox" name="language[]" value="CSS3"></td>
                                               </tr><tr>
                                                   <td>JavaScript</td>
                                                   <td><input type="checkbox" name="language[]" value="JavaScript"></td>
                                               </tr><tr>
                                                   <td>Core PHP</td>
                                                   <td><input type="checkbox" name="language[]" value="Core PHP"></td>
                                               </tr><tr>
                                                   <td>Cake PHP</td>
                                                   <td><input type="checkbox" name="language[]" value="Cake PHP"></td>
                                               </tr>
                                           </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table  table-hover" id="dataTable" width="100%" cellspacing="0">
                                              <tr>
                                                   <td>Bootstrap 4</td>
                                                   <td><input type="checkbox" name="language[]" value="Bootstrap"></td>
                                               </tr><tr>
                                                   <td>Jquery</td>
                                                   <td><input type="checkbox" name="language[]" value="Jquery"></td>
                                               </tr><tr>
                                                   <td>Node js</td>
                                                   <td><input type="checkbox" name="language[]" value="Node js"></td>
                                               </tr><tr>
                                                   <td>Ajax</td>
                                                   <td><input type="checkbox" name="language[]" value="Ajax"></td>
                                               </tr><tr>
                                                   <td>Angular js</td>
                                                   <td><input type="checkbox" name="language[]" value="Angular js"></td>
                                               </tr>
                                                </table>
                                           </div>
                                          
                                       </div>
                                        <div class="row">
                                           <div class="col-md-4"></div>
                                           <div class="col-md-4">
                                            <div class="form-group mt-4 mb-0"> 
                                                <input type="submit" class="btn btn-success form-control" name="submit" value="submit">
                                            </div>
                                           </div>
                                           <div class="col-md-4"></div>
                                       </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>


    <?php echo page_footer(); ?>
    <script type="text/javascript">
        function lon_show()
        {
            $("#lon").show('slow');
            $("#hi").show();
            $("#sh").hide();
        }
         function lon_hide()
        {
            $("#lon").hide('slow');
            $("#hi").hide();
            $("#sh").show();
        }
    </script>
