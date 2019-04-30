<?php

namespace App\Services;

use App\Model\BookingManager;

class InvalidDate
{
    public function Hate(){
        $iDate = new BookingManager;
        $arrayDate=$iDate->selectAllBooking();

        foreach($arrayDate as $allResa)
        {
            $entry = explode(' ', $allResa[begin_date]);
            $exit=explode(' ', $allResa[end_date]);

            $reservation = new \DatePeriod
            (
                new \DateTime($entry);
                new \DateInterval('P1D');
                new \DateTime($exit);
            );
        };

        return ;
        // le json se fera dans le controller
        //ici on ne retourne qu'un tableau d'information
    }


}
