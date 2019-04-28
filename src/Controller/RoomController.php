<?php

namespace App\Controller;

use App\Controller\BookingController;
use App\Model\RoomManager;

class RoomController extends AbstractController
{
    /**
     *
     * Display room page
     *
     **/

    public function show($id) //id is not given on form submit

    {
        $dir = "assets/images/{$id}/";
        $images = scandir($dir);
        define("EXTENSION", ['png', 'jpg', 'gif', 'jpeg']);
        $img = [];

        foreach ($images as $image) {
            if (in_array(pathinfo($image, PATHINFO_EXTENSION), EXTENSION)) {
              array_push($img,$image);
            }
        }

        $errors = [];
        $availableOptions = ["Petit déjeuner", "Table d'hôte", "Lit bébé", "baby1", "baby2"];

        //check for unauthorized data in the booking form's submit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (1 > intval($_POST['nb_person']) || intval($_POST['nb_person']) > 4) {
                $errors['nb_person'] = "problème lors de la saisie du nombre de personne";
            }
            if (isset($_POST['options']) && !in_array($_POST['options'], $availableOptions)) {
                $errors['options'] = "problème lors de la saisie des options";
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
                $bookingController->insert($dataToInsert);
            }
        }
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById(intval($id));
        return $this->twig->render('Room/room.html.twig', ['room' => $room, 'images' =>$img, 'session' => $_SESSION, 'errors' => $errors]);
    }

    private function checkData($data)
    {
        if (!isset($data['date']) || empty($data['date'])) {
            $errors['date'] = "Dates obligatoires";
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
}
