<?php
    require_once("log.php");

    $data = $staff->pieData();
    echo json_encode($data);
    exit();