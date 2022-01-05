<?php
    require_once("log.php");
    require_once("class_lib/Staff.php");
    require_once("class_lib/Patient.php");
    if(isset($_POST['update'])){
        $res = $staff->updateProfile($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress']);
        //print_r($res);
    }

    if(isset($_POST['submit'])){
        $res = $staff->addStaff($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress'],  $_POST['empDate'], 'doctor', 1, 'morning', $_POST['pass']);
        //print_r($res);
    }

    if(isset($_POST['action']) && $_POST['action'] == 'activatePatient'){
        $pat = new Patient($db, $_POST['id']);
        $res = $pat->activate();
    }

    if(isset($_POST['action']) && $_POST['action'] == 'deactivatePatient'){
        $pat = new Patient($db, $_POST['id']);
        $res = $pat->deactivate();
    }

    if(isset($_POST['action']) && $_POST['action'] == 'activateDoctor'){print_r("activa");
        $doc = new Staff($db, $_POST['id']);
        $res = $doc->activate();
    }

    if(isset($_POST['action']) && $_POST['action'] == 'deactivateDoctor'){print_r("deac");
        $doc = new Staff($db, $_POST['id']);
        $res = $doc->deactivate();
    }
    $colleagues = $staff->getDoctors();
    $patients = $staff->viewPatients();

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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                        <div class="col-md-6">
                                            <canvas id="pie"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="card mt-3 pb-4">
                                <div class="card-header p-0">
									<ul class="nav nav-tabs">
									    <li class="nav-item tabHeading" onclick="show('view', this)">
									        <a class="nav-link active text-dark" href="#">Doctors</a>
									    </li>
                                        <li class="nav-item tabHeading" onclick="show('patients', this)">
									        <a class="nav-link text-dark" href="#">Patients</a>
									    </li>
									    <li class="nav-item tabHeading" onclick="show('edit', this)">
										    <a class="nav-link text-dark" href="#">Profile</a>
										</li>
                                        <li class="nav-item tabHeading" onclick="show('stockHistory', this)">
                                            <a class="nav-link text-dark" href="#">Add Doctor</a>
                                        </li>
									</ul>
								</div>
								<div class="card-body tab" id="view">
                                        <div class="col-md-12">
											<table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>email</th>
                                                        <th>Address</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($colleagues as $colleague){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; $i++; ?></td>
                                                            <td><?php echo $colleague->getFName()." ".$colleague->getLName(); ?></td>
                                                            <td><?php echo $colleague->getPhone(); ?></td>
                                                            <td><?php echo $colleague->getEmail(); ?></td>
                                                            <td><?php echo $colleague->getAddress(); ?></td>
                                                            <td>
                                                                <?php
                                                                    if($colleague->getStatus()){
                                                                ?>
                                                                    <form action="#" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $colleague->getStaffId(); ?>" >
                                                                        <input type="hidden" name="action" value="deactivateDoctor">
                                                                        <button class="btn btn-sm btn-danger">Deactivate</button>
                                                                    </form>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <form action="#" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $colleague->getStaffId(); ?>" >
                                                                        <input type="hidden" name="action" value="activateDoctor">
                                                                        <button class="btn btn-sm btn-primary">activate</button>
                                                                    </form>
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
								</div>
                                <div class="card-body tab d-none" id="patients">
                                        <div class="col-md-12">
                                        <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>email</th>
                                                        <th>Address</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($patients as $patient){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; $i++; ?></td>
                                                            <td><?php echo $patient->getFName()." ".$patient->getLName(); ?></td>
                                                            <td><?php echo "<div>+370 ".$patient->getPhone()."</div>"; ?></td>
                                                            <td><?php echo $patient->getEmail(); ?></td>
                                                            <td><?php echo $patient->getAddress(); ?></td>
                                                            <td>
                                                                <?php
                                                                    if($patient->getStatus()){
                                                                ?>
                                                                    <form action="#" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $patient->getPatientId(); ?>" >
                                                                        <input type="hidden" name="action" value="deactivatePatient">
                                                                        <button class="btn btn-sm btn-danger">Deactivate</button>
                                                                    </form>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <form action="#" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $patient->getPatientId(); ?>" >
                                                                        <input type="hidden" name="action" value="activatePatient">
                                                                        <button class="btn btn-sm btn-primary">activate</button>
                                                                    </form>
                                                                <?php 
                                                                    }
                                                                ?>
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
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Gender</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="gender">
                                                            <option value="">Select gender</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Type</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="type">
                                                            <option value="">Select Type</option>
                                                            <option value="doctor">Doctor</option>
                                                            <option value="nurse">Nurse</option>
                                                            <option value="others">Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Level</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="level">
                                                            <option value="">Select Level</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                        </select>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Staff Duty Period</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" name="period">
                                                            <option value="">Select Period</option>
                                                            <option value="morning">Morning</option>
                                                            <option value="afternoon">Afternoon</option>
                                                            <option value="night">Night</option>
                                                        </select>
                                                    </div>
                                                </div> -->

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Employment Date</label>
                                                    <div class="col-sm-7">
                                                        <input type="date" name="empDate" class="form-control" id="inputEmail3" placeholder="Employment date">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="" class="col-sm-3 ms-2 col-form-label">Password</label>
                                                    <div class="col-sm-7">
                                                        <input type="password" name="pass" class="form-control" id="inputEmail3" placeholder="Password">
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
                                                        <input type="text" name="noklname" class="form-control" id="inputEmail3" placeholder="Last Name">
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
                                                        <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">+370</span>
                                                                <input type="number" name="nokphone" class="form-control" id="" placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
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
        <script>
            function showStaffByDuty(select){
                let rows = document.querySelectorAll(".staff");
                for(let i=0; i<rows.length; i++){
                    if(rows[i].classList.contains(select.value)){
                        rows[i].classList.remove("d-none");
                    }else{
                        rows[i].classList.add("d-none");
                    }
                }
            }

            let start = new Date(new Date().getFullYear(), 0, 1);
            let end = new Date();
            let url = 'monthly_appointments.php?startDate='+start.toISOString()+"&endDate="+end.toISOString()
            fetch(url, {
				method: 'GET'
			}).then((response) => response.json().then((data)=>{console.log(data)

                let months = []; let totals = []; let i = 0;
                    for(var month in data){
                        months[i] = month
                        totals[i] = data[month]
                        i++
                    }
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: '# appointments',
                            data: totals,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }))

            url = 'pie.php';
            fetch(url, {
				method: 'GET'
			}).then((response) => response.json().then((data)=>{//console.log(data)
                const data1 = {
                    labels: [
                        'Attended',
                        'Pending',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [data.attended, data.pending],
                        backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 4
                    }]
                };
                const ctx = document.getElementById('pie').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: data1
                })
            }))
            </script>
    </body>
</html>