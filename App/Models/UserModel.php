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
     * @param string $username
     *
     * @return array|null
     */
    public function validateUser(string $username)
    {
        $sql = "select id, password from users where `username` = ?";
        $stmt  = $this->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    /**
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function createNewUser(string $username, string $email, string $password): bool
    {
        $sql = "insert into users(`username`, `email`, `password`) values(?, ?, ?)";

        $stmt  = $this->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);
        return $stmt->execute();
    }
}
