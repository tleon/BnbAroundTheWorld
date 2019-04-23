<?php

namespace App\Controller;
use App\Model\BookingManager;

class BookingController extends AbstractController
{
    public $day = "";
    public $month = "";
    public $year = "";

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


    function Convert($date)
            {

            $day = substr($date['beginDate'],4,2);
            $month = substr($date['beginDate'],0,3);
            $year = substr($date['beginDate'],7,5);
                
            
                switch($month)
                {
                    case "Jan":
                    $month = "01";
                    break;

                    case "Feb":
                    $month = "02";
                    break;

                    case "Mar":
                    $month = "03";
                    break;
                    
                    case "Apr":
                    $month = "04";
                    break;
                    
                    case "Mai":
                    $month = "05";
                    break;
                    
                    case "Jun":
                    $month = "06";
                    break;
                    
                    case "Jul":
                    $month = "07";
                    break;
                    
                    case "Aug":
                    $month = "08";
                    break;
                    
                    case "Sep":
                    $month = "09";
                    break;
                    
                    case "Oct":
                    $month = 10;
                    break;
                    
                    case "Nov":
                    $month = 11;
                    break;
                    
                    case "Dec":
                    $month = 12;
                    break;
                }
            
            $_POST['beginDate'] = $year . "-" . $month . "-" . $day;





        $this->day = substr($date['endDate'],4,2);
        $this->month = substr($date['endDate'],0,3);
        $this->year = substr($date['endDate'],7,5);

            switch($month)
            {
                case "Jan":
                $month = "01";
                break;

                case "Feb":
                $month = "02";
                break;

                case "Mar":
                $month = "03";
                break;
                
                case "Apr":
                $month = "04";
                break;
                
                case "Mai":
                $month = "05";
                break;
                
                case "Jun":
                $month = "06";
                break;
                
                case "Jul":
                $month = "07";
                break;
                
                case "Aug":
                $month = "08";
                break;
                
                case "Sep":
                $month = "09";
                break;
                
                case "Oct":
                $month = 10;
                break;
                
                case "Nov":
                $month = 11;
                break;
                
                case "Dec":
                $month = 12;
                break;
            }
            $year = substr($date['endDate'],7,5);
            $_POST['endDate']=$year . "-" . $month . "-" . $day;

        }

        public function transfert()
        {   $this->Convert($_POST);
            $_SESSION['begin_date']=$_POST['beginDate'];
            $_SESSION['end_date']=$_POST['endDate'];
            $_SESSION['nb_person']=$_POST['nbPerson'];
            $_SESSION['room_id']=$_POST['roomId'];
            return $this->twig->render('Home/index.html.twig');
    
        }
    

        

        function insert()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $reservation=$this->Convert($_POST);


                foreach ($_POST as $key => $value)
                {
                        $reservation[$key] = $value;
                }
                    $BookingManager = new BookingManager();
                    $BookingManager->insertReservation($reservation);
            }
            return $this->twig->render('Home/index.html.twig');
        }
}
?>



