<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\AdminManager;
use App\Model\UsersManager;

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


    //Permet d'editer les données des chambres
    public function edit($id)
    {
        $roomManager = new RoomManager;
        $rooms = $roomManager-> selectOneById($id);
        return $this->twig->render('Admin/edit.html.twig', ["rooms" => $rooms]);
    }


    //Permet de mettre a jour les données des chambres dans la base de données
    public function updateRoom($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['name'])) {
                echo "Veuillez entrer un nom";
            } else {
                $adminManager = new AdminManager();
                $value = $_POST;
                $value['id'] = $id;
                $adminManager->updateRoomSql($value);
                $roomManager = new RoomManager;
                $rooms = $roomManager-> selectOneById($id);
                return $this->twig->render('Admin/edit.html.twig', ["rooms" => $rooms]);
            }
        } else {
            //pas de POST
        }

        /**
         * Allow connection to admin page
         * @return string
         * @throws \Twig\Error\LoaderError
         * @throws \Twig\Error\RuntimeError
         * @throws \Twig\Error\SyntaxError
         */
    }
}
