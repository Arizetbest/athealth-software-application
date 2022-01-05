<?php
    require_once("log.php");
    if(isset($_POST['update'])){
        $res = $staff->updatePatient($_GET['id'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress']);
        //print_r($res);
    }
    
    
    $patient = $staff->viewPatient($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("head.php"); ?>
        <?php require_once("scripts.php"); ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <?php require_once("dialog.php"); ?>
                <?php require_once("navbar.php"); ?>
            </div>
            <div class="row mb-5">
                <?php //require_once("sidebar.php"); ?>
                <div class="col-md-12">
                    <!-- Main area -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h3>View Patient</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 mb-5">
                            <div class="card mt-3 pb-4">
                            <div class="card-header p-0">
									<ul class="nav nav-tabs">
									    <li class="nav-item tabHeading" onclick="show('view', this)">
									        <a class="nav-link active text-dark" href="#">View</a>
									    </li>
									    <!-- <li class="nav-item tabHeading" onclick="show('edit', this)">
										    <a class="nav-link text-dark" href="#">Edit</a>
										</li> -->
                                        <li class="nav-item tabHeading" onclick="show('stockHistory', this)">
                                            <a class="nav-link text-dark" href="#">Medical History</a>
                                        </li>
									</ul>
								</div>
								<div class="card-body tab" id="view">
                                        <div class="col-md-6">
											<table class="table table-striped">
											  <tbody>
											    <tr>
											      <td>Name</td>
											      <td><?php echo $patient->getFName()." ".$patient->getLName(); ?></td>
											    </tr>
											    <tr>
											      <td>Email</td>
											      <td><?php echo $patient->getEmail(); ?></td>
											    </tr>
											    <tr>
											      <td>Phone</td>
											      <td><?php echo "+370 ".$patient->getPhone(); ?></td>
											    </tr>
											    <tr>
											      <td>Address</td>
											      <td><?php echo $patient->getAddress(); ?></td>
											    </tr>
											    <tr>
											      <td>Gender</td>
											      <td><?php echo $patient->getGender(); ?></td>
											    </tr>
											    <tr>
											      <td>dob</td>
											      <td><?php echo date_format(date_create($patient->getDOB()), "jS, F Y"); ?></td>
											    </tr>
											    <tr>
											      <td>Next of Kin Name</td>
											      <td>
											      	<?php echo $patient->getNOKFName()." ".$patient->getNOKLName(); ?>
											      </td>
											    </tr>
                                                <tr>
											      <td>Next of Kin phone</td>
											      <td>
											      	<?php echo "+370 ".$patient->getNOKPhone(); ?>
											      </td>
											    </tr>
                                                <tr>
											      <td>Next of Kin Address</td>
											      <td>
											      	<?php echo $patient->getNOKAddress(); ?>
											      </td>
											    </tr>
											  </tbody>
											</table>
                                        </div>
								</div>
									<div class="card-body tab d-none" id="edit">
										<div class="col-8 ml-auto mr-auto mt-4">
                                            <form action="#" method="POST" class="mx-auto">
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">First Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="fname" class="form-control" value="<?php echo $patient->getFName(); ?>" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Last Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="lname" class="form-control" value="<?php echo $patient->getLName(); ?>" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Email</label>
                                                    <div class="col-sm-7">
                                                        <input type="email" name="email" class="form-control" value="<?php echo $patient->getEmail(); ?>" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Address</label>
                                                    <div class="col-sm-7">
                                                        <textarea name="address" placeholder="Address" class="form-control"><?php echo $patient->getAddress(); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Phone</label>
                                                    <div class="col-sm-7">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">+370</span>
                                                            <input type="text" name="phone" class="form-control" id="" value="<?php echo $patient->getPhone(); ?>" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Date of birth</label>
                                                    <div class="col-sm-7">
                                                        <input type="date" name="dob" class="form-control" value="<?php echo $patient->getDOB(); ?>" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Gender</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="gender">
                                                            <option value="">Select gender</option>
                                                            <option value="male" <?php echo $patient->getGender() == 'male' ? 'selected' : ''; ?>>Male</option>
                                                            <option value="female" <?php $patient->getGender() == 'male' ? 'selected' : ''; ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin First Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="nokfname" class="form-control" value="<?php echo $patient->getNOKFName(); ?>" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin Last Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="noklname" class="form-control" value="<?php echo $patient->getNOKLName(); ?>" placeholder="Last Name">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Next of kin Address</label>
                                                    <div class="col-sm-7">
                                                        <textarea name="nokaddress" placeholder="Address" class="form-control"><?php echo $patient->getNOKAddress(); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Next of Kin Phone</label>
                                                    <div class="col-sm-7">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">+370 </span>
                                                            <input type="text" name="nokphone" class="form-control" value="<?php echo $patient->getNOKPhone(); ?>" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="offset-md-3">
                                                    <button type="submit" name="update" class="btn btn-primary ms-3">Save</button>
                                                </div>
                                            </form>
										</div>
									</div>
									<div class="card-body tab d-none p-0" id="stockHistory">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient Name</th>
                                                        <th>Lab Staff</th>
                                                        <th>Test Date</th>
                                                        <th>Test</th>
                                                        <th>Diagnosis</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $reports = $patient->viewLabReports();
                                                        $i = 1;
                                                        foreach($reports as $report){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $report['patient']->getFName()." ".$report['patient']->getLName(); ?></td>
                                                            <td><?php echo $report['staff']->getFName()." ".$report['staff']->getLName(); ?></td>
                                                            <td><?php echo $report['date']; ?></td>
                                                            <td><?php echo $report['test']; ?></td>
                                                            <td><?php echo $report['diagnosis']; ?></td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>						
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