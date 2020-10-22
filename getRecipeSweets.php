<?php

require_once('connection.php');

try{

       // ///////////// All Sweets
    $q = $db->prepare('SELECT * FROM allsweets'); 
    $q->execute(); 
    $data = $q->fetchAll(); 
    //echo json_encode($data[0]);

   $randomNumber = rand(0,count($data) -1 );
 
   $recipeId = $data[$randomNumber]->RecipeID;

  // echo $recipeId ;
    
    // ///////////// Tags  
    $sql = $db->prepare("CALL getTags(?)");
    // One bindParam() call per parameter
    $sql->bindParam(1, $recipeId, PDO::PARAM_INT);  
    // call the stored procedure
    $sql->execute();
    $tags = $sql->fetchAll(); 

    //echo json_encode($tags);

    $tagsArr = []; 

    foreach($tags as $tag){
        array_push($tagsArr, $tag->Name);
    }

    //echo json_encode($tagsArr);

    // ///////////// Ingredients  
    include('getIngredientsSweets.php');
    //print_r($ingredientsArr );



   $all->recipe = $data[$randomNumber];
   $all->tags = $tagsArr;
    $all->ingredients = $ingredientsArr ;

    echo json_encode($all);

  

    
} catch(PDOExecption $ex){
    echo $ex; 

}