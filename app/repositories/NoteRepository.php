<?php

namespace App\Repository;

use App\Model\Note;
use App\Model\User;

/**
 * Interface Note Repository
 *
 * @package App\Repository
 */
interface NoteRepository {

    /**
     * Get all user's notes
     *
     * @param User $user
     * @return mixed
     */
    function all(User $user);

    /**
     * Add note
     *
     * @param Note $note
     * @return mixed
     */
    function add(Note $note);

    /**
     * Update note
     *
     * @param Note $note
     * @return mixed
     */
    function update(Note $note);

    /**
     * Delete note
     *
     * @param $id
     * @return mixed
     */
    function delete($id);

}