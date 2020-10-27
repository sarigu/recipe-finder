<?php

require_once('getRecipeMeals.php');

try{
    $sql = $db->prepare("CALL getIngredients(?)");
    $sql->bindParam(1, $recipeId, PDO::PARAM_INT);  
    $sql->execute();
    $ingredients = $sql->fetchAll(); 

    $ingredientsArr = []; 

    foreach($ingredients as $ingredient){
       $fullIngredient =  $ingredient->Amount  . "  ". $ingredient->Name;
        array_push($ingredientsArr, $fullIngredient);
    }
    
} catch(PDOExecption $ex){
    echo $ex; 

}