<?php
    require_once("log.php");
    if(isset($_POST['update'])){
        $res = $staff->updateProfile($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress']);
        //print_r($res);
    }

    if(isset($_GET['viewAppointments'])){
        $appointments = $staff->getAppointments($_GET['date']);
    }else{
        $appointments = $staff->getAppointments();
    }

    if(isset($_POST['report'])){
        $res = $staff->recordLabReport($_POST['date'], $_POST['treatment'], $_POST['test'], $_POST['diagnosis'], $_POST['patient']);
    }
    
    
    //$patientData = $patient->viewPatient($_GET['id']);
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
                <?php //require_once("sidebar.php"); ?>
                <div class="col-md-12">
                    <!-- Main area -->
                    <div class="row">
                        <!-- <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h3>Welcome Back <?php echo $name; ?></h3>
                                </div>
                            </div>
                        </div> -->
                        <?php
                            $stats = $staff->getAppointmentStats();
                        ?>
                        <div class="col-3 mt-3">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <h4><?php echo $stats['attended']; ?> patients Attended</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <h4><?php echo $stats['pending']; ?> patients Pending</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <h4><?php echo $stats['cancelled']; ?> patients cancelled</h4>
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
									        <a class="nav-link active text-dark" href="#">Appointments</a>
									    </li>
                                        <li class="nav-item tabHeading" onclick="show('stockHistory', this)">
                                            <a class="nav-link text-dark" href="#">Report</a>
                                        </li>
									    <li class="nav-item tabHeading" onclick="show('edit', this)">
										    <a class="nav-link text-dark" href="#">Profile</a>
										</li>
									</ul>
								</div>
								<div class="card-body tab" id="view">
                                        <div class="col-md-12">
                                            <div class="my-3 d-flex pe-3">
                                                <form action="#" method="GET" class="d-flex ms-auto">
                                                    <div>
                                                        <input type="date" name="date" class="form-control">
                                                    </div>
                                                    <button type="submit" name="viewAppointments" class="btn btn-sm btn-primary">
                                                        View
                                                    </button>
                                                </form>
                                            </div>
											<table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th>Change Status</th>
                                                    </tr>
                                                </thead>
											  <tbody>
                                                    <?php
                                                        $i = 1;
                                                        
                                                        foreach($appointments as $appointment){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; $i++; ?></td>
                                                            <td><a href="view_patient.php?id=<?php echo $appointment['patient']->getPatientId(); ?>"><?php echo $appointment['patient']->getFName()." ".$appointment['patient']->getLName(); ?></a></td>
                                                            <td><?php echo $appointment['date']; ?></td>
                                                            <td><?php echo $appointment['time'].":00"; ?></td>
                                                            <td><?php echo $appointment['status']; ?></td>
                                                            <td>
                                                                <form action="#" method="POST">
                                                                    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>" />
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="">Select Status</option>
                                                                        <option value="pending">Pending</option>
                                                                        <option value="cancelled">Cancelled</option>
                                                                        <option value="attended">Attended</option>
                                                                    </select>
                                                                    <button class="btn btn-sm btn-primary" name="update">Change Status</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>
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
                                                        <input type="text" name="fname" class="form-control" value="<?php echo $staff->getFName(); ?>" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Last Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="lname" class="form-control" value="<?php echo $staff->getLName(); ?>" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Email</label>
                                                    <div class="col-sm-7">
                                                        <input type="email" name="email" class="form-control" value="<?php echo $staff->getEmail(); ?>" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Address</label>
                                                    <div class="col-sm-7">
                                                        <textarea name="address" placeholder="Address" class="form-control"><?php echo $staff->getAddress(); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Phone</label>
                                                    <div class="col-sm-7">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">+370</span>
                                                            <input type="text" name="phone" class="form-control" id="" value="<?php echo $staff->getPhone(); ?>" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Date of birth</label>
                                                    <div class="col-sm-7">
                                                        <input type="date" name="dob" class="form-control" value="<?php echo $staff->getDOB(); ?>" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Gender</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="gender">
                                                            <option value="">Select gender</option>
                                                            <option value="male" <?php echo $staff->getGender() == 'male' ? 'selected' : ''; ?>>Male</option>
                                                            <option value="female" <?php $staff->getGender() == 'male' ? 'selected' : ''; ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Type</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="type">
                                                            <option value="">Select Type</option>
                                                            <option value="doctor" <?php echo $staff->getType() == 'doctor' ? 'selected' : ''; ?>>Doctor</option>
                                                            <option value="nurse" <?php echo $staff->getType() == 'nurse' ? 'selected' : ''; ?>>Nurse</option>
                                                            <option value="others" <?php echo $staff->getType() == 'others' ? 'selected' : ''; ?>>Others</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Level</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="level">
                                                            <option value="">Select Level</option>
                                                            <option value="1" <?php echo $staff->getLevel() == 1 ? 'selected' : ''; ?>>1</option>
                                                            <option value="2" <?php echo $staff->getLevel() == 2 ? 'selected' : ''; ?>>2</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Duty Period</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="period">
                                                            <option value="">Select Period</option>
                                                            <option value="morning" <?php echo $staff->getDutyPeriod() == 'morning' ? 'selected' : ''; ?>>Morning</option>
                                                            <option value="afternoon" <?php echo $staff->getDutyPeriod() == 'afternoon' ? 'selected' : ''; ?>>Afternoon</option>
                                                            <option value="night" <?php echo $staff->getDutyPeriod() == 'night' ? 'selected' : ''; ?>>Night</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin First Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="nokfname" class="form-control" value="<?php echo $staff->getNOKFName(); ?>" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Next of Kin Last Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="noklname" class="form-control" value="<?php echo $staff->getNOKLName(); ?>" placeholder="Last Name">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Next of kin Address</label>
                                                    <div class="col-sm-7">
                                                        <textarea name="nokaddress" placeholder="Address" class="form-control"><?php echo $staff->getNOKAddress(); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Next of Kin Phone</label>
                                                    <div class="col-sm-7">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">+370</span>
                                                            <input type="text" name="nokphone" class="form-control" id="" value="<?php echo $staff->getNOKPhone(); ?>" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
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
                            <div class="card-body tab d-none p-0 mb-4" id="stockHistory">
                                <div class="col-8 ml-auto mr-auto mt-4">
                                    <form action="#" method="POST" class="mx-auto">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Patient</label>
                                                <div class="col-sm-7">
                                                    <div class="dropdown">
														<input type="text" onkeyup="getPatients(this);" name="patients" autocomplete="off" class="form-control" placeholder="Search Patients" id="pDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
													  <div id="dropdown" class="dropdown-menu bg-light overflow-auto" aria-labelledby="pDropdownMenuButton" style="z-index: 99; max-height: 300px;">
													  </div>
													  <input type="hidden" name="patient" value="" required>
													</div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Date</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Test Conducted</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="test" class="form-control" id="" placeholder="Test Conducted">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Diagnosis</label>
                                                <div class="col-sm-7">
                                                    <textarea name="diagnosis" placeholder="Diagnosis" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Treatment</label>
                                                <div class="col-sm-7">
                                                    <textarea name="treatment" placeholder="Treatment" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="offset-md-3">
                                                <button type="submit" name="report" class="btn btn-primary ms-3">Save</button>
                                            </div>
                                        </form>	
                                </div>				
							</div>
                
            </div>
            <?php require_once("footer.php"); ?>
        </div>
        <?php require_once("scripts.php"); ?>
        <script type="text/javascript">
            function getPatients(input){
				// tableBody.innerHTML = ""
				// if (input == "") {
				// 	table.classList.add("d-none");
				// 	return 0;
				// }
				let result = ['sdfghgfd'];
				const url = 'search_patients.php?searchString='+input.value;

				fetch(url, {
					method: 'GET'
				}).then((response) => response.json().then((data)=>{//console.log(data)

					//alert(data[0].name)
					var dropdown = input.parentNode //document.getElementById("dropdown")
					dropdown.children[1].innerHTML = ""
					for(var i =0; i<data.length; i++){
						var item = document.createElement("span");
						item.classList.add("dropdown-item");
						item.innerHTML = data[i].first_name+" "+data[i].last_name
						item.setAttribute("data-id", data[i].id)
						// item.setAttribute("data-price", data[i].price)
						item.setAttribute("data-lname", data[i].last_name)
						item.setAttribute("data-fname", data[i].first_name)
						// item.setAttribute("id", "p"+data[i].id+" "+count)
						item.setAttribute("onclick", "select(this,"+input.id+")")
						dropdown.children[1].classList.remove("d-none")
						dropdown.children[1].appendChild(item)
					}
					
				}))
			}

			function select(pid, input){
				//alert(input[1].id)
				input.value = pid.dataset.fname+" "+pid.dataset.lname
				input.parentNode.children[2].value = pid.dataset.id
			}

        </script>
    </body>
</html>