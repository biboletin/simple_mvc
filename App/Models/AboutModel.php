<?php

namespace App\Models;

use Core\Model;

class AboutModel extends Model
{
    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getAboutInfo(): array
    {
        $sql = 'SELECT 
                  about 
                FROM
                  about 
                ORDER BY id DESC 
                LIMIT 1';
        $result = $this->query($sql);

        return $result->fetch_assoc() ?? ['about' => ''];
    }

    public function insertUpdateAbout($about = null): bool
    {
        $sql = 'INSERT INTO about (`about`) 
                    VALUES
                      (?) 
                      ON DUPLICATE KEY 
                      UPDATE 
                        about = ?';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('ss', $about, $about);

        return $stmt->execute();
    }
}
