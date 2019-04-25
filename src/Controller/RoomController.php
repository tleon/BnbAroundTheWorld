<?php

namespace App\Controller;
use App\Model\RoomManager;
use App\Controller\BookingController;
class RoomController extends AbstractController
{
    /**
     *
     * Display room page
     *
     **/

		public function show($id)//id is not given on form submit
    {  
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
        /*    if (//errors)
            {
 
                //show errors
            }

        }
        else
        {*/
            //insert database
            $dataToInsert['nbPerson']=$_POST['nb_person'];
            $dataToInsert['option']=$_POST['options'];
            $dataToInsert['roomId']=intval($_SESSION['booking']['roomId']);
            $dataToInsert['date'] = $_POST['date'];
            $bookingController = new BookingController();
            $bookingController->insert($dataToInsert);
        }

        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById(intval($id));
        return $this->twig->render('Room/room.html.twig', ['room' => $room, 'session' => $_SESSION]);
    }
  
    private function checkData($data)
    {
        if (!isset($data['date']) || empty($data['date']))
        {
            $errors['date']="Dates obligatoires";
        }
        return $errors;
    }

    public function security()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $data = [
                'date' => $_POST['date']
            ];

            $errors = $this->checkData($data);
            if (empty($errors))
            {
                $roomManager = new RoomManager();
                $roomManager->insert($data);
            }
        }
        return $this->twig->render('Room/room.html.twig');
    }
}