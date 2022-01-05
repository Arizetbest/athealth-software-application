<?php
    require_once("Database.php");
    require_once("Patient.php");

    class Room{
        private $db;
        private $id;
        private $roomNumber;
        private $capacity;

        function __construct($db, $id=-3){
            $this->db = $db;
            $this->db->openConnection();
            if($id>0){
                $qry = "SELECT * FROM rooms WHERE id = ?";
                $data = [$id];
                $res = $this->db->selectOne($qry, $data);
                if($res['status']){
                    $room = $res['data'];
                    $this->id = $room['id'];
                    $this->roomNumber = $room['number'];
                    $this->capacity = $room['capacity'];
                }
            }
        }

        function getId(){
            return $this->id;
        }

        function getRoomNumber(){
            return $this->roomNumber;
        }

        function setRoomNumber($number){
            $this->roomNumber = $number;
        }

        function getRoomCapacity(){
            return $this->capacity;
        }

        function setRoomCapacity($capacity){
            $this->capacity = $capacity;
        }

        //function to get the currently admitted patients placed in the room
        function getOccupants(){
            $qry = "SELECT * FROM patient_admissions WHERE room = ? AND release_date = ?";
            $data = [$this->id, "0000-00-00"];
            $res = $this->db->selectMany($qry, $data);
            $patients = [];
            if($res['status']){
                $resultData = $res['data'];
                
                foreach($resultData as $patient){
                    $patients[count($patient)] = new Patient($this->db, $patient['patient']);
                }
            }
            return $patients;
        }

        function roomDetails(){
            $occupants = $this->getOccupants();
            return [
                "number"=> $this->roomNumber,
                "capacity"=> $this->capacity,
                "occupants"=> $occupants,
                "free_space"=> $this->capacity - count($occupants)
            ];
        }

        function save(){
            $qry = "INSERT INTO rooms (number, capacity) VALUES (?, ?)";
            $data = [$this->roomNumber, $this->capacity];

            $res = $this->db->insert($qry, $data);
            return $res;
        }

        function update(){
            $qry = "UPDATE rooms SET number = ?, capacity = ? WHERE id = ?";
            $data = [$this->roomNumber, $this->capacity, $this->id];

            $res = $this->db->update($qry, $data);
            return $res;
        }
    }

    // $db = new Database();
    // $db->openConnection();

    // $room = new Room($db, 1);
    // $room->setRoomCapacity(3);
    // $room->setRoomNumber(2);
    // print_r($room->save());
    //print_r($room->roomDetails());


