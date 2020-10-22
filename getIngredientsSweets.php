<?php

require_once('getRecipeSweets.php');

try{

    // Ingredients  
    $sql = $db->prepare("CALL getIngredients(?)");
    // One bindParam() call per parameter
    $sql->bindParam(1, $recipeId, PDO::PARAM_INT);  
    // call the stored procedure
    $sql->execute();
    $ingredients = $sql->fetchAll(); 

    //echo "-----------------------";
    //print_r($ingredients[0]->Name); 

    $ingredientsArr = []; 

    foreach($ingredients as $ingredient){
       $fullIngredient =  $ingredient->Name . "  ". $ingredient->Amount;
        array_push($ingredientsArr, $fullIngredient);
    }

   // print_r($ingredientsArr );

    

    
} catch(PDOExecption $ex){
    echo $ex; 

}