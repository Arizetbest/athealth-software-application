<?php
    require_once("log.php");
    $data = $staff->getDashboardData();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("head.php"); ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <?php require_once("navbar.php"); ?>
            </div>
            <div class="row">
                <?php require_once("sidebar.php"); ?>
                <div class="col-md-10">
                    <!-- Main area -->
                    <div class="row pt-4">
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body d-flex p-0">
                                    <div class="col-4 p-3 bg-success text-center">
                                        <span class="fa fa-users mt-2" style="font-size: 30px;"></span>
                                    </div>
                                    <div class="col-8 text-center pb-1">
                                        <span class="fs-2 fw-bol d-block"><?php echo count($data['doctors']); ?></span>
                                        <span class="fw-bold">Doctors</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body d-flex p-0">
                                    <div class="col-4 p-3 bg-primary text-center">
                                        <span class="fa fa-users mt-2" style="font-size: 30px;"></span>
                                    </div>
                                    <div class="col-8 text-center pb-1">
                                        <span class="fs-2 fw-bol d-block"><?php echo count($data['patients']); ?></span>
                                        <span class="fw-bold">Patients</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body d-flex p-0">
                                    <div class="col-4 p-3 bg-warning text-center">
                                        <span class="fa fa-hospital-o mt-2" style="font-size: 30px;"></span>
                                    </div>
                                    <div class="col-8 text-center pb-1">
                                        <span class="fs-2 fw-bol d-block"><?php echo count($data['admissions']); ?></span>
                                        <span class="fw-bold">Admissions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-body d-flex p-0">
                                    <div class="col-4 p-3 bg-success text-center">
                                        <span class="fa fa-bed mt-2" style="font-size: 30px;"></span>
                                    </div>
                                    <div class="col-8 text-center pb-1">
                                        <?php 
                                            $rooms = $data['rooms'];
                                            $num = 0;
                                            foreach($rooms as $room){
                                                $num += $room->roomDetails()['free_space'];
                                            } 
                                        ?>
                                        <span class="fs-2 fw-bol d-block"><?php echo $num; ?></span>
                                        <span class="fw-bold">Beds Avail.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5 mb-5">
                        <div class="col-md-7">
                            <div class="card shadow">
                                <div class="card-body">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" >
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4>Staff on Duty</h4>
                                    <select class="form-control" onchange="showStaffByDuty(this);">
                                        <option value="morning">Morning</option>
                                        <option value="afternoon">Afternoon</option>
                                        <option value="night">Night</option>
                                    </select>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone no.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $staff = $data['staffByDuty'];
                                                foreach($staff as $temp){
                                                    $class = '';
                                                    if($temp->getDutyPeriod() == 'morning'){
                                                        $class = 'morning';
                                                    }else if($temp->getDutyPeriod() == 'afternoon'){
                                                        $class = 'afternoon';
                                                    }else{
                                                        $class = 'night';
                                                    }
                                            ?>
                                                    <tr class="staff <?php echo $class." ".($class == 'morning' ? '' : 'd-none'); ?>">
                                                        <td><?php echo $temp->getFName()." ".$temp->getLName(); ?></td>
                                                        <td><?php echo "+370 ".$temp->getPhone(); ?></td>
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
            let url = 'monthly_admissions.php?startDate='+start.toISOString()+"&endDate="+end.toISOString()
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
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: '# admissions',
                            data: totals,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
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
            </script>
    </body>
</html>