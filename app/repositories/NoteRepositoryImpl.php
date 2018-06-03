<?php

namespace App\Repository;

use PDO;
use App\Model\Note;
use App\Model\User;

class NoteRepositoryImpl implements NoteRepository
{
    private $db;

    private $table = 'notes';

    /**
     * Constructor.
     *
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Get all user's notes
     *
     * @param User $user
     * @return array
     */
    function all(User $user)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user->id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Note::class);
    }

    /**
     * Get note by id
     *
     * @param $id
     * @param User $user
     * @return mixed
     */
    function find($id, User $user)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE `user_id` = :user_id AND `id` = :id");
        $stmt->execute([
            'user_id' => $user->id,
            'id' => $id
        ]);

        return $stmt->fetchObject(Note::class);
    }

    /**
     * Add note
     *
     * @param Note $note
     * @return null|string
     */
    function add(Note $note)
    {
        $stmt = $this->db
            ->prepare(
                "INSERT INTO " . $this->table .
                " ( `title`, `description`, `details`, `exp_date`, `user_id` ) " .
                "VALUES (:title , :description, :details, :exp_date, :user_id)");

        $result = $stmt->execute([
            ':title' => $note->title,
            ':description' => $note->description,
            ':details' => $note->details,
            ':exp_date' => $note->exp_date,
            ':user_id' => $note->user_id
        ]);

        if($result) {
            return $this->db->lastInsertId();
        }

        return null;
    }

    /**
     * Update Note
     *
     * @param Note $note
     * @param User $user
     */
    function update(Note $note, User $user)
    {
        $stmt = $this->db
            ->prepare(
                "UPDATE " . $this->table . " SET " .
                "`title` = :title, `description` = :description, `details` = :details, `exp_date` = :exp_date " .
                "WHERE `id` = :id AND `user_id` = :user_id");

        $stmt->execute([
            ':id' => $note->id,
            ':title' => $note->title,
            ':description' => $note->description,
            ':details' => $note->details,
            ':exp_date' => $note->exp_date,
            ':user_id' => $note->user_id
        ]);
    }

    /**
     * Delete Note
     *
     * @param $id
     * @return mixed|void
     */
    function delete($id)
    {
        $stmt = $this->db->prepare(
                "DELETE FROM " . $this->table . " WHERE `id` = :id");

        $stmt->execute([
            ':id' => $id
        ]);
    }
}