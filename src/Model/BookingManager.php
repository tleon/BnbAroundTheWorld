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
     * @param array $item
     * @return int
     */
    public function insertReservation(array $reservation)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`begin_date`,`end_date`,`nb_person`,`options`,`room_id`,`user_id`,`total_price`) VALUES (:beginDate,:endDate,:nbPerson,:options,:roomId,:userId,:totalPrice)");
        $statement->bindValue('beginDate', $reservation['beginDate'], \PDO::PARAM_STR);
        $statement->bindValue('endDate', $reservation['endDate'], \PDO::PARAM_STR);
        $statement->bindValue('nbPerson', $reservation['nbPerson'], \PDO::PARAM_STR);
        $statement->bindValue('options', "truc", \PDO::PARAM_STR);
        $statement->bindValue('roomId', $reservation['roomId'], \PDO::PARAM_STR);
        $statement->bindValue('totalPrice', 12000, \PDO::PARAM_STR);
        $statement->bindvalue('userId', 1, \PDO::PARAM_STR);
        $statement->execute();
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
        $statement = $this->pdo->prepare("SELECT booking.id, booking.begin_date, booking.end_date, room.name, users.username FROM $this->table INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id WHERE booking.begin_date >= :start AND booking.end_date <= :end");
        $statement->bindValue('start', $start->format("Y-m-d"), \PDO::PARAM_STR);
        $statement->bindValue('end', $end->format("Y-m-d"), \PDO::PARAM_STR);
        $statement->execute();
        $booking = $statement->fetchall();
        return $booking;
    }

    public function selectByDay(\DateTime $day)
    {
        $statement = $this->pdo->prepare("SELECT booking.id, booking.begin_date, booking.end_date, booking.nb_person, room.name, users.username FROM $this->table INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id WHERE booking.begin_date <= :day AND booking.end_date > :day");
        $statement->bindValue('day', $day->format("Y-m-d"), \PDO::PARAM_STR);
        $statement->execute();
        $booking = $statement->fetchall();
        return $booking;
    }

    /**
     * Return booking info
     *
     * @param integer $id
     * @return array
     */
    public function selectBookingById(int $id) : array
    {
        $statement = $this->pdo->prepare("SELECT booking.id, booking.begin_date, booking.end_date, booking.total_price, booking.nb_person, room.name, users.username, users.mail FROM $this->table INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id WHERE booking.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $bookings = $statement->fetchall();
        return $bookings;
    }
}


