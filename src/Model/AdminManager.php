<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */
namespace App\Model;

class AdminManager extends AbstractManager
{
    const TABLE = 'room';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function updateRoomSql($values)
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET description=:description WHERE id=:id");
        $statement->bindValue('id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('description', $values['description'], \PDO::PARAM_STR);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET pic_path=:pic_path WHERE id=:id");
        $statement->bindValue('id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('pic_path', $values['pic_path'], \PDO::PARAM_STR);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET caracs=:caracs WHERE id=:id");
        $statement->bindValue('id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('caracs', $values['caracs'], \PDO::PARAM_STR);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET price=:price WHERE id=:id");
        $statement->bindValue('id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('price', $values['price'], \PDO::PARAM_STR);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
}
