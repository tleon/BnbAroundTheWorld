<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class RoomManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'room';

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
    public function insert(array $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`name`, `description`, `pic_path`, `location`, `option`, `price`) VALUES (:name, :description, :pic_path, location, :option, :price)");
        $statement->bindValue('name', $room['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $room['description'], \PDO::PARAM_STR);
        $statement->bindValue('pic_path', $room['pic_path'], \PDO::PARAM_STR);
        $statement->bindValue('location', $room['location'], \PDO::PARAM_STR);
        $statement->bindValue('option', $room['option'], \PDO::PARAM_STR);
        $statement->bindValue('price', $room['price'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $room
     * @return bool
     */
    public function update(array $room):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `id` = :id, `name` = :name, `description` = :description, `pic_path` = :pic_path, `location` = :location, `option` = :option, `price` = :price WHERE id=:id");
        $statement->bindValue('id', $room['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $room['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $room['description'], \PDO::PARAM_STR);
        $statement->bindValue('pic_path', $room['pic_path'], \PDO::PARAM_STR);
        $statement->bindValue('location', $room['location'], \PDO::PARAM_STR);
        $statement->bindValue('option', $room['option'], \PDO::PARAM_STR);
        $statement->bindValue('price', $room['price'], \PDO::PARAM_STR);
        return $statement->execute();
    }
}
