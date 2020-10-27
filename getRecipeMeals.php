<?php

require_once('connection.php');

try{
    $q = $db->prepare('SELECT * FROM allmeals'); 
    $q->execute(); 
    $data = $q->fetchAll(); 

    //get random recipe id
    $randomNumber = rand(0,count($data) -1 );
    $recipeId = $data[$randomNumber]->RecipeID;
    
    //tags
    $sql = $db->prepare("CALL getTags(?)");
    $sql->bindParam(1, $recipeId, PDO::PARAM_INT);  
    $sql->execute();
    $tags = $sql->fetchAll(); 

    $tagsArr = []; 

    foreach($tags as $tag){
        array_push($tagsArr, $tag->Name);
    }

    //ingredients  
    include('getIngredients.php');

    //push everyting to one array
    $all->recipe = $data[$randomNumber];
    $all->tags = $tagsArr;
    $all->ingredients = $ingredientsArr ;

    echo json_encode($all);
    
} catch(PDOExecption $ex){
    echo $ex; 
}