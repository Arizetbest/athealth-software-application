<?php
    require_once("log.php");
    
    $colleagues = $staff->viewStaff();
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
                                    <h3>Staff</h3>
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
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>email</th>
                                                    <th>Address</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach($colleagues as $colleague){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; $i++; ?></td>
                                                        <td><?php echo $colleague->getFName()." ".$colleague->getLName(); ?></td>
                                                        <td><?php echo $colleague->getPhone(); ?></td>
                                                        <td><?php echo $colleague->getEmail(); ?></td>
                                                        <td><?php echo $colleague->getAddress(); ?></td>
                                                        <td>
                                                            <a class="btn btn-sm btn-dark" href="view_single_staff.php?id=<?php echo $colleague->getStaffId(); ?>">View more</a>
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