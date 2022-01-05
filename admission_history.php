<?php
    require_once("log.php");

    if(isset($_POST['discharge'])){
        $res = $staff->dischargePatient($_POST['id']);
    }
    
    $patients = $staff->viewAdmissionHistory();
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
                                    <h3>Admission History</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3 pb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient Name</th>
                                                        <th>Doctor</th>
                                                        <th>Admission Date</th>
                                                        <th>Reason</th>
                                                        <th>Room</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($patients as $patient){
                                                    ?>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><?php echo $patient['patient']->getFName()." ".$patient['patient']->getLName(); ?></td>
                                                            <td><?php echo $patient['doctor']->getFName()." ".$patient['doctor']->getLName(); ?></td>
                                                            <td><?php echo $patient['date']; ?></td>
                                                            <td><?php echo $patient['reason']; ?></td>
                                                            <td><?php echo $patient['room']; ?></td>
                                                            <td>
                                                                <?php echo $patient['release_date']; ?>
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
                
            </div>
            <?php require_once("footer.php"); ?>
        </div>
        <?php require_once("scripts.php"); ?>
    </body>
</html>