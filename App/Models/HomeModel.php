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
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

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
