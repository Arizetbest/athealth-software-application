<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        $res = $patient->bookAppointment($_POST['doctor'], $_POST['date'], $_POST['time']);
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
                <?php //require_once("sidebar.php"); ?>
                <div class="col-md-12">
                    <!-- Main area -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h3>Book Appointment</h3>
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
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Doctor</label>
                                                <div class="col-sm-7">
                                                    <div class="dropdown">
														<input type="text" onkeyup="getDoctors(this);" name="doctors" autocomplete="off" class="form-control" placeholder="Search Doctors" id="pDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
													    <div id="dropdown" class="dropdown-menu bg-light overflow-auto" aria-labelledby="pDropdownMenuButton" style="z-index: 99; max-height: 300px;">
                                                            
                                                        </div>
													    <input type="hidden" class="products" name="doctor" value="" required>
													</div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Appointment date</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date" min="<?php echo Date("Y-m-d"); ?>" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Time</label>
                                                <div class="col-sm-7">
                                                    <select name="time" class="form-control">
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
        </script>
        <?php require_once("scripts.php"); ?>
    </body>
</html>