<?php

namespace App\Controller;

use App\Model\BookingManager;
use App\Controller\RoomController;

class BookingController extends AbstractController
{

    //definition de tableau valide auquel on compare les valeurs renvoyer

    const VALID_VALUES = [ 'country' => ["1","2","3","4","5"], 'date' => ["date"], 'numberGuest' => ["1","2","3","4","5","6","7","8","9","10"] ];

    public $error = array();



    /*verification des données de reservation renvoyer par le calendrier
    *
    */

    public function test_input($value)
    {
        $data = trim($value);
        $data = stripslashes($value);
        $data = htmlspecialchars($value);
        return $value;
    }




    /**this function converts the home page's calendar date type to the room page's datepicker's type
     * or converts the roompage datepicker's date to datetime for database insertion depending on the need
     * (you have to specify what you need in the "target" parameter: roomPage or db)
     * example result :
     * "Apr 16, 2019"-->"04/16/2019" for roomPage target
     * or
     * "04/16/2019"-->"2019-04-16" for db target
     */
    public function convert($date, $target)
    {
        if ($target=="roomPage") {
            $dayBegin = substr($date['date'], 0, 2);
            $dayEnd = substr($date['date'], -10, 2);
            $monthBegin = substr($date['date'], -21, 2);
            $monthEnd = substr($date['date'], 17, 2);
            $yearBegin = substr($date['date'], -18, 4);
            $yearEnd = substr($date['date'], 20, 4);

            $date['beginDate'] = $dayBegin . "." .$monthBegin . "." . $yearBegin;
            $date['endDate']= $dayEnd . "." . $monthEnd . "." . $yearEnd;
        } else {
            $dayBegin = substr($date['date'], 0, 2);
            $dayEnd = substr($date['date'], -10, 2);
            $monthBegin = substr($date['date'], -21, 2);
            $monthEnd = substr($date['date'], 17, 2);
            $yearBegin = substr($date['date'], -18, 4);
            $yearEnd = substr($date['date'], 20, 4);
            $date['beginDate'] = $yearBegin . "-" . $monthBegin . "-" . $dayBegin;
            $date['endDate'] = $yearEnd . "-" . $monthEnd . "-" . $dayEnd;
        }
        return $date;
    }



    //function that tranfers your home page's booking selection to the room page's booking form
    public function transfert()
    {
        if (!isset($_SESSION['username'])) {
            return $this->twig->render('Home/signIn.html.twig');
        } elseif (!isset($_POST['roomId'])) {
            $error = "veuillez choisir une chambre";
            return $this->twig->render('Home/index.html.twig', ['error' => $error]);
        } else {
            $data=$this->convert($_POST, "roomPage");

            if ($_POST['nbPerson']=="1") {
                $nbGuestSelected[1]="selected";
            } elseif ($_POST['nbPerson']!="1") {
                $nbGuestSelected[1]=" ";
            }


            if ($_POST['nbPerson']=="2") {
                $nbGuestSelected[2]="selected";
            } elseif ($_POST['nbPerson']!="2") {
                $nbGuestSelected[2]=" ";
            }


            if ($_POST['nbPerson']=="3") {
                $nbGuestSelected[3]="selected";
            } elseif ($_POST['nbPerson']!="3") {
                $nbGuestSelected[3]=" ";
            }


            if ($_POST['nbPerson']=="4") {
                $nbGuestSelected[4]="selected";
            } elseif ($_POST['nbPerson']!="4") {
                $nbGuestSelected[4]=" ";
            }




            $_SESSION['booking']['nbGuestSelected']= $nbGuestSelected;
            $_SESSION['booking']['roomId'] = $data['roomId'];
            $_SESSION['booking']['beginDate'] = $data['beginDate'];
            $_SESSION['booking']['endDate'] = $data['endDate'];



            $redirect = new RoomController;
            header("Location: /Room/show/".$_SESSION['booking']['roomId']);
        }
    }
    

        
    //inserting the booked date in the database
    public function insert($data)
    {
        //converting the date in the data to datetime for database insertion
        $data=$this->convert($data, "db");

        //sending data to insert function
        $BookingManager = new BookingManager();
        $BookingManager->insertDate($data);

        $roomController = new RoomController;
        $roomController->confirmMail('reservation');
    }

    public function delete($id)
    {
        //sending data to insert function
        $BookingManager = new BookingManager();
        $BookingManager->deletBookingById($id);
        header('location: /myAccount/show');

        $roomController = new RoomController;
        $roomController->confirmMail('annulation');
    }


    private function checkData($data)
    {
        $errors = [];
        /*if (!isset($data['date']) || empty($data['date']))
        {
            $errors['date']="Dates obligatoires";
        }*/
        if (!isset($data['nb_person']) || empty($data['nb_person'])) {
            $errors['nb_person']="Nombre de personnes obligatoire";
        }
        return $errors;
    }

    public function security()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $begin_string = substr($_POST['date'], 0, 10);
            $begin_array = explode("/", $begin_string);
            $begin_date_str = $begin_array[2] . "-" . $begin_array[0] ."-" .$begin_array[1];
            $begin_date = new \DateTime($begin_date_str);

            $end_string = substr($_POST['date'], -10, 10);
            $end_array = explode("/", $end_string);
            $end_date_str = $end_array[2] . "-" . $end_array[0] . "-" . $end_array[1];
            $end_date = new \DateTime($end_date_str);

            $data = [
                'begin_date' => $begin_date,
                'end_date' => $end_date,
                'nb_person' => $_POST['nb_person'],
                'options' => $_POST['options'],
                'room_id' => 1,
                'user_id' => 4,
                'total_price' => 0
            ];

            $errors = $this->checkData($data);
            if (empty($errors)) {
                $BookingManager = new BookingManager();
                $BookingManager->insert($data);
            }
        }

        return $this->twig->render('Room/room.html.twig', ['dump'=>$end_date]);
    }
}
