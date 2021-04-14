<?php

namespace App\Models;

use Core\Model;

/**
 * Class HomeModel
 *
 * @package App\Models
 */
class HomeModel extends Model
{

    /**
     * @return mixed
     */
    public function getUsers()
    {
        $result = $this->query('select * from users');
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
        return [];
    }
}
