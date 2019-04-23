<?php

namespace App\Model;

/**
 *
 */
class BookingManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'booking';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $item
     * @return int
     */
    public function insertReservation(array $reservation)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`begin_date`,`end_date`,`nb_person`,`options`,`room_id`,`user_id`,`total_price`) VALUES (:beginDate,:endDate,:nbPerson,:options,:roomId,:userId,:totalPrice)");
        $statement->bindValue('beginDate', $reservation['beginDate'], \PDO::PARAM_STR);
        $statement->bindValue('endDate', $reservation['endDate'], \PDO::PARAM_STR);
        $statement->bindValue('nbPerson', $reservation['nbPerson'], \PDO::PARAM_STR);
        $statement->bindValue('options', "truc", \PDO::PARAM_STR);
        $statement->bindValue('roomId', $reservation['roomId'], \PDO::PARAM_STR);
        $statement->bindValue('totalPrice', 12000, \PDO::PARAM_STR);
        $statement->bindvalue('userId', 1, \PDO::PARAM_STR);
        $statement->execute();
    }
}
