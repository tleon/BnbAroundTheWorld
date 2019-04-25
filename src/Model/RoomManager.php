<?php



namespace App\Model;

class RoomManager extends AbstractManager
{
    const TABLE = 'room';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}