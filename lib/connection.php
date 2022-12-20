<?php 

try{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=database_trider','root','');
    //echo'Connection Successful!';

    
}catch(PDOException $f){
    
    echo $f->getmessage();
}


?>