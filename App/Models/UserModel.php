<?php


namespace App\Models;

use Core\Model;

/**
 * Class UserModel
 *
 * @package App\Models
 */
class UserModel extends Model
{
    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param null $username
     *
     * @return array|null
     */
    public function validateUser($username = null)
    {
        $sql = "select id, password from users where `name` = ?";
        $stmt  = $this->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * @param null $username
     * @param null $email
     * @param null $password
     */
    public function createNewUser($username = null, $email = null, $password = null)
    {
        $sql = "insert into users(`name`, `email`, `password`) values(?, ?, ?)";

        $stmt  = $this->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);
        $stmt->execute();
    }
}
