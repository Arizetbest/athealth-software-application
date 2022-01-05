<nav class="navbar navbar-expand-lg navbar-dark bg-blue border-bottom">
                    <div class="container-fluid">
                      <?php
                        if($_SESSION['user_type'] == 'patient'){
                          $url = 'patient_home.php';
                        }else if($_SESSION['user_type'] == 'doctor'){
                          $url = 'doctor_home.php';
                        }else if($_SESSION['user_type'] == 'others'){
                          $url = 'admin_home.php';
                        }
                      ?>
                      <a class="navbar-brand fw-bold fst-italic" href="<?php echo $url; ?>">ATHEALTH</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent ">
                        <!-- <ul class="navbar-nav mx-auto">
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="patient_book_appointment.php">Book Appointment</a>
                          </li>
                        </ul> -->
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                          <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li> -->
                          <?php
                            if(isset($staff)){
                              $name = $staff->getFName()." ".$staff->getLName();
                            }else{
                              $name = $patient->getFName()." ".$patient->getLName();
                            }
                          ?>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <?php echo $name; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                          </li>
                          <!-- <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                          </li> -->
                        </ul>
                      </div>
                    </div>
                </nav>