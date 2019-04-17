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
class UsersManager extends AbstractManager
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


    /**
     * checks user credentials : verify pass against hash from db.
     * @param string $login
     * @param string $pass
     * @return bool 
     * 
     */
    public function checkUser($login, $pass){
        $statement = $this->pdo->prepare("SELECT pass FROM $this->table WHERE username=:username");
        $statement->bindValue('username', $login, \PDO::PARAM_STR);
        $statement->execute();

        try{
            $bddHashPass = $statement->fetch();
            return password_verify($pass, $bddHashPass['pass']);
            
        }catch(PDOException $e) {
            return $e;
        }
           
    }


    /**
     * @param array $item
     * @return mixed true if insert went ok else PDOexception.
     * 
     */
    public function insert(array $item)
    {
        // prepared request 
        $statement = $this->pdo->prepare("INSERT INTO $this->table (username, pass, mail, status) VALUES (:username, :pass, :mail, :status)");
        $statement->bindValue('username', $item['username'], \PDO::PARAM_STR);
        $statement->bindValue('pass', $this->handlePass($item['pass']), \PDO::PARAM_STR);
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

}
