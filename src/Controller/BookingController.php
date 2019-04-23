<?php

namespace App\Controller;
use App\Model\BookingManager;

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




    /**
     * conversion de la date du calendrier de la homepage vers le format datetime 
     * (exemple: "Apr 16, 2019"-->"2019-04-16")
     */
    function convert($date)
            {

            $dayBegin = substr($date['beginDate'],4,2);
            $dayEnd = substr($date['endDate'],4,2);

            $monthBegin = substr($date['beginDate'],0,3);
            $monthEnd = substr($date['endDate'],0,3);

            $yearBegin = substr($date['beginDate'],7,5);
            $yearEnd = substr($date['endDate'],7,5);                


            

            switch($monthBegin)
            {
                case "Jan":
                    $monthBegin = "01";
                    break;

                case "Feb":
                    $monthBegin = "02";
                    break;

                case "Mar":
                    $monthBegin = "03";
                    break;
                
                case "Apr":
                    $monthBegin = "04";
                    break;
                
                case "Mai":
                    $monthBegin = "05";
                    break;
                
                case "Jun":
                    $monthBegin = "06";
                    break;
                
                case "Jul":
                    $monthBegin = "07";
                    break;
                
                case "Aug":
                    $monthBegin = "08";
                    break;
                
                case "Sep":
                    $monthBegin = "09";
                    break;
                
                case "Oct":
                    $monthBegin = "10";
                    break;
                
                case "Nov":
                    $monthBegin = "11";
                    break;
                
                case "Dec":
                    $monthBegin = "12";
                    break;
            }
        


            switch($monthEnd)
            {
                case "Jan":
                    $monthEnd = "01";
                    break;

                case "Feb":
                    $monthEnd = "02";
                    break;

                case "Mar":
                    $monthEnd = "03";
                    break;
                
                case "Apr":
                    $monthEnd = "04";
                    break;
                
                case "Mai":
                    $monthEnd = "05";
                    break;
                
                case "Jun":
                    $monthEnd = "06";
                    break;
                
                case "Jul":
                    $monthEnd = "07";
                    break;
                
                case "Aug":
                    $monthEnd = "08";
                    break;
                
                case "Sep":
                    $monthEnd = "09";
                    break;
                
                case "Oct":
                    $monthv = "10";
                    break;
                
                case "Nov":
                    $monthEnd = "11";
                    break;
                
                case "Dec":
                    $monthEnd = "12";
                    break;
            }



            $date['beginDate'] = $yearBegin . "-" . $monthBegin . "-" . $dayBegin;
            $date['endDate']=$yearEnd . "-" . $monthEnd . "-" . $dayEnd;
            return $date;
        }


        /**
         * fonction pour transferer la selection faite sur la page index vers la page chambre
         * (inutiliser pour le moment)
         */
        public function transfert()
        {   
            $toConvert=$_POST;
            $sessionData=$this->convert($toConvert);
            $_SESSION['begin_date']=$sessionData['beginDate'];
            $_SESSION['end_date']=$sessionData['endDate'];
            $_SESSION['nb_person']=$sessionData['nbPerson'];
            $_SESSION['room_id']=$sessionData['roomId'];
            return $this->twig->render('Home/index.html.twig');
    
        }
    

        
        /**
         * insertion de la réservation dans la base de donnée
         */
        function insert()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $dateReadyInsert=$this->convert($_POST);


                foreach ($dateReadyInsert as $key => $value)
                {
                    $dateToInsert[$key] = $value;
                }
                    $BookingManager = new BookingManager();
                    $BookingManager->insertReservation($dateToInsert);
            }
            return $this->twig->render('Home/index.html.twig');
        }
}
?>



