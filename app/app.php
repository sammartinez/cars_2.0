<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    //Session - Stores Cookies
    session_start();

    if (empty($_SESSION['list_of_cars'])) {
      $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    //Twig Path
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    //Route and Controller
    $app->get('/', function() use ($app) {

      $all_cars = Car::getAll();

      return $app['twig']->render('cars.html.twig', array('cars' => $all_cars));

    });


    //Cars Post

    $app->post('/cars', function() use ($app) {
      $car = new Car($_POST['carModel'], $_POST['carPhoto'], $_POST['carPrice'], $_POST['carMiles']);
      $car->save();


      return $app['twig']->render('create_cars.html.twig', array('newcar' => $car));
      });


      // $first_car = new Car("2014 Porsche 911", 114991, 7864, "porsche.jpg");
      // $second_car = new Car("2011 Ford F450", 55995, 14241, "ford.jpg");
      // $third_car = new Car("2013 Lexus RX 350", 44700, 20000, "lexus.jpg");
      // $fourth_car = new Car("Mercedes Benz CLS550", 39900, 37979, "mercedes.jpg");
      //
      // $cars = array($_POST[$first_car], $_POST[$second_car], $_POST[$third_car],
      // $_POST[$fourth_car]);
      // $cars->save();

    //
    //   $cars_matching_search = array();
    //
    //   foreach ($cars as $car) {
    //       if ($car->getPrice() < $_GET["price"]) {
    //         if($car->getMiles() < $_GET["miles"]) {
    //           array_push($cars_matching_search, $car);
    //         }
    //       }
    //   }
    //   $output = "";
    //
    //   foreach ($cars_matching_search as $car) {
    //       $car_make = $car->getModel();
    //       $car_price = $car->getPrice();
    //       $car_miles = $car->getMiles();
    //       $car_photo = $car->getPhoto();
    //
    //      }
    //      if(empty($cars_matching_search)) {
    //         echo 'No cars!';
    //      }
    //
    //   return $output; //NEED TO LINK TO TWIG
    //
    // });

    return $app;
?>
