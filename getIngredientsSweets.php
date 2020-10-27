<?php

require_once('getRecipeSweets.php');

try{
    $sql = $db->prepare("CALL getIngredients(?)");
    $sql->bindParam(1, $recipeId, PDO::PARAM_INT);  
    $sql->execute();
    $ingredients = $sql->fetchAll(); 

    $ingredientsArr = []; 

    foreach($ingredients as $ingredient){
       $fullIngredient =  $ingredient->Name . "  ". $ingredient->Amount;
        array_push($ingredientsArr, $fullIngredient);
    }
    
} catch(PDOExecption $ex){
    echo $ex; 

}