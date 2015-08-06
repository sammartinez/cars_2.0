<?php
        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/Car.php";

        //Session - Stores Cookies
        session_start();

        if (empty($_SESSION['list_of_cars'])) {
          $_SESSION['list_of_cars'] = array(
            $first_car = new Car("2014 Porsche 911", 1, 1, "../images/porsche.jpg"),
            $second_car = new Car("2011 Ford F450", 55995, 14241, "../images/ford.jpg"),
            $third_car = new Car("2013 Lexus RX 350", 44700, 20000, "../images/lexus.jpg"),
            $fourth_car = new Car("Mercedes Benz CLS550", 39900, 37979, "../images/mercedes.jpg"),
          );
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
          $car = new Car($_POST['carModel'], $_POST['carPrice'], $_POST['carMiles'], $_POST['carPhoto']);
          $car->save();


          return $app['twig']->render('create_cars.html.twig', array('newcar' => $car));
          });

          //Cars Post Delete
          $app->post("/delete_cars", function() use ($app) {
            Car::deleteAll();
            return $app['twig']->render('delete_cars.html.twig');
          });

          //car search
          $app->get("/car_results", function() use ($app) {

            $search = Car::getAll();


            $cars_matching_search = array();

            foreach ($search as $result) {
                if ($result->getPrice() < $_GET["price"]) {
                  if($result->getMiles() < $_GET["miles"]) {
                    array_push($cars_matching_search, $result);
                  }
                }
              }

            return $app['twig']->render('car_results.html.twig', array('search_data' => $cars_matching_search));


          });

        return $app;
?>
