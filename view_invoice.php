<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        $res = $staff->makePayment($_GET['id'], $_POST['amount'], $_POST['method'], $_POST['date']);
    }
    
    $invoice = $staff->getInvoice($_GET['id']);
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
                                    <h3>Invoice</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mt-3 pb-4">
                                <!-- <div class="card-header">
                                    <h3></h3>
                                </div> -->
                                <div class="card-body">
                                    <div class="col mb-0">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Invoice Number</td>
                                                    <td><?php echo $invoice->getInvoiceNumber(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Patient</td>
                                                    <td><?php echo $invoice->getPatient()->getFName()." ".$invoice->getPatient()->getLName(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td><?php echo $invoice->getDate(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Staff</td>
                                                    <td><?php echo $invoice->getStaff()->getFName()." ".$invoice->getStaff()->getLName(); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3 pb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>s/no</th>
                                                    <th>Item</th>
                                                    <th>Cost</th>
                                                    <th>Qty</th>
                                                    <th>Subt.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $items = $invoice->getItems();
                                                    $total = 0; $i = 1;
                                                    foreach($items as $item){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; $i++; ?></td>
                                                        <td><?php echo $item['item']; ?></td>
                                                        <td><?php echo $item['cost']; ?></td>
                                                        <td><?php echo $item['qty']; ?></td>
                                                        <td><?php echo $item['qty'] * $item['cost']; $total += $item['qty'] * $item['cost'];?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total:</td>
                                                        <td><?php echo $total;?></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mt-3 pb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>s/no</th>
                                                    <th>amount</th>
                                                    <th>method</th>
                                                    <th>date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $payments = $invoice->getPayments();
                                                    $i = 1;
                                                    foreach($payments as $payment){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; $i++; ?></td>
                                                        <td><?php echo $payment['amount']; ?></td>
                                                        <td><?php echo $payment['method']; ?></td>
                                                        <td><?php echo $payment['date']; ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3 pb-4">
                                <div class="card-body">
                                    <div class="col mb-0">
                                    <form action="#" method="POST" class="mx-auto">
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Amount</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="amount" class="form-control" id="inputEmail3" placeholder="Amount">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Method</label>
                                                <div class="col-sm-7">
                                                    <select name="method" class="form-control">
                                                        <option value="">Select Method</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="bank_transfer">Bank Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 ms-2 col-form-label">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="date" name="date" class="form-control" id="inputEmail3" placeholder="date">
                                                </div>
                                            </div>

                                            <div class="offset-md-2">
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
        <?php require_once("scripts.php"); ?>
    </body>
</html>