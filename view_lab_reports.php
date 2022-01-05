<?php
    require_once("log.php");

    if(isset($_GET['submit'])){
        $reports = $staff->viewLabReports($_GET['date']);
    }else{
        $reports = $staff->viewLabReports(Date("Y-m-d"));
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
                                    <h3>View Lab Reports</h3>
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
                        <div class="col-12 mb-5">
                            <div class="card mt-3 pb-5 mb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>s/no</th>
                                                        <th>Patient Name</th>
                                                        <th>Lab Staff</th>
                                                        <th>Test Date</th>
                                                        <th>Test</th>
                                                        <th>Diagnosis</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($reports as $report){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $report['patient']->getFName()." ".$report['patient']->getLName(); ?></td>
                                                            <td><?php echo $report['staff']->getFName()." ".$report['staff']->getLName(); ?></td>
                                                            <td><?php echo $report['date']; ?></td>
                                                            <td><?php echo $report['test']; ?></td>
                                                            <td><?php echo $report['diagnosis']; ?></td>
                                                            <td>
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