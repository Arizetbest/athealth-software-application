<?php
    class Drug{
        private $db;
        private $id;
        private $name;
        private $qty;
        private $sold;

        function __construct($db, $id=-2){
            $this->db = $db;
            $this->db->openConnection();
            if($id > 0){
                $qry = "SELECT * FROM drugs WHERE id = ?";
                $data = [$id];
                $res = $this->db->selectOne($qry, $data);
                if($res['status']){
                    $this->id = $res['data']['id'];
                    $this->name = $res['data']['name'];
                    $this->qty = $res['data']['qty'];
                    $this->sold = $res['data']['sold'];
                }
                
            }
        }

        function getId(){
            return $this->id;
        }

        function getName(){
            return $this->name;
        }

        function setName($name){
            $this->name = $name;
        }

        function setQty($qty){
            $this->qty = $qty;
        }

        function getQty(){
            return $this->qty;
        }

        function setSold($sold){
            $this->sold = $sold;
        }

        function getSold(){
            return $this->sold;
        }

        function save(){
            $qry = "INSERT INTO drugs (name, qty) VALUES (?, ?)";
            $data = [$this->name, $this->qty];
            return $this->db->insert($qry, $data);
        }

        function update(){
            $qry = "UPDATE drugs SET name = ?, qty = ?, sold = ? WHERE id = ?";
            $data = [$this->name, $this->qty, $this->sold, $this->id];
            return $this->db->update($qry, $data);
        }
    }