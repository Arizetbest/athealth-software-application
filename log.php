<?php
	session_start();
	//this statement checks if user i
	if (!isset($_SESSION['staff']) && !isset($_SESSION['user'])) {
		header("location:index.php");
	}
	require_once("class_lib/Database.php");
	if($_SESSION['user_type'] == 'doctor' || $_SESSION['user_type'] == 'others'){
		require_once("class_lib/Staff.php");
        
        $db = new Database();
        $db->openConnection();

		$staff = new Staff($db, $_SESSION['staff']);
	}else if($_SESSION['user_type'] == 'patient'){
		require_once("class_lib/Patient.php");
        
        $db = new Database();
        $db->openConnection();

		$patient = new Patient($db, $_SESSION['staff']);
	}
