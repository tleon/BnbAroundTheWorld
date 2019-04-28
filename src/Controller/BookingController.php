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
    function convert($date, $target)
    {
        if ($target=="roomPage")
        {
            $dayBegin = substr($date['date'],0, 2);
            $dayEnd = substr($date['date'],-10,2);

            $monthBegin = substr($date['date'],-21,2);
            $monthEnd = substr($date['date'],17,2);

            $yearBegin = substr($date['date'],-18,4);
            $yearEnd = substr($date['date'],20,4);                


                

            // switch($monthBegin)
            // {
            //     case "Jan":
            //         $monthBegin = "01";
            //         break;

            //     case "Feb":
            //         $monthBegin = "02";
            //         break;

            //     case "Mar":
            //         $monthBegin = "03";
            //         break;
                
            //     case "Apr":
            //         $monthBegin = "04";
            //         break;
                
            //     case "May":
            //         $monthBegin = "05";
            //         break;
                
            //     case "Jun":
            //         $monthBegin = "06";
            //         break;
                
            //     case "Jul":
            //         $monthBegin = "07";
            //         break;
                
            //     case "Aug":
            //         $monthBegin = "08";
            //         break;
                
            //     case "Sep":
            //         $monthBegin = "09";
            //         break;
                
            //     case "Oct":
            //         $monthBegin = "10";
            //         break;
                
            //     case "Nov":
            //         $monthBegin = "11";
            //         break;
                
            //     case "Dec":
            //         $monthBegin = "12";
            //         break;
            // }
        


            // switch($monthEnd)
            // {
            //     case "Jan":
            //         $monthEnd = "01";
            //         break;

            //     case "Feb":
            //         $monthEnd = "02";
            //         break;

            //     case "Mar":
            //         $monthEnd = "03";
            //         break;
                
            //     case "Apr":
            //         $monthEnd = "04";
            //         break;
                
            //     case "May":
            //         $monthEnd = "05";
            //         break;
                
            //     case "Jun":
            //         $monthEnd = "06";
            //         break;
                
            //     case "Jul":
            //         $monthEnd = "07";
            //         break;
                
            //     case "Aug":
            //         $monthEnd = "08";
            //         break;
                
            //     case "Sep":
            //         $monthEnd = "09";
            //         break;
                
            //     case "Oct":
            //         $monthEnd = "10";
            //         break;
                
            //     case "Nov":
            //         $monthEnd = "11";
            //         break;
                
            //     case "Dec":
            //         $monthEnd = "12";
            //         break;
            // }



            $date['beginDate'] = $monthBegin . "/" . $dayBegin . "/" . $yearBegin;
            $date['endDate']=$monthEnd . "/" . $dayEnd . "/" . $yearEnd;
        }
        else
        {
            $yearBegin = substr($date['date'],6,4);
            $yearEnd = substr($date['date'],19,4);
            $monthBegin = substr($date['date'],0,2);
            $monthEnd = substr($date['date'],13,2);
            $dayBegin = substr($date['date'],3,2);
            $dayEnd = substr($date['date'],16,2);
            $date['beginDate'] = $yearBegin . "-" . $monthBegin . "-" . $dayBegin;
            $date['endDate'] = $yearEnd . "-" . $monthEnd . "-" . $dayEnd;
        }
        return $date;
    }



    //function that tranfers your home page's booking selection to the room page's booking form  
    public function transfert()
    {   
        $data=$this->convert($_POST, "roomPage");



        if ($_POST['nbPerson']=="1")
            {
                $nbGuestSelected[1]="selected";
            }
        
        else if ($_POST['nbPerson']!="1")
            {
                $nbGuestSelected[1]=" ";
            }


            if ($_POST['nbPerson']=="2")
            {
                $nbGuestSelected[2]="selected";
            }
        
        else if ($_POST['nbPerson']!="2")
            {
                $nbGuestSelected[2]=" ";
            }


            if ($_POST['nbPerson']=="3")
            {
                $nbGuestSelected[3]="selected";
            }
        
        else if ($_POST['nbPerson']!="3")
            {
                $nbGuestSelected[3]=" ";
            }


            if ($_POST['nbPerson']=="4")
            {
                $nbGuestSelected[4]="selected";
            }
        
        else if ($_POST['nbPerson']!="4")
            {
                $nbGuestSelected[4]=" ";
            }




        $_SESSION['booking']['nbGuestSelected']= $nbGuestSelected;
        $_SESSION['booking']['roomId'] = $data['roomId'];
        $_SESSION['booking']['beginDate'] = $data['beginDate'];
        $_SESSION['booking']['endDate'] = $data['endDate'];



        $redirect = new RoomController;
        header("Location: /Room/show/".$_SESSION['booking']['roomId']);


    }
    

        
    //inserting the booked date in the database
    function insert($data)
    {       
        //converting the date in the data to datetime for database insertion
        $data=$this->convert($data,"db");

        //sending data to insert function
        $BookingManager = new BookingManager();
        $BookingManager->insertDate($data);
    }




    private function checkData($data)
    {
        $errors = [];
        /*if (!isset($data['date']) || empty($data['date']))
        {
            $errors['date']="Dates obligatoires";
        }*/
        if (!isset($data['nb_person']) || empty($data['nb_person']))
        {
            $errors['nb_person']="Nombre de personnes obligatoire";
        }
        return $errors;
    }

    public function security()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $begin_string = substr($_POST['date'], 0, 10);
            $begin_array = explode("/",$begin_string);
            $begin_date_str = $begin_array[2] . "-" . $begin_array[0] ."-" .$begin_array[1];
            $begin_date = new \DateTime($begin_date_str);

            $end_string = substr($_POST['date'], -10, 10);
            $end_array = explode("/",$end_string);
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
            if (empty($errors))
            {
                $BookingManager = new BookingManager();
                $BookingManager->insert($data);
            }
        }

        return $this->twig->render('Room/room.html.twig', ['dump'=>$end_date]);
    }



}
