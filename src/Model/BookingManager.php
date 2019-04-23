<?php
namespace App\Model;
/**
 *
 */
class BookingManager extends AbstractManager
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
     * Return booking from starting and ending dates.
     *
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function selectByMonth(\DateTime $start, \DateTime $end) : array
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT booking.id, booking.begin_date, booking.end_date, room.name, users.username FROM $this->table INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id WHERE booking.begin_date >= :start AND booking.end_date <= :end");
        $statement->bindValue('start', $start->format("Y-m-d"), \PDO::PARAM_STR);
        $statement->bindValue('end', $end->format("Y-m-d"), \PDO::PARAM_STR);
        $statement->execute();
        $booking = $statement->fetchall();
        return $booking;
    }
}


