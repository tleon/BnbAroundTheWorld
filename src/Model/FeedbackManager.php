<?php



namespace App\Model;

class FeedbackManager extends AbstractManager
{
    const TABLE = 'feedback';



    public function __construct()
    {
        parent::__construct(self::TABLE);
    }



    public function selectFeedbackById(int $id) : array
    {
        $statement = $this->pdo->prepare("SELECT feedback.grade, feedback.comment, users.username FROM $this->table INNER JOIN room ON room.id=feedback.room_id INNER JOIN users ON users.id=feedback.user_id WHERE room.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $feedback = $statement->fetchall();
        return $feedback;
    }
}