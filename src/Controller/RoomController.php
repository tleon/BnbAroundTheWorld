<?php

namespace App\Controller;

class RoomController extends AbstractController
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


}