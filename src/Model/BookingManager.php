<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */
namespace App\Model;

class BookingManager extends AbstractManager{

    const TABLE = 'booking';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert($data)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES (:begin_date, :end_date, :nb_person, :options, :room_id, :user_id, :total_price");

        $statement->bindValue('begin_date', $data['begin_date']->format('Y-m-d'), \PDO::PARAM_STR);
        $statement->bindValue('end_date', $data['end_date']->format('Y-m-d'), \PDO::PARAM_STR);
        $statement->bindValue('nb_person', $data['nb_person'], \PDO::PARAM_INT);
        $statement->bindValue('options', $data['options'], \PDO::PARAM_STR);
        $statement->bindValue('room_id', $data['room_id'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $data['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('total_price', $data['total_price'], \PDO::PARAM_INT);

        try{
            //execute
            $statement->execute();
        }catch (\PDOException $e) {
            return $e;
        }
    }
}