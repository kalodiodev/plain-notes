<?php

namespace App\Repository;

use App\Model\User;

/**
 * Interface UserRepository
 *
 * @package App\Repository
 */
interface UserRepository {

    /**
     * Get all users
     *
     * @return array of users
     */
    function all();

    /**
     * Save new user
     *
     * @param User $user
     */
    function save(User $user);

    /**
     * Get user by ID
     *
     * @param $id
     * @return User
     */
    function get($id);

    /**
     * Get user by Email
     *
     * @param $email
     * @return mixed
     */
    function getByEmail($email);

    /**
     * Update user
     *
     * @param User $user
     */
    function update(User $user);

    /**
     * Delete User
     *
     * @param User $user
     */
    function delete(User $user);
}