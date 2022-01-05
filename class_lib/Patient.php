<?php
    require_once("User.php");
    require_once("Staff.php");
    class Patient extends User{
        //The private as used here is an access modifier
        private $patientId;
        function __construct($db, $id=-2){
            $this->db = $db;
            $this->db->openConnection();
            if($id > 0){
                $qry = "SELECT * FROM patients WHERE id = ?";
                $data = [$id];

                $res = $this->db->selectOne($qry, $data);
                if($res['status']){
                    $this->patientId = $res['data']['id'];
                    parent::__construct($this->db, $res['data']['user']);
                }
                
            }
        }

        function save(){
            $this->db->beginTransaction();
            
            $res = parent::save();
            if($res['status']){
                $qry = "INSERT INTO patients (user) VALUES (?)";
                $data = [$res['id']];
                
                $res = $this->db->insert($qry, $data);
                if($res['status']){
                    $this->db->commitTransaction();
                    return $res;
                }else{
                    $this->db->rollBack();
                    return ['status'=>0, 'error'=>"Could not save Patient Info"];
                }
            
            }else{
                $this->db->rollBack();
                return ['status'=>0, 'error'=>"Could not save Patient Info"];
            }
        }

        public function getPatientId(){
            return $this->patientId;
        }

        function viewLabReports(){
            $qry = "SELECT * FROM lab_reports WHERE patient = ?";
            $data = [$this->patientId];
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
                    'diagnosis'=>$report['diagnosis'],
                    'treatment'=>$report['treatment']
                ];
            }
            return $reports;
        }

        function bookAppointment($doctor, $date, $time){
            if($date < Date("Y-m-d")){
                return ['status'=>0, 'message'=>"Invalid Date entered."];
            }
            $qry = "INSERT INTO appointments (doctor, date, time, patient) VALUES (?, ?, ?, ?)";
            $data = [$doctor, $date, $time, $this->patientId];
            return $this->db->insert($qry, $data);
        }

        function updateAppointment($id, $doctor, $date, $time){
            if($date < Date("Y-m-d")){
                return ['status'=>0, 'message'=>"Invalid Date entered."];
            }
            $qry = "UPDATE appointments SET doctor = ?, date = ?, time = ? WHERE id = ?";
            $data = [$doctor, $date, $time, $id];
            return $this->db->update($qry, $data);
        }

        function deleteAppointment($id){
            $qry = "DELETE FROM appointments WHERE id = ?";
            $data = [$id];
            return $this->db->delete($qry, $data);
        }

        function getAppointments(){
            $qry = "SELECT * FROM appointments WHERE patient = ?";
            $data = [$this->patientId];
            $res = $this->db->selectMany($qry, $data);
            $appointments = [];
            foreach($res['data'] as $appointment){
                $doctor = new Staff($this->db, $appointment['doctor']);
                $appointments[count($appointments)] = [
                    'id'=>$appointment['id'],
                    'date'=> $appointment['date'], 
                    'time'=>$appointment['time'], 
                    'doctor'=>$doctor, 
                    'status'=>$appointment['status']
                ];
            }
            return $appointments;
        }

        function updateProfile($fname, $lname, $email, $gender, $address, $dob, $phone, $nokfname, $noklname, $nokphone, $nokaddress){
            //$this = new Patient($this->db, $id);
            
            $this->setFName($fname);
            $this->setLName($lname);
            $this->setEmail($email);
            $this->setGender($gender);
            $this->setAddress($address);
            $this->setDOB($dob);
            $this->setPhone($phone);
            $this->setNOKFName($nokfname);
            $this->setNOKLname($noklname);
            $this->setNOKPhone($nokphone);
            $this->setNOKAddress($nokaddress);
            $this->setPassword("pass");
            $res = $this->update();
            return $res;
        }
    }