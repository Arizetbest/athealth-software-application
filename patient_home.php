<?php
    require_once("log.php");
    if(isset($_POST['update'])){
        $res = $patient->updateAppointment($_POST['id'], $_POST['doctor'], $_POST['date'], $_POST['time']);
    }
    
    if(isset($_POST['delete'])){
        $res = $patient->deleteAppointment($_POST['id']);
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
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body d-flex">
                                    <h3>Welcome Back <?php echo $name; ?></h3>
                                    <div class="ms-auto">
                                        <a href="patient_book_appointment.php" class="btn btn-primary">Book Appointment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card mt-3 pb-4 mb-4">
                            <div class="card-header p-0">
									<ul class="nav nav-tabs">
									    <li class="nav-item tabHeading" onclick="show('view', this)">
									        <a class="nav-link active text-dark" href="#">Appointments</a>
									    </li>
                                        <li class="nav-item tabHeading" onclick="show('stockHistory', this)">
                                            <a class="nav-link text-dark" href="#">Medical History</a>
                                        </li>
									    <li class="nav-item tabHeading" onclick="show('edit', this)">
										    <a class="nav-link text-dark" href="#">Profile</a>
										</li>
									</ul>
								</div>
								<div class="card-body tab" id="view">
                                        <div class="col-md-12">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" method="POST" class="mx-auto">
                                                            <div class="row mb-3">
                                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Doctor</label>
                                                                <div class="col-sm-7">
                                                                    <div class="dropdown">
                                                                        <input type="text" onkeyup="getDoctors(this);" name="doctors" autocomplete="off" class="form-control" placeholder="Search Doctors" id="pDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <div id="dropdown" class="dropdown-menu bg-light overflow-auto" aria-labelledby="pDropdownMenuButton" style="z-index: 99; max-height: 300px;">
                                                                            
                                                                        </div>
                                                                        <input type="hidden" class="products" id="doctorInput" name="doctor" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="" class="col-sm-3 ms-2 col-form-label">Appointment date</label>
                                                                <div class="col-sm-7">
                                                                    <input type="hidden" name="id" id="appId" />
                                                                    <input type="date" name="date" min="<?php echo Date("Y-m-d"); ?>" class="form-control" id="dateInput" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="" class="col-sm-3 ms-2 col-form-label">Time</label>
                                                                <div class="col-sm-7">
                                                                    <select name="time" class="form-control" id="timeInput">
                                                                        <option value="">Select Time period</option>
                                                                        <option value="00">00 - 01</option>
                                                                        <option value="01">01 - 02</option>
                                                                        <option value="02">02 - 03</option>
                                                                        <option value="03">03 - 04</option>
                                                                        <option value="04">04 - 05</option>
                                                                        <option value="05">05 - 06</option>
                                                                        <option value="06">06 - 07</option>
                                                                        <option value="07">07 - 08</option>
                                                                        <option value="08">08 - 09</option>
                                                                        <option value="09">09 - 10</option>
                                                                        <option value="10">10 - 11</option>
                                                                        <option value="11">11 - 12</option>
                                                                        <option value="12">12 - 13</option>
                                                                        <option value="13">13 - 14</option>
                                                                        <option value="14">14 - 15</option>
                                                                        <option value="15">15 - 16</option>
                                                                        <option value="16">16 - 17</option>
                                                                        <option value="17">17 - 18</option>
                                                                        <option value="18">18 - 19</option>
                                                                        <option value="19">19 - 20</option>
                                                                        <option value="20">20 - 21</option>
                                                                        <option value="21">21 - 22</option>
                                                                        <option value="22">22 - 23</option>
                                                                        <option value="23">23 - 24</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="offset-md-3">
                                                                <button type="submit" name="update" class="btn btn-primary ms-3">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
											<table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Doctor</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
											  <tbody>
                                                    <?php
                                                        $i = 1;
                                                        $appointments = $patient->getAppointments();
                                                        foreach($appointments as $appointment){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; $i++; ?></td>
                                                            <td><?php echo $appointment['doctor']->getFName()." ".$appointment['doctor']->getLName(); ?></td>
                                                            <td><?php echo $appointment['date']; ?></td>
                                                            <td><?php echo $appointment['time'].":00"; ?></td>
                                                            <td><?php echo $appointment['status']; ?></td>
                                                            <td class="d-flex">
                                                                <div>
                                                                    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>" />
                                                                    <input type="hidden" name="status" value="cancelled" />
                                                                    <?php
                                                                        $vals = "'".$appointment['date']."', '".$appointment['time']."', '".$appointment['id']."', '".$appointment['doctor']->getStaffId()."'";
                                                                    ?>
                                                                    <button <?php if($appointment['status'] == 'attended'){echo 'disabled';} ?> onclick="prefill(<?php echo $vals; ?>)" class="btn btn-sm btn-primary" name="update" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fa fa-edit"></span></button>
                                                                </div>
                                                                <form action="#" method="POST">
                                                                    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>" />
                                                                    <button <?php if($appointment['status'] == 'attended'){echo 'disabled';} ?> type="submit" name="delete" class="btn btn-sm btn-danger ms-3"><span class="fa fa-trash"></span></button>
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
                                                    <button type="submit" name="update" class="btn btn-primary ms-3">Update Profile</button>
                                                </div>
                                            </form>
										</div>
									</div>
									<div class="card-body tab d-none p-0 mb-4" id="stockHistory">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient Name</th>
                                                        <th>Lab Staff</th>
                                                        <th>Test Date</th>
                                                        <th>Test</th>
                                                        <th>Diagnosis</th>
                                                        <th>Treatment</th>
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
                                                            <td><?php echo $report['treatment']; ?></td>
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
        <script type="text/javascript">
            function getDoctors(input){
				// tableBody.innerHTML = ""
				// if (input == "") {
				// 	table.classList.add("d-none");
				// 	return 0;
				// }
				let result = ['sdfghgfd'];
				const url = 'search_doctors.php?searchString='+input.value;

				fetch(url, {
					method: 'GET'
				}).then((response) => response.json().then((data)=>{

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
            function prefill(date, time, id, doctor){//alert(id)
                document.getElementById("dateInput").value = date
                document.getElementById("timeInput").value = time
                document.getElementById("doctorInput").value = doctor
                document.getElementById("appId").value = id
            }
        </script>
    </body>
</html>