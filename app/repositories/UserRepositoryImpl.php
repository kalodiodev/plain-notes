<?php

namespace App\Repository;

use PDO;
use App\Model\User;

class UserRepositoryImpl implements UserRepository {

    private $db;

    private $table = 'users';

    /**
     * UserRepositoryImpl constructor.
     *
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    function save(User $user)
    {
        $stmt = $this->db
            ->prepare(
                "INSERT INTO " . $this->table .
                " ( 'first_name', 'last_name', 'email', 'password' ) " .
                "VALUES (:firstname , :lastname , :email, :password)");

        $result = $stmt->execute([
            ':firstname' => $user->firstName,
            ':lastname' => $user->lastName,
            ':email' => $user->email,
            ':password' => $user->password
        ]);

        if($result) {
            return $this->db->lastInsertId();
        }

        return null;
    }

    function get($id)
    {
        // TODO: Implement get() method.
    }

    function update(User $user)
    {
        // TODO: Implement update() method.
    }

    function delete(User $user)
    {
        // TODO: Implement delete() method.
    }
}