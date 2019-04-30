<?php

namespace App\Controller;

use App\Controller\BookingController;

use App\Model\RoomManager;
use App\Model\BookingManager;
use App\Model\FeedbackManager;

class RoomController extends AbstractController
{
    /**
     *
     * Display room page
     *
     **/


    public function show($id) //id is not given on form submit
    {
        $errors = [];

        //check for unauthorized data in the booking form's submit

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (1 > intval($_POST['nb_person']) || intval($_POST['nb_person']) > 4) {
                $errors['nb_person'] = "Problème lors de la saisie du nombre de personne";
            }

            //if they are no unauthorized data in the form, it's prepared for the database insertion
            else {
                //readying the array that will be sent to the database
                $dataToInsert['nbPerson'] = $_POST['nb_person'];

                if (isset($_POST['options'])) {
                    $dataToInsert['option'] = $_POST['options'];
                } else {
                    $dataToInsert['option'] = " ";
                }

                $dataToInsert['roomId'] = intval($_SESSION['booking']['roomId']);
                $dataToInsert['date'] = $_POST['date'];
                $dataToInsert['userId'] = $_SESSION['id'];
                $bookingController = new BookingController();
                //calling the function that set the booked date in the database
                $dates = explode(' ', $_POST['date']);
                $d1 = new \DateTime($dates[0]);
                $d2 = new \DateTime($dates[2]);
                $bm = new BookingManager();
                $interval = $d2->diff($d1);
                $total =  $bm->getTotalPrice($id, intval($_POST['nb_person']), (intval($interval->format('%d')) + 1));
                $_SESSION['price'] =  $total;
                $bookingController->insert($dataToInsert);
                //$this->mail();
            }

        }
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById(intval($id));

        $feedbackManager = new FeedbackManager();
        $feedback = $feedbackManager->selectAllFeedbackByRoomId($id);


        $caras = explode('_', $room['caracs']);

        return $this->twig->render('Room/room.html.twig', ['room' => $room, 'session' => $_SESSION,'errors' =>$errors, 'caracs' => $caras, 'feedback'=>$feedback]);
    }


    public function checkout(){
        
    }

    public function confirmMail()
    {
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('BnBAroundWorld@gmail.com')
        ->setPassword(Password);


        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Confirmation de réservation'))
        ->setFrom(['helyamdu38550@gmail.com' => 'BnB Around The World'])
        ->setTo($_SESSION["email"])
        ->setBody("Votre réservation a bien été prise en compte. Nous vous remercions de votre confiance et vous souhaitons un agréable séjour chez nous.
        N'hsitez pas à prendre contact pour toute question sur les lieux et pour nous donner plus d'information sur votre arrivée.
    Pour annuler votre réservation, veuillez suivre ce lien : www.blabla.com*.
    *Attention : l'annulation d'une réservation doit se faire dans les 48h avant le debut du séjour.");

        // Send the message
        return $mailer->send($message);
    }
  
    private function checkData($data)
    {
        if (!isset($data['date']) || empty($data['date'])) {
            $errors['date']="Dates obligatoires";
        }
        return $errors;
    }

    public function security()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'date' => $_POST['date'],
            ];

            $errors = $this->checkData($data);
            if (empty($errors)) {
                $roomManager = new RoomManager();
                $roomManager->insert($data);
            }
        }
        return $this->twig->render('Room/room.html.twig');
    }

    /**
     * get all booking for room id in flatpickr format.
     * ex : [{"from":"01.12.2018","to":"04.12.2018"},{"from":"26.04.2019","to":"27.04.2019"}]
     * and return default date picked on index page
     *
     * @param integer $id
     * @return json
     */
    public function getUnavailableDate(int $id)
    {
        $bm = new BookingManager();
        $booking = $bm->selectBookingByRoom($id);

        $booking = array_map(function ($booking) {
            return array(
                'from' => date('d.m.Y', strtotime($booking['begin_date'])),
                'to' => date('d.m.Y', strtotime($booking['end_date']))
            );
        }, $booking);

        if (!isset($_SESSION['booking']["beginDate"]) || !isset($_SESSION['booking']["beginDate"])) {
            $defaultD = [];
        } else {
            $defaultD = ["{$_SESSION['booking']["beginDate"]}", "{$_SESSION['booking']["endDate"]}"];
        }

        $booking['dDate']=$defaultD;
        return json_encode($booking);
    }
}
