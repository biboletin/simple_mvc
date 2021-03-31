<?php


namespace App\Models;


use Core\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validateUser($username = null)
    {
        $sql = "select id, password from users where `name` = ?";
        $stmt  = $this->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();

    }
}