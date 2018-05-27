<?php

namespace App\Repository;

use PDO;
use App\Model\User;
use App\Core\Helper\Encrypt;

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

    /**
     * Get all users
     *
     * @return array of users
     */
    function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    /**
     * Save new user
     *
     * @param User $user
     * @return null|string
     */
    function save(User $user)
    {
        $stmt = $this->db
            ->prepare(
                "INSERT INTO " . $this->table .
                " ( `first_name`, `last_name`, `email`, `password` ) " .
                "VALUES (:firstname , :lastname , :email, :password)");

        $result = $stmt->execute([
            ':firstname' => $user->firstName,
            ':lastname' => $user->lastName,
            ':email' => $user->email,
            ':password' => Encrypt::encrypt($user->password)
        ]);

        if($result) {
            return $this->db->lastInsertId();
        }

        return null;
    }

    /**
     * Get user by ID
     *
     * @param $id
     * @return User
     */
    function get($id)
    {
        // TODO: Implement get() method.
    }

    /**
     * Get user by Email
     *
     * @param $email
     * @return mixed
     */
    function getByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE email = :email");
        $stmt->execute([
            ':email' => $email
        ]);
        
        return $stmt->fetchObject(User::class);
    }

    /**
     * Update user
     *
     * @param User $user
     */
    function update(User $user)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete User
     *
     * @param User $user
     */
    function delete(User $user)
    {
        // TODO: Implement delete() method.
    }
}