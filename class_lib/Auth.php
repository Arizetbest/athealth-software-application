<?php
	require_once("Database.php");
	require_once("Patient.php");
	class Auth 
	{
		private $db;
		function __construct($db)
		{
			$this->db = $db;
		}

		public function login($email, $password){
			//Login function has 2 steps. First check that the email matches, if it does then check that the password matches.
			$qry = "SELECT * FROM users WHERE email = ?";
			$data = [$email];
			$result = $this->db->selectOne($qry, $data);
			if ($result['status']) {
				$res = $result['data'];
				//Use the password_verify function to confirm password
				if (password_verify($password, $res['password'])) {
					$qry = "SELECT * FROM staff WHERE user = ?";
					$data = [$res['id']];
					$staff = $this->db->selectOne($qry, $data)['data'];//print_r($staff);
					if($staff != ''){
						return ['status'=>1, 'message'=>'Login was successfull.', 'type'=>$staff['type'], 'id'=>$res['id'], 'staffId'=>$staff['id']];
					}
					
					$qry = "SELECT * FROM patients WHERE user = ?";
					$data = [$res['id']];
					$patient = $this->db->selectOne($qry, $data)['data'];
					return ['status'=>1, 'message'=>'Login was successfull.', 'type'=>'patient', 'id'=>$res['id'], 'staffId'=>$patient['id']];
				}
			}
            //$this->dbconnection->closeConnection();
			return ['status'=>0, 'message'=>'Incorrect email or password'];
		}

		public function registerPatient($fname, $lname, $email, $gender, $address, $dob, $phone, $nokfname, $noklname, $nokphone, $nokaddress, $pass){
			$qry = "SELECT * FROM users WHERE email = ?";
			$data = [$email];
			$result = $this->db->selectOne($qry, $data);

			if(isset($result['data']['email'])){
				return ['status'=>0, 'message'=>"The Email you entered has already been registered."];
			}
			
			$patient = new Patient($this->db);
			
			$patient->setFName($fname);
			$patient->setLName($lname);
			$patient->setEmail($email);
			$patient->setGender($gender);
			$patient->setAddress($address);
			$patient->setDOB($dob);
			$patient->setPhone($phone);
			$patient->setNOKFName($nokfname);
			$patient->setNOKLname($noklname);
			$patient->setNOKPhone($nokphone);
			$patient->setNOKAddress($nokaddress);
			$patient->setPassword($pass);
			$res = $patient->save();
			if($res['status']){
				return ['status'=>1, 'message'=>"Registration was successfull."];
			}
			return $res;
		}
	}
	//$auth = new Auth();
	//print_r($auth->login("abbabawa6@gmail.com", "pass"));