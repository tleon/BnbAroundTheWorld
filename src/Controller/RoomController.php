<?php


namespace App\Controller;
use App\Model\RoomManager;



class RoomController extends AbstractController
{
		public function show($id)
		    {
		        $roomManager = new RoomManager();
		        $room = $roomManager->selectOneById($id);

		        return $this->twig->render('Room/room.html.twig', ['room' => $room]);
		    }
}