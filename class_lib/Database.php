<?php
Class Database{

    private  $server = "mysql:host=us-cdbr-east-05.cleardb.net;dbname=heroku_2a2fe327587559c";
    private  $user = "b48faa5e8fed6c";
    private  $pass = "7c6075f7";
    private $options  = array(PDO::ATTR_PERSISTENT=> true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);//PDO::ATTR_PERSISTENT=> true,
    protected $dbconnection;

    function __construct(){
        if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){
            $this->server = "mysql:host=localhost;dbname=hospital";
            $this->user = "root";
            $this->pass = "";
        }
    }
     
    //openConnection function to actually create a connection to the database using the properties defined above.
    public function openConnection(){
        try{
          $this->dbconnection = new PDO($this->server, $this->user,$this->pass,$this->options);
          return $this->dbconnection;
        }
        catch (PDOException $e){
          echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    //Insert function to handle all inserts into the database through out the application
    public function insert($qry, $data){
        try{
            $qry = $this->dbconnection->prepare($qry);
            $res = $qry->execute($data);
            return ['status'=> $res, 'id'=> $this->dbconnection->lastInsertId(), 'message'=>"Data saved successfully"];
        }catch(Exception $e){print_r($e);
            return ['status'=>0, 'error'=>$e, 'message'=>"An Error occurred while saving"];
        }
    }

    //selectone function to select a single row of data from the database
    public function selectOne($qry, $data){
        try{
            $qry = $this->dbconnection->prepare($qry);
            $res = $qry->execute($data);
            return ['status'=> $res, 'data'=> $qry->fetch(PDO::FETCH_ASSOC)];
        }catch(Exception $e){print_r($e);
            return ['status'=>0, 'error'=>$e, 'message'=>"An error occurred while fetching data"];
        }
    }

    //selectMany function to fetch multiple rows of data from the database
    public function selectMany($qry, $data){
        try{
            $qry = $this->dbconnection->prepare($qry);
            $res = $qry->execute($data);
            return ['status'=> $res, 'data'=> $qry->fetchAll(PDO::FETCH_ASSOC)];
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e, 'message'=>"An error occurred while fetching data"];
        }
    }

    //update function to update data in the database
    public function update($qry, $data){
        try{
            $qry = $this->dbconnection->prepare($qry);
            $res = $qry->execute($data);
            return ['status'=> $res, 'message'=>"Data updated successfully"];
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e, 'message'=>"An error occurred while updating data"];
        }
    }

    //delete function to delete data in the database
    public function delete($qry, $data){
        try{
            $qry = $this->dbconnection->prepare($qry);
            $res = $qry->execute($data);
            return ['status'=> $res, 'message'=>"Data deleted successfully"];
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e, 'message'=>"An error occurred while deleting data"];
        }
    }

    //Function to create a transaction when we have multiple queries that must be executed altogether
    public function beginTransaction(){
        try{
            $this->dbconnection->beginTransaction();
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e];
        }
    }

    //when executing multiple queries and some fail, the rollBack function is used to tell the database to cancel all the queries already executed
    public function rollBack(){
        try{
            $this->dbconnection->rollBack();
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e];
        }
    }

    //When executing multiple queries, if all are successfull we use the commitTransaction function to ask the database to persist all queries
    public function commitTransaction(){
        try{
            $this->dbconnection->commit();
        }catch(Exception $e){
            return ['status'=>0, 'error'=>$e];
        }
    }

    //closeConnection function used to close the connection to the database when it's no longer in use
    public function closeConnection() {
         $this->con = null;
    }
}
?>