<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */
namespace App\Model;

class RoomManager extends AbstractManager{

    const TABLE = 'booking';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert($data)
    {
        $begin_date = substr($data, 0, 10);
        $end_date = substr($data, -1, 10);
        $statement = $this->pdo->prepare("INSERT INTO $this->booking (begin_date, end_date, nb_person, options) VALUES (:begin_date, :end_date, :nb_person, :options))";

        $statement->bindValue('begin_date', $begin_date, \PDO::PARAM_DATE);
        $statement->bindValue('end_date', $end_date, \PDO::PARAM_DATE);
        $statement->bindValue('nb_person', $nb_person, \PDO::PARAM_INT);
        $statement->bindValue('options', $options, \PDO::PARAM_STR);
        try{
            //execute
            $statement->execute();
        }catch (\PDOException $e) {
            return $e;
        }
    }
}

