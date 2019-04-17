<?php

namespace App\Controller;
use App\Model\BookingManager;

class BookingController extends AbstractController
{
    /**
     *
     * Display room page
     *
     **/

    public function show()
    {
        return $this->twig->render("Room/room.html.twig");
    }

    private function checkData($data)
    {
        if (!isset($data['date']) || empty($data['date']))
        {
            $errors['date']="Dates obligatoires";
        }
        if (!isset($data['nbPerson']) || empty($data['nbPerson']))
        {
            $errors['nbPerson']="Nombre de personnes obligatoire";
        }
        return $errors;
    }

    public function security()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $data = [
                'date' => $_POST['date'],
                'nb_person' => $_POST['nb_person'],
                'options' => $_POST['options'],
            ];

            $errors = $this->checkData($data);
            if (empty($errors))
            {
                $BookingManager = new BookingManager();
                $BookingManager->insert($data);
            }
        }
        return $this->twig->render('Room/room.html.twig');
    }



}