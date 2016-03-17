<?php
namespace Example\Models;

use PDO;

class User
{
    private $pdo;

    public function __construct( PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function find($userid) {
        $query = 'SELECT * FROM user WHERE id = :userid';

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':userid', $userid);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Model\\Entities\\House');
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_CLASS);

        if (false === $user) {
            throw new RecordNotFoundException(
                'No user exist for the specified ID'
            );
        }

        return $user;
    }
}






 ?>
