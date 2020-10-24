<?php

include_once('connection.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <!--FontAwesome-->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!--own CSS-->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
  <title>Food Finder</title>
</head>

<body>
  <main>

  <div id="full-menu" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
            <a href="index.html">
                    <h1>Home</h1>
                </a>
                <a href="about.html">
                    <h1>About</h1>
                </a>
                <a href="#" onclick="redirectToMeals()">
                    <h1>Meals Finder</h1>
                </a>
                <a href="#" onclick="redirectToSweets()">
                    <h1>Sweets Finder</h1>
                </a>
            </div>
      </div>

      <div id="menu" onclick="openNav()">
            <h2>Menu</h2>
        </div>
    <section id="recipe-tinder">
    <div
          id="carouselExampleIndicators"
          class="carousel slide"
          data-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                class="d-block w-100"
                src=""
                alt="First slide"
              />
              <div class="carousel-caption d-md-block">
                <h2></h2>
                <div class="time-container">
                  <div class="time-tags"></div>
                  <div class="time-tags"></div>
                </div>
                <div class="tags-container">
                </div>
              </div>
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
          >
            <!-- data-slide="prev" above-->
            <span
              class="carousel-control-prev-icon"
              aria-hidden="true"
              onclick="randomRecipe()"
            ></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
          >
            <span
              class="carousel-control-next-icon"
              aria-hidden="true"
              onclick="showRecipe()"
            ></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- Modal -->
        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel"></h1>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img
                  class="d-block w-100"
                  alt="Fourthslide"
                />
                <div class="modal-time-container">
                  <div class="modal-time-tags"></div>
                  <div class="modal-time-tags"></div>
                </div>
                <div class="modal-tags-container">
                  <div class="modal-tags"></div>
                </div>
                <h2>Ingredients</h2>
                <ul id="modal-ingredients"> </ul>
                <h2>Method</h2>
                <p id="modal-method"> </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>
    </section>
  </main>
  <script>

      //      Variables

       //recipe slideshow
      let img = document.querySelector(".carousel-item img");
      let title = document.querySelector(".carousel-caption h2");
      //let tags = document.querySelector(".tags-container");
      let timeTags = document.querySelector(".time-container"); 
      let tags = document.querySelector(".tags-container"); 
      //modal
      let modalTitel = document.querySelector(".modal-title");
      let modalImg = document.querySelector(".modal-body img");
      let modalTags = document.querySelector(".modal-tags-container");
      let modalTimeTages = document.querySelector(".modal-time-container");
      let modalMethod = document.querySelector("#modal-method");
      let modalIngredients = document.querySelector("#modal-ingredients");
      var recipe;
      var category;

      //      Functions
  
      init();
      
      function init() {
          $(".carousel").carousel({
          interval: false
        });
        getCategory();
      }


      function getCategory(){
        var url_string = window.location.href;
        var url = new URL(url_string);
        category = url.searchParams.get("category");
        randomRecipe();
      }

      async function randomRecipe() {
       // console.log(category); 
        if(typeof category === 'undefined'){
          window.location.href = "index.html";
        } else if(category === 'meals'){
          var connection = await fetch('getRecipeMeals.php');
        } else if(category === 'sweets'){
            var connection = await fetch('getRecipeSweets.php');
        }
        
        var jData = await connection.json();
        recipe= jData.recipe;
        tagsArr= jData.tags;
        ingredientsArr = jData.ingredients; 
   
        img.src = recipe.ImgUrl;
        title.innerHTML = recipe.Title;
        timeTags.children[0].innerHTML = "Cooking: " + recipe.CookingTime  + " min";
        timeTags.children[1].innerHTML =  "Prep: " + recipe.PrepTime  + " min";
        tags.innerHTML ="";
        tagsArr.forEach(tag =>
          tags.insertAdjacentHTML(
            "beforeend",
            "<div class=tag>" + tag + " </div>"
          )
        );
      }
  
      function showRecipe() {
        $("#exampleModal").modal("show");
        modalImg.src = recipe.ImgUrl;
        modalTitel.innerHTML = recipe.Title;
        modalMethod.innerHTML = recipe.Method;
        modalTimeTages.children[0].innerHTML = "Cooking: " + recipe.CookingTime + " min";
        modalTimeTages.children[1].innerHTML =  "Prep: " + recipe.PrepTime  + " min";
        modalTags.innerHTML ="";
        tagsArr.forEach(modalTag =>
          modalTags.insertAdjacentHTML(
            "beforeend",
            "<div class=modal-tags>" + modalTag + " </div>"
          )
        );
        modalIngredients.innerHTML ="";
        ingredientsArr.forEach(ingredient =>
          modalIngredients.insertAdjacentHTML(
            "beforeend",
            "<li>" + ingredient + " </li>"
          )
        );
      }

       //      Menu Functions

      function openNav() {
        document.getElementById("full-menu").style.height = "100%";
      }

      function closeNav() {
        document.getElementById("full-menu").style.height = "0%";
      }

      function redirectToSweets() {
        window.location.href = "recipeFinder.php?category=sweets";
      }

      function redirectToMeals() {
        window.location.href = "recipeFinder.php?category=meals";
      }

   
      </script>
</body>

</html>