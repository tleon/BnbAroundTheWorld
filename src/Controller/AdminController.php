<?php

namespace App\Controller;

use App\Model\RoomManager;

class AdminController extends AbstractController
{

    /**
     * Display admin home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Admin/index.html.twig');
    }

    public function chambres()
    {
        $roomManager = new RoomManager;
        $rooms = $roomManager->selectAll();
        return $this->twig->render('Admin/chambres.html.twig', ["rooms" => $rooms]);
    }

    public function edit($id)
    {
        if ($_SERVEUR['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                echo "Veuillez entrer un nom";
            }
        } else {
            $roomManager = new RoomManager;
            $rooms = $roomManager-> selectOneById($id);
            return $this->twig->render('Admin/edit.html.twig', ["rooms" => $rooms]);
        }
    }

    /**
     * Allow connection to admin page
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
}
