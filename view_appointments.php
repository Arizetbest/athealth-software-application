<?php
    require_once("log.php");

    if(isset($_POST['update'])){
        $res = $staff->updateAppointment($_POST['id'], $_POST['status']);
    }
    if(isset($_GET['submit'])){
        $appointments = $staff->getBookedAppointments($_GET['date']);
    }else{
        $appointments = $staff->getBookedAppointments(Date("Y-m-d"));
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
                                <div class="card-body d-flex justify-content-between">
                                    <h3>View Booked Appointments</h3>
                                    <div>
                                        <form action="#" method="GET" class="d-flex">
                                            <div>
                                                <input type="date" name="date" class="form-control">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-sm btn-dark">
                                                View
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3 pb-4 mb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th>Change Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($appointments as $appointment){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; $i++; ?></td>
                                                            <td><?php echo $appointment['patient']->getFName()." ".$appointment['patient']->getLName(); ?></td>
                                                            <td><?php echo $appointment['date']; ?></td>
                                                            <td><?php echo $appointment['time'].":00"; ?></td>
                                                            <td><?php echo $appointment['status']; ?></td>
                                                            <td>
                                                                <form action="#" method="POST">
                                                                    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>" />
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="">Select Status</option>
                                                                        <option value="pending">Pending</option>
                                                                        <option value="cancelled">Cancelled</option>
                                                                        <option value="attended">Attended</option>
                                                                    </select>
                                                                    <button class="btn btn-sm btn-dark" name="update">Change Status</button>
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