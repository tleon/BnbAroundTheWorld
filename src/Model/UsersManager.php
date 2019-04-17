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
class Users extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'users';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * hash the password before inserting or comparing.
     * @param string $pass
     * @return string hashed pass
     */
    public function handlePass(string $pass): string 
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    public function checkUser($login, $pass){
        $statement = $this->pdo->prepare("SELECT pass FROM $this->table WHERE username=:username");
        $statement->bindValue('username', $login, \PDO::PARAM_STR);
        $statement->execute();

        $bddHashPass = $statement->fetch();

        return password_verify($pass, $bddHashPass);

    }
    /**
     * @param array $item
     * @return int
     */
    public function insert(array $item): int
    {
        // prepared request 
        $statement = $this->pdo->prepare("INSERT INTO $this->table (username, pass, mail, status) VALUES (:username, :pass, :mail, :status)");
        $statement->bindValue('username', $item['username'], \PDO::PARAM_STR);
        $statement->bindValue('pass', $item['pass'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $item['mail'], \PDO::PARAM_STR);
        $statement->bindValue('status', $item['status'], \PDO::PARAM_STR);

        try {
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return $e;
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
     * @param array $item
     * @return bool
     */
    public function update(array $item):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
