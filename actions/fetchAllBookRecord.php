<?php
require 'config/config.php';

class bookRecord extends Database{

    public function fetch_record(){

        $sql="SELECT * FROM book";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();

        $array=array();
        
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $array[]=$row;
        }
        return $array;

    }

}

$bookRecord=new bookRecord;
$allBook=$bookRecord->fetch_record();

?>