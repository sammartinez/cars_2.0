<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->get('/', function() {

      return "<html>
      <head>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
          <title>Find a Car</title>
      </head>
      <body>
          <div class='container'>
              <h1>Find a Car!</h1>
              <form action='/car'>
                  <div class='form-group'>
                      <label for='price'>Enter Maximum Price:</label>
                      <input id='price' name='price' class='form-control' type='number'>
                  </div>
                  <div class='form-group'>
                    <label for='miles'>Enter Maximum Miles: </label>
                    <input id='miles' name='miles' class='form-control' type='number'>
                  </div>

                  <button type='submit' class='btn-success'>Submit</button>
              </form>
          </div>
      </body>
      </html>";
    });

    $app->get('/car', function(){
      $first_car = new Car("2014 Porsche 911", 114991, 7864, "../images/porsche.jpg");
      $second_car = new Car("2011 Ford F450", 55995, 14241, "../images/ford.jpg");
      $third_car = new Car("2013 Lexus RX 350", 44700, 20000, "../images/lexus.jpg");
      $fourth_car = new Car("Mercedes Benz CLS550", 39900, 37979, "../images/mercedes.jpg");

      $cars = array($first_car, $second_car, $third_car, $fourth_car);

      $cars_matching_search = array();

      foreach ($cars as $car) {
          if ($car->getPrice() < $_GET["price"]) {
            if($car->getMiles() < $_GET["miles"]) {
              array_push($cars_matching_search, $car);
            }
          }
      }
      $output = "";

      foreach ($cars_matching_search as $car) {
          $car_make = $car->getModel();
          $car_price = $car->getPrice();
          $car_miles = $car->getMiles();
          $car_photo = $car->getPhoto();
          $output = $output . "<li>" . $car_make . "</li>" .
          "<ul> <li>" . $car_price . "</li> <li> Miles:" . $car_miles
           . "</li> <li> <img src=" . $car_photo . "> </li> </ul>";
         }
         if(empty($cars_matching_search)) {
            echo 'No cars!';
         }

      return $output;

      });

    return $app;
?>
