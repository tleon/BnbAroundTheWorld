<?php



namespace App\Model;

class FeedbackManager extends AbstractManager
{
    const TABLE = 'feedback';



    public function __construct()
    {
        parent::__construct(self::TABLE);
    }



    public function selectAllFeedbackByRoomId(int $id) : array
    {
        $statement = $this->pdo->prepare("SELECT feedback.grade, feedback.comment, users.username FROM $this->table INNER JOIN room ON room.id=feedback.room_id INNER JOIN users ON users.id=feedback.user_id WHERE room.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $feedback = $statement->fetchall();
        return $feedback;
    }


 /*   public function insertOpinion(array $opinionData)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (user_id, grade, comment, room_id) VALUES (:user_id, :grade, :comment, :room_id)");
        $statement->bindValue('user_id', $opinionData['user_id'],\PDO::PARAM_INT);
        $statement->bindValue('grade', $opinionData['grade'], \PDO::PARAM_INT);
        $statement->bindValue('comment', $opinionData['comment'], \PDO::PARAM_TEXT);
        $statement->bindValue('room_id', $opinionData['room_id'], \PDO::PARAM_INT);

        try {
            $statement->execute();
            return true;
        }catch(PDOException $e){
            return $e;
        }
    }*/
}