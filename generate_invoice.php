<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        $items = [];
        for($i=0; $i<count($_POST['items']); $i++){
            $items[$i] = ['item'=>$_POST['items'][$i], 'cost'=>$_POST['price'][$i], 'qty'=>$_POST['qty'][$i]];
        }
        $res = $staff->generateInvoice($_POST['patient'], $_POST['date'], $_POST['dueDate'], $items);
        //print_r($res);
    }
    $rooms = $staff->getRooms();
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
                                    <h3>Generate Invoice</h3>
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
													  <input type="hidden" class="products" name="patient" value="" required>
													</div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Date Generated</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-3 ms-2 col-form-label">Due Date</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="dueDate" class="form-control" id="" placeholder="">
                                                </div>
                                            </div>
                                            <table class="table table-striped col-12">
											  <thead class="">
											    <tr>
											      <th scope="col">Item</th>
											      <th scope="col">Cost</th>
											      <th scope="col">Quantity</th>
											      <th scope="col"></th>
											    </tr>
											  </thead>
											  <tbody id="tableBody">
											  	<tr id="row">
											      <td class="">
														<input type="text" name="items[]" autocomplete="off" class="form-control" placeholder="Item" required>
												  </td>
											      <td class="">
											      	<input type="number" id="price1" name="price[]" class="form-control price" placeholder="Price" required>

											      </td>
											      <td class="">
											      	<input type="number" name="qty[]" class="form-control qty" placeholder="Quantity" onfocusout="subTotal(this)" required>
											      </td>
											      <td class="">
											      	<button type="button" name="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button>
											      </td>
											    </tr>
											  </tbody>
											</table>
											<div class="form-group row">
											    <div class="col-sm-12 d-flex">
											      <button type="button" name="button" class="btn btn-primary ml-auto" onclick="addRow();">Add Item</button>
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
            var tableBody = document.getElementById("tableBody")
			count = 0
			function addRow(){
				var newRow = document.getElementById("row").cloneNode(true);
				newRow.id = "row"+count
				newRow.children[0].children[0].id = "d"+count
				// newRow.children[0].children[0].children[1].id = newRow.children[0].children[0].children[1].id+count
				// newRow.children[0].children[0].children[1].innerHTML = ""
				// newRow.children[0].children[0].children[0].id = "p"+count
				count++;
				newRow.children[1].children[0].value = ""
				newRow.children[2].children[0].value = ""
				newRow.children[3].children[0].value = ""
				tableBody.appendChild(newRow);
				
				
			}

			function deleteRow(btn){
				if (tableBody.children.length > 1) {
					var row = btn.parentNode.parentNode;
					row.parentNode.removeChild(row);
					count--;
				}
			}
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
				}).then((response) => response.json().then((data)=>{console.log(data)

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

			function select(pid, input){console.log("here", input, pid)
				//alert(input[1].id)
				input.value = pid.dataset.fname+" "+pid.dataset.lname
				//input.parentNode.parentNode.children[1].children[0].value = pid.dataset.id
                console.log(input.parentNode.children[2])
				input.parentNode.children[2].value = pid.dataset.id
			}

            function getStaff(input){
				// tableBody.innerHTML = ""
				// if (input == "") {
				// 	table.classList.add("d-none");
				// 	return 0;
				// }
				let result = ['sdfghgfd'];
				const url = 'search_staff.php?searchString='+input.value;

				fetch(url, {
					method: 'GET'
				}).then((response) => response.json().then((data)=>{console.log(data)

					//alert(data[0].name)
					var dropdown = input.parentNode //document.getElementById("dropdown")
					dropdown.children[1].innerHTML = ""
					for(var i =0; i<data.length; i++){
						var item = document.createElement("span");
						item.classList.add("dropdown-item");
						item.innerHTML = data[i].first_name
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