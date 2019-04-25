<?php

namespace App\Model;

class RoomManager extends AbstractManager
{
    const TABLE = 'room';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert($data)
    {
        $begin_date = substr($data, 0, 10);
        $end_date = substr($data, -1, 10);
        $statement = $this->pdo->prepare("INSERT INTO $this->booking (begin_date, end_date) VALUES (:begin_date, :end_date)");

        $statement->bindValue('begin_date', $begin_date, PDO::PARAM_DATE);
        $statement->bindValue('end_date', $end_date, PDO::PARAM_DATE);
    }
}