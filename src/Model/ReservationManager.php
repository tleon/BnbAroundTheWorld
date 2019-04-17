<?php

namespace App\Model;

/**
 *
 */
class ItemManager extends AbstractManager
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
    public function insertReservation(array $reservation): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`begin_date`,'end_date','nb_person','room_id') VALUES (:dateDebut,:dateFin,:nombrePersonne,:destination)");
        $statement->bindValue('dateDebut', $reservation['dateDebut'], \PDO::PARAM_STR);
        $statement->bindValue('dateFin', $reservation['dateFin'], \PDO::PARAM_STR);
        $statement->bindValue('nombrePersonne', $reservation['nombrePersonne'], \PDO::PARAM_STR);
        $statement->bindValue('destination', $reservation['destination'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
