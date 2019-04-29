<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\AdminManager;
use App\Services\Calendar;
use App\Model\BookingManager;
use App\Model\UsersManager;

class AdminController extends AbstractController
{
    /**
     * Display admin home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {   

        if( empty($_SESSION) || ($_SESSION['status'] != 'Administrator')){
            return $this->twig->render('Home/index.html.twig', ["error" => 'The page you are looking for does not exist [404 - Not Found]']);
        } else {
            return $this->twig->render('Admin/index.html.twig');
        }
    }

    public function chambres()
    {
        $roomManager = new RoomManager;
        $rooms = $roomManager->selectAll();
        if(empty($_SESSION) || ($_SESSION['status'] != 'Administrator')){
            return $this->twig->render('Home/index.html.twig', ["error" => 'The page you are looking for does not exist [404 - Not Found]']);
        }else{
            return $this->twig->render('Admin/chambres.html.twig', ["rooms" => $rooms]);             
        }
    }


    //Permet d'editer les données des chambres
    public function edit($id)
    {
        $roomManager = new RoomManager;
        $rooms = $roomManager-> selectOneById($id);
        return $this->twig->render('Admin/edit.html.twig', ["rooms" => $rooms]);
    }


    //Permet de mettre a jour les données des chambres dans la base de données
    public function updateRoom($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                $error['name'] = "Veuillez entrer un nom";
            } elseif (empty($_POST['description'])) {
                $error['description'] = "Veuillez entrer une description";
            } elseif (empty($_POST['pic_path'])) {
                $error['pic_path'] = "Veuillez inserer une image";
            } elseif (empty($_POST['location'])) {
                $error['location'] = "Veuillez entrer une localisation";
            } elseif (empty($_POST['caracs'])) {
                $error['caracs'] = "Veuillez entrer des options";
            } elseif (empty($_POST['price'])) {
                $error['price'] = "Veuillez entrer un prix";
            } else {
                $adminManager = new AdminManager();
                $value = $_POST;
                $value['id'] = $id;
                $adminManager->updateRoomSql($value);
            }
        }
        $roomManager = new RoomManager;
        $rooms = $roomManager-> selectOneById($id);
        return $this->twig->render('Admin/edit.html.twig', ["rooms" => $rooms, "error" => $error]);
    }

    /**
     * Display planning page
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function planning()
    {
        try {
            $month = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
        } catch (\Exception $e) {
            $month = new Calendar;
        }
        if(empty($_SESSION) || ($_SESSION['status'] != 'Administrator')){
            return $this->twig->render('Home/index.html.twig', ["error" => 'The page you are looking for does not exist [404 - Not Found]']);
        }else{
            return $this->twig->render('Admin/planning.html.twig', ['planning' => $month]);
        }
        
    }
  
    /**
     * Display booking page
     *
     * @param [type] $id
     * @return void
     */
  
    public function booking($id)
    {
        $bookingManager = new BookingManager();
        $bookings = $bookingManager->selectBookingById(intval($id));

        return $this->twig->render('Admin/showBooking.html.twig', ['bookings' => $bookings]);
    }

    /**
     * Handle fetch get requests
     *
     * @param string $date
     * @return void
     */
  
    public function fetch(string $date)
    {
        $date = new \DateTime($date);
        $bm = new bookingManager;
        $bookings = $bm->selectByDay($date);
        return json_encode($bookings);
        
    }

    //function to populate the booking per month chart on admin page
    public function bookingChart() {
        $bm = new bookingManager;
        $rooms = ['usa', 'japon', 'thailand', 'france', 'africa'];
        try{
            foreach($rooms as $key => $room){
                $results[$room] = $bm->bookingPerRoom(intval($key) + 1);
            }
            $results['total'] = $bm->bookingPerMonth();
            return json_encode($results);
        }catch(\PDOException $e) {
            return $e;
        }
    }

    // function to populate the price per room chart on admin page.
    public function priceChart() {
        $bm = new bookingManager;
        try{
            $results = $bm->pricesPerRoom();
            return json_encode($results);
        }catch(\PDOException $e) {
            return $e;
        }
    }

}