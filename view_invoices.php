<?php
    require_once("log.php");
    
    $invoices = $staff->viewInvoices(date("Y-m-d", strtotime(date("Y-m-d", strtotime(Date("Y-m-d"))) . " -1 month")), Date("Y-m-d"));
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
                                    <h3>View Invoices</h3>
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
                                                        <th>Invoice Number</th>
                                                        <th>Name</th>
                                                        <th>Invoice Date</th>
                                                        <th>Due Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($invoices as $invoice){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $invoice->getInvoiceNumber(); ?></td>
                                                            <td><?php echo $invoice->getPatient()->getFName()." ".$invoice->getPatient()->getLName(); ?></td>
                                                            <td><?php echo $invoice->getDate(); ?></td>
                                                            <td><?php echo $invoice->getDueDate(); ?></td>
                                                            <td>
                                                                <a class="btn btn-sm btn-dark" href="view_invoice.php?id=<?php echo $invoice->getId(); ?>">View more</a>
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