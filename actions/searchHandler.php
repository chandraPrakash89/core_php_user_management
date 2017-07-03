<?php
session_start();
require '../config/config.php';
if(isset($_SESSION['searchedBook'])){
      unset($_SESSION['searchedBook']);
}

class searchBook extends Database{

    public function search_book($title,$author,$publisher){
        $sql="SELECT * FROM book WHERE title=:title OR author=:author OR publisher=:publisher";
        $stmt = $this->con->prepare($sql);

        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':publisher', $publisher);
        
        $stmt->execute();

        $array=array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $array[]=$row;
        }
        //return($array);
         if(!empty($array)){
            $_SESSION['searchedBook'] = $array; 
            $location="../welcome.php";
            $message="Book has been successfully found";
            header("Location: $location?message=$message");
        }
        else{
            $location="../welcome.php";
            $message="There is no Book for entered details!";
            header("Location: $location?error_msg=$message");

        }


    }


}
if(isset($_POST['submit'])){
$title=$_POST['title'];
$author=$_POST['author'];
$publisher=$_POST['publisher'];

$searchBook=new searchBook;
$allBook=$searchBook->search_book($title,$author,$publisher);
}
?>