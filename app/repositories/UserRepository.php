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
     * Update user password
     *
     * @param $user_id
     * @param $password
     * @return mixed
     */
    function update_password($user_id, $password);

    /**
     * Delete User
     *
     * @param User $user
     */
    function delete(User $user);

    /**
     * Find User by confirmation token
     *
     * @param $token
     * @return mixed
     */
    function findByConfirmationToken($token);

    /**
     * Update user's confirmation
     *
     * @param $user
     * @param $confirmation
     * @return mixed
     */
    function update_confirmation($user, $confirmation);

    /**
     * Update user's forgot password token
     *
     * @param $user
     * @param $token
     * @param $expires
     * @return mixed
     */
    function update_forgot_password($user, $token, $expires);

    /**
     * Find by email and password reset token
     *
     * @param $email
     * @param $token
     * @return mixed
     */
    function findByEmailAndResetPasswordToken($email, $token);
}