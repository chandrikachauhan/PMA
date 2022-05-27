
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
    $query = "UPDATE add_employee SET 
    emp_name='".$_POST['emp_name']."',
     fname='".$_POST['fname']."',
    mname='".$_POST['mname']."',
     cmpny_name='".$_POST['company']."',
    contact='".$_POST['contact']."',
    emp_desi='".$_POST['emp_desi']."',
    adhar='".$_POST['adhar']."',
    pan='".$_POST['pan']."',
    esic='".$_POST['esic']."',
    account='".$_POST['account']."',
    bank='".$_POST['bank']."',
    ifsc='".$_POST['ifsc']."',
    dob='".$_POST['dob']."',
    doj='".$_POST['doj']."',
    basic_salary='".$_POST['basic_salary']."',
    state='".$_POST['state']."',
    pincode='".$_POST['pincode']."',
    address='".$_POST['address']."',
    edited_by='".$_SESSION['names']."',
    qualification='".$_POST['qualification']."', 
    email='".$_POST['email']."',
    experties='".$_POST['experties']."',
    specialist='".$_POST['specialist']."',
    language='".$_POST['language']."',
    edit_time=now()
    WHERE sno='".$_POST['id']."'";
    if($db->query($query) == TRUE) {
    echo "<script>alert('Update Successfull');window.location.href='employee_report.php'</script>";
} else {
  echo "Error updating record: " . $db->error;
}
}
?>
<?php
 if(isset($_GET['id']))
 {
    $id=$_GET['id'];
   // echo $id;
    
     $sql = "SELECT * FROM add_employee where sno='$id'";                                       
     $result = $db->query($sql);

     if ($result->num_rows > 0) {
                                                      // output data of each row
     while($row = $result->fetch_assoc()) {                                       
                                            
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
            <div class="card-header">
                <h3 class="text-center font-weight-light ">Employee Details</h3>
            </div>
            <div class="card-body">
                <form action="edit_employee.php" method="post">
                    <div class="form-group">
                        <input class="form-control " type="hidden" name="id" value="<?php echo $row['sno']?>" />
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="empname">Employee Name</label>
                                <input class="form-control " id="empname" type="text" placeholder="Enter employee name" name="emp_name" value="<?php echo $row['emp_name']?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="fname">Father's Name</label>
                                <input class="form-control " id="fname" type="text" placeholder="Enter Father's name" name="fname" value="<?php echo $row['fname']?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="mname">Mother's Name</label>
                                <input class="form-control " id="mname" type="text" placeholder="Mother's Name" name="mname" value="<?php echo $row['mname']?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control " id="email" type="text" placeholder="Enter employee email" name="email" value="<?php echo $row['email']?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="company">Company Name</label>
                                <input class="form-control " id="cmpny_name" type="text" placeholder="Enter company" name="company" value="<?php echo $row['cmpny_name']?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="company">High Qualification</label>
                                <input class="form-control " id="cmpny_name" type="text" placeholder="Enter high qualification" name="qualification" value="<?php echo $row['qualification'];?>" />
                            </div>
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fname">Employee Experties</label>
                                        <select  class="form-control" name="experties">
                                            <option value="General Adminstration"<?php if($row['experties']=='General Adminstration'){ echo 'selected';}?>>General Adminstration</option> 
                                            <option value="Management" <?php if($row['experties']=='Management'){ echo 'selected';}?>>Management</option> 
                                            <option value="Development" <?php if($row['experties']=='Development'){ echo 'Selected';}?>>Development</option>
                                            <option value="Designing" <?php if($row['experties']=='Designing'){ echo 'Selected';}?>>Desiging</option>
                                            <option value="Accounting" <?php if($row['experties']=='Accounting'){ echo 'selected';}?>>Accounting</option> 
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="mname">Employee Specialist</label>
                                    <input class="form-control " id="mname" type="text" placeholder="Enter Employee Specialist" name="specialist" value="<?php echo $row['specialist']?>"/>
                                </div>
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="contact">Contact</label>
                                <input class="form-control " id="contact" type="text" placeholder="Contact details" name="contact" value="<?php echo $row['contact']?>"/>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="des">Designation</label>
                                <input class="form-control " id="emp_desi" type="text" placeholder="Enter Designation" name="emp_desi" value="<?php echo $row['emp_desi']?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="adhar">Adhar</label>
                                <input class="form-control " id="adhar" type="text" placeholder="Enter Adhar" name="adhar" value="<?php echo $row['adhar']?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="pan">Pan</label>
                                <input class="form-control " id="pan" type="text" placeholder="Enter Pan" name="pan" value="<?php echo $row['pan']?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="small mb-1" for="esic">ESIC No</label>
                                <input class="form-control " id="esic" type="text" placeholder="Enter ESIC No" name="esic" value="<?php echo $row['esic']?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="Account">Account</label>
                                <input class="form-control " id="Account" type="text" placeholder="Enter Account no" name="account" value="<?php echo $row['account']?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="Bank">Bank</label>
                                <input class="form-control " id="bank" type="text" placeholder="Bank" name="bank" value="<?php echo $row['bank']?>"/>
                           </div>
                        </div>
                    </div>
                                                  <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="esic">IFSC Code</label>
                                                        <input class="form-control " id="IFSC" type="text" placeholder="Enter IFSC Code" name="ifsc" value="<?php echo $row['ifsc']?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="dob">Date Of Birth</label>
                                                        <input class="form-control " id="dob" type="date" name="dob" value="<?php echo $row['dob']?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="doj">Date Of Joining</label>
                                                        <input class="form-control " id="doj" type="date" name="doj" value="<?php echo $row['doj']?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="state">State</label>
                                                        <input class="form-control " id="state" type="text" placeholder="state" name="state" value="<?php echo $row['state']?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="Pincode">Pincode</label>
                                                        <input class="form-control " id="Pincode" type="text" name="pincode" placeholder="Pincode" value="<?php echo $row['pincode']?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="Basic">Basic Salary</label>
                                                        <input class="form-control " id="Basic" type="text" placeholder="Basic Salary" name="basic_salary" value="<?php echo $row['basic_salary']?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="address">Address</label>
                                                <input type="text" class="form-control " id="address" type="text" placeholder="Enter address" name="address" value="<?php echo $row['address']?>"/>
                                            </div>
                                        </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="address">Language</label>
                                                <input type="text" class="form-control " id="address" type="text" placeholder="Enter Lanuage" name="language" value="<?php echo $row['language']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                         <input type="submit" class="btn btn-success form-control" name="submit" value="UPDATE">
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
<?php
}
}
}
?>

    <?php echo page_footer(); ?>
