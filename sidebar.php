				<div class="col-12 color-white d-flex d-lg-none" id="menuButtonDiv">
					<span class="fas fa-sliders-h my-2 mr-auto" onclick="showMenu();" id="menu-icon"></span>
					<img src="" class="profile rounded-circle">
				</div>
				<div class="col-md-2 bg-dark pb-5">
                    <!-- Sidebar (navigation) -->
                    <!-- <div class="col-12 my-5 text-center text-white">
						<img src="../images/log/user.jpg" class="side-profile rounded-circle">
						<span class="align-self-center d-block">Abba Bawa</span>
						<span class="align-self-center">abba@gmail.com</span>
					</div> -->
                    <ul class="nav flex-column text-white mt-lg-4 bg-dark" id="menu">
						<div class="d-flex d-lg-none pt-3 pb-4">
							<span class="ms-auto me-4 fa fa-window-close" onclick="dismissMenu();"></span>
						</div>
						<li class="nav-item">
							<a class="nav-link active" href="dashboard.php">
								<span class="fa fa-home me-2"></span>Dashboard</a>
						</li>
						<li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-calendar-check me-2"></span> Appointments</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
								<a class="dropdown-item border-light border-bottom" href="book_appointment.php">Book Appointment</a>
						    	<a class="dropdown-item" href="view_appointments.php">View Booked Appointments</a>
						    </div>
						</li>
						<li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bed me-2"></span> Admissions</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
								<a class="dropdown-item border-light border-bottom" href="admit_patient.php">Admit Patient</a>
						    	<a class="dropdown-item border-light border-bottom" href="view_patients_on_admission.php">View Patients On Admission</a>
						      	<a class="dropdown-item" href="admission_history.php"><span class="fa fa-folder me-2"></span>View Admission History</a>
						    </div>
						</li>
						<li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chart-bar me-2"></span> Lab Reports</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
								<a class="dropdown-item border-light border-bottom" href="record_lab_report.php">Record Lab Report</a>
						      	<a class="dropdown-item" href="view_lab_reports.php"><span class="fa fa-folder me-2"></span>View Reports</a>
						    </div>
						</li>
                        <li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-users me-2"></span> Patients</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
						      <a class="dropdown-item border-light border-bottom" href="view_patients.php">View Patients</a>
						      
						      	<a class="dropdown-item" href="add_patient.php"><span class="fa fa-folder me-2"></span>Add Patient</a>
						    </div>
						</li>
                        <li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-users me-2"></span> Staff</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
						      <a class="dropdown-item border-light border-bottom" href="view_staff.php">View Staff</a>
						      
						      	<a class="dropdown-item" href="add_staff.php"><span class="fa fa-folder me-2"></span>Add Staff</a>
						    </div>
						</li>
                        <li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-money me-2"></span> Invoice</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
						      <a class="dropdown-item border-light border-bottom" href="generate_invoice.php">Generate Invoice</a>
						      
						      	<a class="dropdown-item" href="view_invoices.php"><span class="fa fa-folder me-2"></span>View Invoices</a>
						    </div>
						</li>
                        <li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-medkit me-2"></span> Pharmacy</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
						      <a class="dropdown-item border-dark border-bottom" href="view_drugs.php">View Drugs</a>
						      
						      	<a class="dropdown-item" href="add_drug.php"><span class="fa fa-folder me-2"></span>Add Drug</a>
						    </div>
						</li>
						<li class="nav-item dropdown bg-dark">
						    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-money me-2"></span> Rooms</a>
						    <div class="dropdown-menu border border-light shadow-lg bg-dark">
						      <a class="dropdown-item border-light border-bottom" href="add_room.php">Add room</a>
						      
						      	<a class="dropdown-item" href="view_rooms.php"><span class="fa fa-folder me-2"></span>View Rooms</a>
						    </div>
						</li>
                    </ul>
                </div>