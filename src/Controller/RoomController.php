<?php

namespace App\Controller;
use App\Model\RoomManager;
use App\Model\FeedbackManager;

class RoomController extends AbstractController
{
    /**
     *
     * Display room page
     *
     **/

		public function show($id)
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        $feedbackManager = new FeedbackManager();
        $feedbacks = $feedbackManager->selectFeedbackById($id);

        return $this->twig->render('Room/room.html.twig', ['room' => $room], ['feedback' => $feedbacks]);
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