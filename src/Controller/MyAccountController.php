<?php

namespace App\Controller;
use App\Model\BookingManager;

class MyAccountController extends AbstractController
{

    public function show()
    {
        if (!empty($_SESSION))
        {
            $bookingManager = new BookingManager();
            $bookings = $bookingManager->selectBookingByUserId(intval($_SESSION['id']));
            return $this->twig->render('User/myAccount.html.twig',['session' => $_SESSION, 'bookings' => $bookings]);
        }
        else
        {
            header("Location: /Home/index/");
        }
    }
}