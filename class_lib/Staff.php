<?php
//require_once is used to add other files to this file.
require_once("Database.php");
require_once("User.php");
require_once("Patient.php");

class Staff extends User{
    private $staffId;
    private $type;
    private $level;
    private $dutyPeriod;
    private $employmentDate;

    function __construct($db, $id=-2){
        $this->db = new Database();
        $this->db->openConnection();
        $qry = "SELECT * FROM staff WHERE id = ?";
        $data = [$id];

        $res = $this->db->selectOne($qry, $data);
        if($res['status']){
            $staff = $res['data'];
            $this->staffId = $staff['id'];
            $this->type = $staff['type'];
            $this->level = $staff['level'];
            $this->dutyPeriod = $staff['duty_period'];
            $this->employmentDate = $staff['employment_date'];

            //calling parent(User) class constructor in order to initialize parent class properties 
            parent::__construct($this->db, $staff['user']);
        }else{
            $this->db = null;
        }
    }

    function getStaffId(){
        return $this->staffId;
    }

    function getType(){
        return $this->type;
    }

    function getLevel(){
        return $this->level;
    }

   

    function getEmploymentDate(){
        return $this->employmentDate;
    }

    function addStaff($fname, $lname, $email, $gender, $address, $dob, $phone, $nokfname, $noklname, $nokphone, $nokaddress, $employmentDate, $type, $level, $dutyPeriod, $pass){
        //Starting a transaction because adding a staff requires entries into two tables
        //and we need both entries to either be successfull or both fail
        $this->db->beginTransaction();
        $user = new User($this->db);
        $user->setFName($fname);
        $user->setLName($lname);
        $user->setEmail($email);
        $user->setGender($gender);
        $user->setAddress($address);
        $user->setDOB($dob);
        $user->setPhone($phone);
        $user->setNOKFName($nokfname);
        $user->setNOKLname($noklname);
        $user->setNOKPhone($nokphone);
        $user->setNOKAddress($nokaddress);
        $user->setPassword($pass);
        $res = $user->save();
        
        if($res['status']){
            $qry = "INSERT INTO staff (employment_date, type, user, level, duty_period) VALUES (?, ?, ?, ?, ?)";
            $data = [$employmentDate, $type, $res['id'], $level, $dutyPeriod];
            $res = $this->db->insert($qry, $data);
            if($res['status']){
                $this->db->commitTransaction();
                return $res;
            }else{
                $this->db->rollBack();
                return $res;
            }
        }else{
            $this->db->rollBack();
            return $res;
        }
    }

    function viewStaff(){
        $qry = "SELECT id FROM staff";
        $data = [];
        $res = $this->db->selectMany($qry, $data);
        $staff = [];
        foreach($res['data'] as $staffId){
            $staff[count($staff)] = new Staff($this->db, $staffId['id']);
        }
        return $staff;
    }

    function searchStaff($search){
        $qry = "SELECT s.id FROM staff s, users u WHERE (u.first_name LIKE ? OR u.last_name LIKE ?) AND s.user = u.id";
        $data = ['%'.$search.'%', '%'.$search.'%'];
        $res = $this->db->selectMany($qry, $data);
        $staff = [];
        foreach($res['data'] as $doctor){
            $staff[count($staff)] = new Staff($this->db, $doctor['id']);
        }
        return $staff;
    }

    function getDoctors(){
        $qry = "SELECT s.id FROM staff s, users u WHERE s.type = ? AND s.user = u.id ORDER BY u.first_name, u.last_name ASC";
        $data = ['doctor'];
        $res = $this->db->selectMany($qry, $data);
        $staff = [];
        foreach($res['data'] as $doctor){
            $staff[count($staff)] = new Staff($this->db, $doctor['id']);
        }
        return $staff;
    }

    function viewSingleStaff($id){
        $qry = "SELECT id FROM staff WHERE id = ?";
        $data = [$id];
        $res = $this->db->selectOne($qry, $data);
        return new Staff($this->db, $res['data']['id']);
    }

    function updateStaff($id, $fname, $lname, $email, $gender, $address, $dob, $phone, $nokfname, $noklname, $nokphone, $nokaddress, $type, $level, $dutyPeriod){
        //Starting a transaction because adding a staff requires entries into two tables
        //and we need both entries to either be successfull or both fail
        $this->db->beginTransaction();
        $tempStaff = new Staff($this->db, $id);

        $user = new User($this->db, $tempStaff->getId());
        $user->setFName($fname);
        $user->setLName($lname);
        $user->setEmail($email);
        $user->setGender($gender);
        $user->setAddress($address);
        $user->setDOB($dob);
        $user->setPhone($phone);
        $user->setNOKFName($nokfname);
        $user->setNOKLname($noklname);
        $user->setNOKPhone($nokphone);
        $user->setNOKAddress($nokaddress);
        $res = $user->update();
        
        if($res['status']){
            $qry = "UPDATE staff SET type = ?, level = ?, duty_period = ? WHERE id = ?";
            $data = [$type, $level, $dutyPeriod, $id];
            $res = $this->db->insert($qry, $data);
            if($res['status']){
                $this->db->commitTransaction();
            }else{
                $this->db->rollBack();
            }
        }else{
            $this->db->rollBack();
        }
    }

    function addPatient($fname, $lname, $email, $gender, $address, $dob, $phone, $nokfname, $noklname, $nokphone, $nokaddress){
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
        $patient->setPassword("pass");
        $res = $patient->save();
        return $res;
    }

    function viewPatients(){
        $qry = "SELECT p.id FROM patients p, users u WHERE p.user = u.id ORDER BY u.first_name, u.last_name ASC";
        $data = [];
        $res = $this->db->selectMany($qry, $data);
        $patients = [];
        foreach($res['data'] as $patientId){
            $patients[count($patients)] = new Patient($this->db, $patientId['id']);
        }
        return $patients;
    }

    function searchPatients($search){
        $qry = "SELECT p.id FROM patients p, users u WHERE (u.first_name LIKE ? OR u.last_name LIKE ?) AND p.user = u.id";
        $data = ['%'.$search.'%', '%'.$search.'%',];
        $res = $this->db->selectMany($qry, $data);
        $patients = [];
        foreach($res['data'] as $patientId){
            $patients[count($patients)] = new Patient($this->db, $patientId['id']);
        }
        return $patients;
    }

    function viewPatient($id){
        $qry = "SELECT id FROM patients WHERE id = ?";
        $data = [$id];
        $res = $this->db->selectOne($qry, $data);
        return new Patient($this->db, $res['data']['id']);
    }

    function getDashboardData(){
        $doctors = $this->searchDoctors('');
        $patients = $this->viewPatients();
        $admissions = $this->viewPatientsOnAdmission();
        $rooms = $this->getRooms();
        $staffByDuty = $this->getStaffByDuty();

        return ['doctors'=>$doctors, 'patients'=>$patients, 'admissions'=>$admissions, 'rooms'=>$rooms, 'staffByDuty'=>$staffByDuty];
    }

    function monthlyAppointments($startDate, $endDate){
        $day = 1;
			$start = new DateTime($startDate); $end = new DateTime($endDate);
			$month = $start->format("m");
			$year = $start->format("Y");
			$monthlyTotal = []; $months = [];
			while ($start <= $end) {
				$qry = "SELECT COUNT(id) AS total FROM appointments WHERE date BETWEEN ? AND ?";
				$data = [$start->format("Y-m-d"), $start->format("Y-m-t")];
				$monthlyAdmission = $this->db->selectOne($qry, $data);//print_r($monthlyAdmission);
				$subtotal = $monthlyAdmission['data']['total'];
				
				$abr = $start->format("M")."-".$start->format("Y");
				$months[] = $abr;
				$monthlyTotal[$abr] = $subtotal;
				$month++;
				$start->setDate($year, $month, $day);
			}
			return $monthlyTotal;
    }

    function pieData(){
        $qry = "SELECT COUNT(id) AS total FROM appointments WHERE status = ?";
        $data = ['attended'];
        $attended = $this->db->selectOne($qry, $data);

        $qry = "SELECT COUNT(id) AS total FROM appointments WHERE status = ?";
        $data = ['pending'];
        $pending = $this->db->selectOne($qry, $data);

        return ['attended'=>$attended['data']['total'], 'pending'=>$pending['data']['total']];
    }

    function bookAppointment($patient, $date, $time){
        $qry = "INSERT INTO appointments (patient, date, time) VALUES (?, ?, ?)";
        $data = [$patient, $date, $time]; 
        return $this->db->insert($qry, $data);
    }

    function getBookedAppointments($date){
        $qry = "SELECT * FROM appointments WHERE date = ?";
        $data = [$date];
        $res = $this->db->selectMany($qry, $data);
        $appointments = [];
        foreach($res['data'] as $appointment){
            $patient = new Patient($this->db, $appointment['patient']);
            $appointments[count($appointments)] = [
                'id'=>$appointment['id'],
                'date'=> $appointment['date'], 
                'time'=>$appointment['time'], 
                'patient'=>$patient, 
                'status'=>$appointment['status']
            ];
        }
        return $appointments;
    }

    function getAppointments($date=''){
        if($date == ''){
            $qry = "SELECT * FROM appointments WHERE doctor = ?";
            $data = [$this->staffId];
        }else{
            $qry = "SELECT * FROM appointments WHERE doctor = ? AND date = ?";
            $data = [$this->staffId, $date];
        }
        $res = $this->db->selectMany($qry, $data);
        $appointments = [];
        foreach($res['data'] as $appointment){
            $patient = new Patient($this->db, $appointment['patient']);
            $appointments[count($appointments)] = [
                'id'=>$appointment['id'],
                'date'=> $appointment['date'], 
                'time'=>$appointment['time'], 
                'patient'=>$patient, 
                'status'=>$appointment['status']
            ];
        }
        return $appointments;
    }

    function updateAppointment($id, $status){
        $qry = "UPDATE appointments SET status = ? WHERE id = ?";
        $data = [$status, $id];
        return $this->db->update($qry, $data);
    }

    function recordLabReport($date, $treatment, $test, $diagnosis, $patient){
        $qry = "INSERT INTO lab_reports (patient, staff, date, test, diagnosis, treatment) VALUES (?, ?, ?, ?, ?, ?)";
        $data = [$patient, $this->staffId, $date, $test, $diagnosis, $treatment];
        return $this->db->insert($qry, $data);
    }

    function viewLabReports($date){
        $qry = "SELECT * FROM lab_reports WHERE date = ?";
        $data = [$date];
        $res = $this->db->selectMany($qry, $data);
        $reports = [];
        foreach($res['data'] as $report){
            $patient = new Patient($this->db, $report['patient']);
            $staff = new Staff($this->db, $report['staff']);
            $reports[count($reports)] = [
                'id'=>$report['id'],
                'date'=> $report['date'], 
                'staff'=>$staff, 
                'patient'=>$patient, 
                'test'=>$report['test'],
                'diagnosis'=>$report['diagnosis']
            ];
        }
        return $reports;
    }

    function getAppointmentStats(){
        $qry = "SELECT COUNT(id) AS total FROM appointments WHERE doctor = ? AND status = ?";
        $data = [$this->staffId, 'attended'];
        $res = $this->db->selectOne($qry, $data);

        $qry = "SELECT COUNT(id) AS total FROM appointments WHERE doctor = ? AND status = ?";
        $data = [$this->staffId, 'pending'];
        $res1 = $this->db->selectOne($qry, $data);

        $qry = "SELECT COUNT(id) AS total FROM appointments WHERE doctor = ? AND status = ?";
        $data = [$this->staffId, 'cancelled'];
        $res2 = $this->db->selectOne($qry, $data);

        return ['attended'=>$res['data']['total'], 'pending'=>$res1['data']['total'], 'cancelled'=>$res2['data']['total']];
    }
    
}


?>