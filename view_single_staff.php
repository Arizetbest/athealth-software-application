<?php
    require_once("log.php");
    if(isset($_POST['update'])){
        $res = $staff->updateStaff($_GET['id'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress'], $_POST['type'], $_POST['level'], $_POST['period'],);
        //print_r($res);
    }
    
    
    $patient = $staff->viewSingleStaff($_GET['id']);
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
            <div class="row">
                <?php require_once("sidebar.php"); ?>
                <div class="col-md-10">
                    <!-- Main area -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h3>Staff</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3 pb-4">
                                <div class="card-header p-0">
									<ul class="nav nav-tabs">
									    <li class="nav-item tabHeading" onclick="show('view', this)">
									        <a class="nav-link active text-dark" href="#">View</a>
									    </li>
									    <li class="nav-item tabHeading" onclick="show('edit', this)">
										    <a class="nav-link text-dark" href="#">Edit</a>
										</li>
                                        <!-- <li class="nav-item tabHeading" onclick="show('stockHistory', this)">
                                            <a class="nav-link text-dark" href="#">Stock history</a>
                                        </li> -->
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
											      <td>Level</td>
											      <td><?php echo $patient->getLevel(); ?></td>
											    </tr>
                                                <tr>
											      <td>Staff Type</td>
											      <td><?php echo $patient->getType(); ?></td>
											    </tr>
                                                <tr>
											      <td>Duty Period</td>
											      <td><?php echo $patient->getDutyPeriod(); ?></td>
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
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Type</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="type">
                                                            <option value="">Select Type</option>
                                                            <option value="doctor" <?php echo $patient->getType() == 'doctor' ? 'selected' : ''; ?>>Doctor</option>
                                                            <option value="nurse" <?php echo $patient->getType() == 'nurse' ? 'selected' : ''; ?>>Nurse</option>
                                                            <option value="others" <?php echo $patient->getType() == 'others' ? 'selected' : ''; ?>>Others</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Level</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="level">
                                                            <option value="">Select Level</option>
                                                            <option value="1" <?php echo $patient->getLevel() == 1 ? 'selected' : ''; ?>>1</option>
                                                            <option value="2" <?php echo $patient->getLevel() == 2 ? 'selected' : ''; ?>>2</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Duty Period</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="period">
                                                            <option value="">Select Period</option>
                                                            <option value="morning" <?php echo $patient->getDutyPeriod() == 'morning' ? 'selected' : ''; ?>>Morning</option>
                                                            <option value="afternoon" <?php echo $patient->getDutyPeriod() == 'afternoon' ? 'selected' : ''; ?>>Afternoon</option>
                                                            <option value="night" <?php echo $patient->getDutyPeriod() == 'night' ? 'selected' : ''; ?>>Night</option>
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
                                                            <span class="input-group-text" id="basic-addon1">+370</span>
                                                            <input type="text" name="nokphone" class="form-control" id="" value="<?php echo $patient->getNOKPhone(); ?>" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="offset-md-3">
                                                    <button type="submit" name="update" class="btn btn-primary ms-3">Save</button>
                                                </div>
                                            </form>
                                            <!-- <form action="#" method="POST">
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Old Password</label>
                                                    <div class="col-sm-7">
                                                    <input type="password" name="oldPass" class="form-control" value="" placeholder="Old Password">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">New Password</label>
                                                    <div class="col-sm-7">
                                                        <input type="password" name="newPass" class="form-control" value="" placeholder="New Password">
                                                    </div>
                                                </div>
                                                <div class="offset-md-3">
                                                    <button type="submit" name="updatePassword" class="btn btn-primary ms-3">Save</button>
                                                </div>
                                            </form> -->
										</div>
									</div>
									<div class="card-body tab d-none p-0" id="stockHistory">
												<table class="table table-striped">
												  <thead class="">
												    <tr>
												      <th scope="col">Invoice Number</th>
												      <th scope="col">Cost price</th>
												      <th scope="col">Quantity</th>
												      <th scope="col">Purchase Date</th>
												      <th scope="col">Expiry date</th>
												      <th></th>
												    </tr>
												  </thead>
												  <tbody>
													    <tr class="<?php if($currentStock['data']['supply'] == $supply['supply']){echo 'bg-success'; } ?>">
													      <td><?php echo $supply['invoice_number']; ?></td>
													      <td><?php echo $supply['price']; ?></td>
													      <td><?php echo $supply['quantity']; ?></td>
													      <td><?php echo date_format(date_create($supply['supply_date']), "jS, F Y"); ?></td>
													      <td>
													      	<?php echo date_format(date_create($supply['expiry_date']), "jS, F Y"); ?>
													      </td>
													      <td>
													      	<a href="purchase_details.php?id=<?php echo $supply['supply']; ?>" class="btn btn-sm btn-primary">View</a>
													      </td>
													    </tr>
												    
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