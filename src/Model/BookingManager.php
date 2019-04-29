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
    public function insertDate(array $data)
    {
        // self explanatory nothing special
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`begin_date`,`end_date`,`nb_person`,`options`,`room_id`,`user_id`,`total_price`) VALUES (:beginDate,:endDate,:nbPerson,:options,:roomId,:userId,:totalPrice)");
        $statement->bindValue('beginDate', $data['beginDate'], \PDO::PARAM_STR);
        $statement->bindValue('endDate', $data['endDate'], \PDO::PARAM_STR);
        $statement->bindValue('nbPerson', $data['nbPerson'], \PDO::PARAM_STR);
        $statement->bindValue('options', $data['option'], \PDO::PARAM_STR);
        $statement->bindValue('roomId', $data['roomId'], \PDO::PARAM_STR);
        $statement->bindValue('totalPrice', 120, \PDO::PARAM_STR);
        $statement->bindvalue('userId', $data['userId'], \PDO::PARAM_STR);
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
        $statement = $this->pdo->prepare("SELECT booking.id, booking.begin_date, booking.end_date, booking.total_price, booking.nb_person, booking.options, room.name, users.username, users.mail, feedback.comment FROM $this->table INNER JOIN room ON booking.room_id=room.id INNER JOIN users ON users.id=booking.user_id INNER JOIN feedback ON feedback.user_id=users.id WHERE booking.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $bookings = $statement->fetchall();
        return $bookings;
    }


    /**
     * Return all booking dates from room_id
     *
     * @param integer $id
     * @return array
     */
    public function selectBookingByRoom(int $id) : array
    {
        $statement = $this->pdo->prepare("SELECT booking.begin_date, booking.end_date FROM $this->table WHERE booking.room_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $bookings = $statement->fetchall();
        return $bookings;
    }

    // returns booking number per month as an array
    public function bookingPerMonth() {
        $sql = "SELECT EXTRACT(year_month FROM begin_date) as month, COUNT(*) as reservations FROM $this->table GROUP BY month";
        try{
            return $this->pdo->query($sql)->fetchAll();
        }catch(\PDOException $e){
            return $e;
        }
    }

    // returns total price per room as an array
    public function pricesPerRoom() {
        $sql = "SELECT SUM(total_price) as price, room_id FROM $this->table GROUP BY room_id";
        try{
            return $this->pdo->query($sql)->fetchAll();
        }catch(\PDOException $e){
            return $e;
        }

    }
}


