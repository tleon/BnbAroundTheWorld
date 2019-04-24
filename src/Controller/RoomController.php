<?php


namespace App\Controller;
use App\Model\RoomManager;



class RoomController extends AbstractController
{
		public function show()
		    {
		        $roomManager = new RoomManager();
		        $room = $roomManager->selectOneById(1);

		        return $this->twig->render('Room/room.html.twig', ['room' => $room]);
		    }
}