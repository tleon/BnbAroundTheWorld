<?php

namespace App\Controller;

use App\Model\BookingManager;

class MyAccountController extends AbstractController
{
    public function show()
    {
        if (!empty($_SESSION)) {
            $bookingManager = new BookingManager();
            $bookings = $bookingManager->selectBookingByUserId(intval($_SESSION['id']));

            if (empty($bookings))
            {
                $noBooking = True;
            }
            else
            {
                $noBooking = False;
            }

            return $this->twig->render('User/myAccount.html.twig',['session' => $_SESSION, 'bookings' => $bookings, 'noBooking' => $noBooking]);
        }
        else
        {
            header("Location: /Home/index/");
        }
    }
}
