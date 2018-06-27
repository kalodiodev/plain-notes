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
        $users = [];

        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
            $user = new User();
            $user->id = $row['id'];
            $user->firstName = $row['first_name'];
            $user->lastName = $row['last_name'];
            $user->email = $row['email'];

            $users[] = $user;
        }

        return $users;
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
                " ( `first_name`, `last_name`, `email`, `password`, `confirmation` ) " .
                "VALUES (:firstname , :lastname , :email, :password, :confirmation)");

        $result = $stmt->execute([
            ':firstname' => $user->firstName,
            ':lastname' => $user->lastName,
            ':email' => $user->email,
            ':password' => Encrypt::encrypt($user->password),
            ':confirmation' => $user->confirmation
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

        $row = $stmt->fetch();

        return $this->rowToUser($row);
    }

    /**
     * Update user
     *
     * @param User $user
     * @return bool
     */
    function update(User $user)
    {
        $stmt = $this->db
            ->prepare(
                "UPDATE " . $this->table .
                " SET " .
                "`first_name` = :firstname ," .
                "`last_name` = :lastname " .
                "WHERE `id` = :id");

        $stmt->bindValue(":firstname", $user->firstName);
        $stmt->bindValue(":lastname", $user->lastName);
        $stmt->bindValue(":id", $user->id);

        $result = $stmt->execute();

        return $result;
    }

    /**
     * Update user password
     *
     * @param $user_id
     * @param $password
     * @return bool|mixed
     */
    function update_password($user_id, $password)
    {
        $stmt = $this->db
            ->prepare(
                "UPDATE " . $this->table .
                " SET " .
                "`password` = :password " .
                "WHERE `id` = :id ");

        return $stmt->execute([
            ':id' => $user_id,
            ':password' => Encrypt::encrypt($password)
        ]);
    }

    /**
     * Delete User
     *
     * @param User $user
     * @return bool
     */
    function delete(User $user)
    {
        $smtp = $this->db->prepare("DELETE FROM $this->table WHERE `id` = :id");
        $result = $smtp->execute([
            'id' => $user->id
        ]);

        return $result;
    }

    /**
     * Find User by confirmation token
     *
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE `confirmation` LIKE :token");
        $stmt->execute([
            'token' => $token
        ]);

        if($row = $stmt->fetch()) {
            return $this->rowToUser($row);
        }

        return null;
    }

    /**
     * Row to User
     *
     * @param $row
     * @return User
     */
    private function rowToUser($row)
    {
        $user = new User();
        $user->id = $row['id'];
        $user->firstName = $row['first_name'];
        $user->lastName = $row['last_name'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->admin = $row['admin'];
        $user->confirmation = $row['confirmation'];
        $user->forgot_password = $row['forgot_password'];
        $user->forgot_password_expires = $row['forgot_password_expires'];

        return $user;
    }

    /**
     * Update user's confirmation
     *
     * @param $user
     * @param $confirmation
     * @return mixed
     */
    function update_confirmation($user, $confirmation)
    {
        $stmt = $this->db
            ->prepare(
                "UPDATE " . $this->table .
                " SET " .
                "`confirmation` = :confirmation " .
                "WHERE `id` = :id");

        $stmt->bindValue(":confirmation", $confirmation);
        $stmt->bindValue(":id", $user->id);

        $result = $stmt->execute();

        return $result;
    }

    /**
     * Update user's forgot password token
     *
     * @param $user
     * @param $token
     * @param $expires
     * @return mixed
     */
    function update_forgot_password($user, $token, $expires)
    {
        $stmt = $this->db
            ->prepare(
                "UPDATE " . $this->table .
                " SET " .
                "`forgot_password` = :token, " .
                "`forgot_password_expires` = :expires " .
                "WHERE `id` = :id");

        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":expires", $expires);
        $stmt->bindValue(":id", $user->id);

        $result = $stmt->execute();

        return $result;
    }

    /**
     * Find by email and password reset token
     *
     * @param $email
     * @param $token
     * @return mixed
     */
    function findByEmailAndResetPasswordToken($email, $token)
    {
        $query = "SELECT * FROM " . $this->table .
            " WHERE `email` LIKE :email AND `forgot_password` LIKE :token ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'email' => $email,
            'token' => $token
        ]);

        if($row = $stmt->fetch()) {
            return $this->rowToUser($row);
        }

        return null;
    }
}