<?php

namespace App\Controller;
use App\Model\BookingManager;

class BookingController extends AbstractController
{

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