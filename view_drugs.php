<?php
    require_once("log.php");
    if(isset($_POST['submit'])){
        $res = $staff->sellDrug($_POST['drug'], $_POST['qty']);
    }
    
    $drugs = $staff->viewDrugs();
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
                                    <h3>Drugs</h3>
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
                                                        <th>Qty</th>
                                                        <th>Sold</th>
                                                        <th>Stock</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach($drugs as $drug){
                                                            $stock = $drug->getQty() - $drug->getSold();
                                                    ?>
                                                        <tr class="<?php if($stock <= 0){ echo 'bg-danger';} ?>">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $drug->getName(); ?></td>
                                                            <td><?php echo $drug->getQty(); ?></td>
                                                            <td><?php echo $drug->getSold(); ?></td>
                                                            <td><?php echo $drug->getQty() - $drug->getSold(); ?></td>
                                                            <td>
                                                                <?php
                                                                    if($stock > 0){
                                                                ?>
                                                                    <button class="btn btn-sm btn-dark" onclick="showForm(<?php echo 'sell'.$i; ?>)">Sell Drug</a>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <button class="btn btn-sm btn-dark disabled">Out of Stock</button>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="d-none" id="<?php echo 'sell'.$i; ?>">
                                                                <form action="#" method="POST" class="mx-auto">
                                                                    <div class="row mb-3">
                                                                        <input type="hidden" name="drug" value="<?php echo $drug->getId(); ?>" >
                                                                        <div class="col-sm-7">
                                                                            <input type="number" name="qty" class="form-control" id="" placeholder="Quantity">
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <button type="submit" name="submit" class="btn btn-primary">Sell</button>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                            $i++;
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
        <script type="text/javascript">
            function showForm(id){console.log(id)
                //let col = document.querySelector("#"+id);
                id.classList.remove("d-none")
            }
        </script>
        <?php require_once("scripts.php"); ?>
    </body>
</html>