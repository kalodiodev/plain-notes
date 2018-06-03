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

    function update(Note $note)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete Note
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