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

    public function insert($data)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (begin_date, end_date, nb_person, options, room_id, user_id, total_price) VALUES (:begin_date, :end_date, :nb_person, :options, :room_id, :user_id, :total_price");

        $statement->bindValue('begin_date', $data['begin_date']->format('Y-m-d'), \PDO::PARAM_STR);
        $statement->bindValue('end_date', $data['end_date']->format('Y-m-d'), \PDO::PARAM_STR);
        $statement->bindValue('nb_person', $data['nb_person'], \PDO::PARAM_INT);
        $statement->bindValue('options', $data['options'], \PDO::PARAM_STR);
        $statement->bindValue('room_id', $data['room_id'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $data['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('total_price', $data['total_price'], \PDO::PARAM_INT);

        try{
            //execute
            $statement->execute();
        }catch (\PDOException $e) {
            return $e;
        }
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


