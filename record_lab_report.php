<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        require_once("class_lib/Staff.php");
        require_once("class_lib/Database.php");
        $db = new Database();
        $db->openConnection();
        $staff = new Staff($db, $_SESSION['staff']);
        $res = $staff->recordLabReport($_POST['date'], $_POST['staff'], $_POST['test'], $_POST['diagnosis'], $_POST['patient']);
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
                                    <h3>Record Lab Report</h3>
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
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Lab Staff</label>
                                                <div class="col-sm-7">
                                                    <div class="dropdown">
														<input type="text" onkeyup="getStaff(this);" name="doctors" autocomplete="off" class="form-control" placeholder="Search Staff" id="dDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
													  <div id="dDropdown" class="dropdown-menu bg-light overflow-auto" aria-labelledby="pDropdownMenuButton" style="z-index: 99; max-height: 300px;">
													  </div>
													  <input type="hidden" name="staff" value="" required>
													</div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Test date</label>
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

            function getStaff(input){
				const url = 'search_staff.php?searchString='+input.value;

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
        </script>
        <?php require_once("scripts.php"); ?>
    </body>
</html>