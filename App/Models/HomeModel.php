<?php
namespace App\Models;

use Core\Model;

class HomeModel extends Model
{

    public function getCategories()
    {
//        $result = $this->sql('select * from categories');
//        return $result;
        return [
            'Men',
            'Women',
            'Kids',
        ];
    }
}
