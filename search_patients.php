<?php
    require_once("log.php");
    $patients = $staff->searchPatients($_GET['searchString']);
    $res = [];
    for($i=0; $i < count($patients); $i++){
        $res[$i]['id'] = $patients[$i]->getPatientId();
        $res[$i]['first_name'] = $patients[$i]->getFName();
        $res[$i]['last_name'] = $patients[$i]->getLName();
        $res[$i]['email'] = $patients[$i]->getEmail();
        $res[$i]['address'] = $patients[$i]->getAddress();
    }
    echo json_encode($res);
    exit();