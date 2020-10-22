<?php

try{
    $dbUserName = 'root'; 
    $dbPassword = 'root'; 
    $connection = 'mysql:host=localhost; port=8889; dbname=recipe_tinder; charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,   //allows us to use Try - Catch
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ  //allows us to use JSON obj
        //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]; 

    $db = new PDO($connection, $dbUserName, $dbPassword, $options);

    

} catch(PDOExeption $ex){
    echo $ex; 

}