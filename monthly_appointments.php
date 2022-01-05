<?php
    require_once("log.php");
    if(isset($_GET['startDate']) && isset($_GET['endDate'])){
		$details = $staff->monthlyAdmissions($_GET['startDate'], $_GET['endDate']);
		echo json_encode($details);
		exit();
	}