<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        $res = $staff->addPatient($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress']);
        //print_r($res);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("head.php"); ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <?php require_once("dialog.php"); ?>
                <?php require_once("navbar.php"); ?>
            </div>
            <div class="row">
                <?php require_once("sidebar.php"); ?>
                <div class="col-md-10">
                    <!-- Main area -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h3>Add Patient</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3 pb-4">
                                <div class="card-body">
                                    <div class="col-md-6 mx-auto mt-4">
                                        <form action="#" method="POST" class="mx-auto">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">First Name</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="fname" class="form-control" id="inputEmail3" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Last Name</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="lname" class="form-control" id="inputEmail3" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Address</label>
                                                <div class="col-sm-7">
                                                    <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Phone</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+370</span>
                                                        <input type="number" name="phone" class="form-control" id="" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Date of birth</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="dob" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Date of birth</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="gender">
                                                        <option value="">Select gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin First Name</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="nokfname" class="form-control" id="inputEmail3" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin Last Name</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="noklname" class="form-control"  placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Next of kin Address</label>
                                                <div class="col-sm-7">
                                                    <textarea name="nokaddress" placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Next of Kin Phone</label>
                                                <div class="col-sm-7">
                                                    <input type="number" name="nokphone" class="form-control" id="" placeholder="Phone">
                                                </div>
                                            </div>

                                            <div class="offset-md-3">
                                                <button type="submit" name="submit" class="btn btn-primary ms-3">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php require_once("footer.php"); ?>
        </div>
        <?php require_once("scripts.php"); ?>
    </body>
</html>