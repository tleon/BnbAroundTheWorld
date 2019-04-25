<?php


namespace App\Controller;
use App\Model\RoomManager;
use App\Model\FeedbackManager;



class RoomController extends AbstractController
{
		public function show($id)
		    {
		        $roomManager = new RoomManager();
		        $room = $roomManager->selectOneById($id);

		        $feedbackManager = new FeedbackManager();
		        $feedbacks = $feedbackManager->selectFeedbackById($id);

		        return $this->twig->render('Room/room.html.twig', ['room' => $room], ['feedback' => $feedbacks]);
		    }

}