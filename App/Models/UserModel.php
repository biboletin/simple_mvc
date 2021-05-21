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
     * @return array<string>
     */
    public function checkUsername(string $username): array
    {
        $sql = 'select id, password from users where `username` = ?';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return [];
        }
        return $result->fetch_assoc();
    }
    public function createNewUser(string $username, string $email, string $password): bool
    {
        $sql = 'insert into users(`username`, `email`, `password`) values(?, ?, ?)';

        $stmt = $this->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);
        return $stmt->execute();
    }
}
