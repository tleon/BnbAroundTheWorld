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
class PriceManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'prices';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    // no need for any methiod for now. we are gonna select price by his room_id whitch is also his price id .


}
