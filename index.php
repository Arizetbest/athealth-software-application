<?php
    session_start();
    require_once("class_lib/Auth.php");
    require_once("class_lib/Database.php");

    $db = new Database();
    $db->openConnection();
	$auth = new Auth($db);
    
	if(isset($_POST['submit'])){
		//Creating object of auth class in order to call login function
        
		$res = $auth->login($_POST['email'], $_POST['password']);
		if($res['status']){
			$_SESSION['user'] = $res['id'];
			$_SESSION['staff'] = $res['staffId'];
            $_SESSION['user_type'] = $res['type'];print_r($res);
            if($_SESSION['user_type'] == 'doctor'){
			    header("location:doctor_home.php");
            }else if($_SESSION['user_type'] == 'others'){
                header("location:admin_home.php");
            }else if($_SESSION['user_type'] == 'patient'){
                header("location:patient_home.php");
            }
		}
	}else if(isset($_POST['register'])){
        $res = $auth->registerPatient($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['dob'], $_POST['phone'], $_POST['nokfname'], $_POST['noklname'], $_POST['nokphone'], $_POST['nokaddress'], $_POST['pass']);
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <style>
            /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
        </style>
        <title>ATHEALTH: HMS</title>
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="row">
                <?php require_once("dialog.php"); ?>
                <div class="col-md-6 mx-auto mt-5">
                    <div class="card shadow  bg-b text-white ">
                        <div class="card-body text-center">
                            
                            <h3 class="text-center text-dark">ATHEALTH</h3>
                            <p class="text-center text-dark">AThealth is the number one hospital appointment management application in the world. 
                                With a wide variety of features and a user friendly interface
                            </p>
                        </div>

                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="images/pexels-vidal-balielo-jr-1250655.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/pexels-pixabay-236380.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/pexels-pixabay-247786.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 mx-auto mt-5">
                    <div class="card shadow  bg-blue text-white">
                        <div class="card-body text-center">
                            <img src="images/athealth.jpeg" class="img logo-login" />
                            <!-- <h3 class="text-center">ATHEALTH</h3> -->
                            <p class="text-center">Hospital Management System</p>
                        </div>

                    </div>

                    <div class="card shadow mt-3  bg-blue text-white mb-5">
                        <div class="card-header p-0">
									<ul class="nav nav-tabs">
									    <li class="nav-item tabHeading bg-dar" onclick="show('view', this)">
									        <a class="nav-link active text-whit" href="#">Login</a>
									    </li>
									    <li class="nav-item tabHeading bg-dar" onclick="show('edit', this)">
										    <a class="nav-link text-whit" href="#">Create an Account</a>
										</li>
									</ul>
						</div>
                        <div class="card-body tab" id="view">
                            <div class="col-12 d-flex">
                                <h4 class="mx-auto mb-4">Login</h4>
                            </div>
                            <form action="#" method="POST">
                                <div class="row mb-3">
                                  <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Email</label>
                                  <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="inputPassword3" class="col-sm-3 ms-2 col-form-label">Password</label>
                                  <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
                                  </div>
                                </div>
                                <div class="offset-md-3">
                                    <!-- <input type="submit" name="submit" value="submit" /> -->
                                    <button type="submit" name="submit" class="btn btn-primary ms-3">Login</button>
                                </div>
                              </form>
                        </div>
                        <div class="card-body d-none tab " id="edit">
                            <div class="col-12 d-flex">
                                <h4 class="mx-auto mb-4">Register</h4>
                            </div>
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
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Password</label>
                                                <div class="col-sm-7">
                                                    <input type="password" name="pass" class="form-control" id="inputEmail3" placeholder="Password">
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
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+370</span>
                                                        <input type="number" name="nokphone" class="form-control" id="" placeholder="Phone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="offset-md-3">
                                                <button type="submit" name="register" class="btn btn-primary ms-3">Save</button>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("scripts.php"); ?>
    </body>
</html>