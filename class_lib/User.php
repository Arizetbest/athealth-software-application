<?php
    require_once("Database.php");
    class User{
        // protected as used here means that all properties  as used here can only  be accessed in the user class & child classes of the user class 
        protected $db = null;
        protected $id; 
        protected $fname;
        protected $lname;
        protected $email;
        protected $address;
        protected $gender;
        protected $dob;
        protected $phone;
        protected $nokFName;
        protected $nokLName;
        protected $nokPhone;
        protected $nokAddress;
        private $password;
        protected $status;

        function __construct($db ,$id = -2){ 
            $this->db = $db;
            $this->db->openConnection();
            if($id > 0){
                $qry = "SELECT * FROM users WHERE id = ?";
                $data = [$id];
                $res = $this->db->selectOne($qry, $data);
                if($res['status']){
                    
                    $user = $res['data'];
                    $this->id = $user['id'];
                    $this->fname = $user['first_name'];
                     $this->lname = $user['last_name'];
                     $this->email = $user['email'];
                     $this->address = $user['address'];
                     $this->gender = $user['gender'];
                     $this->dob = $user['dob'];
                     $this->phone = $user['phone'];
                     $this->nokFName = $user['nok_first_name'];
                     $this->nokLName = $user['nok_last_name'];
                     $this->nokPhone = $user['nok_phone'];
                     $this->nokAddress = $user['nok_address'];
                     $this->status = $user['status'];
                }
            }
        }

        //Creating getters and setters for class properties
        function getId(){
            return $this->id;
        }

        function getFName(){
            return $this->fname;
        }

        function setFName($fname){
            $this->fname = $fname;
        }

        function getLName(){
            return $this->lname;
        }

        function setLName($lname){
            $this->lname = $lname;
        }

        function getEmail(){
            return $this->email;
        }

        function setEmail($email){
            $this->email = $email;
        }

        function getAddress(){
            return $this->address;
        }

        function setAddress($address){
            $this->address = $address;
        }

        function getGender(){
            return $this->gender;
        }

        function setGender($gender){
            $this->gender = $gender;
        }

        function getDOB(){
            return $this->dob;
        }

        function setDOB($dob){
            $this->dob = $dob;
        }

        function getPhone(){
            return $this->phone;
        }

        function setPhone($phone){
            $this->phone = $phone;
        }

        function getNOKFName(){
            return $this->nokFName;
        }

        function setNOKFName($nokFName){
            $this->nokFName = $nokFName;
        }

        function getNOKLName(){
            return $this->nokLName;
        }

        function setNOKLName($nokLName){
            $this->nokLName = $nokLName;
        }

        function getNOKAddress(){
            return $this->nokAddress;
        }

        function setNOKAddress($nokAddress){
            $this->nokAddress = $nokAddress;
        }

        function getNOKPhone(){
            return $this->nokPhone;
        }

        function setNOKPhone($nokPhone){
            $this->nokPhone = $nokPhone;
        }

        function setPassword($password){
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }

        //Save user to database
        function save(){
            $qry = "INSERT INTO users (first_name, last_name, email, password, gender, dob, phone, address, nok_first_name, nok_last_name, nok_phone, nok_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $data = [$this->fname, $this->lname, $this->email, $this->password, $this->gender, $this->dob, $this->phone, $this->address, $this->nokFName, $this->nokLName, $this->nokPhone, $this->nokAddress];
            
            return $this->db->insert($qry, $data);
        }

        function update(){
            $qry = "UPDATE users SET first_name = ?, last_name = ?, email = ?, gender = ?, dob = ?, phone = ?, address = ?, nok_first_name = ?, nok_last_name = ?, nok_phone = ?, nok_address = ? WHERE id = ?";
            $data = [$this->fname, $this->lname, $this->email, $this->gender, $this->dob, $this->phone, $this->address, $this->nokFName, $this->nokLName, $this->nokPhone, $this->nokAddress, $this->id];
            
            return $this->db->update($qry, $data);
        }

        function searchDoctors($search){
            $qry = "SELECT s.id FROM staff s, users u WHERE (u.first_name LIKE ? OR u.last_name LIKE ?) AND s.type = ? AND s.user = u.id";
            $data = ['%'.$search.'%', '%'.$search.'%', 'doctor'];
            $res = $this->db->selectMany($qry, $data);
            $doctors = [];
            foreach($res['data'] as $doctor){
                $doctors[count($doctors)] = new Staff($this->db, $doctor['id']);
            }
            return $doctors;
        }

        
        public function getStatus(){
            return $this->status;
        }

        function deactivate(){
            $qry = "UPDATE users SET status = ? WHERE id = ?";
            $data = [false, $this->id];
            
            return $this->db->update($qry, $data);
        }

        function activate(){
            $qry = "UPDATE users SET status = ? WHERE id = ?";
            $data = [true, $this->id];
            
            return $this->db->update($qry, $data);
        }

    }
?>