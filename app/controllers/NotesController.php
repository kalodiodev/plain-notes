<?php

namespace App\Controllers;

use App\Repository\NoteRepositoryImpl;

/**
 * Notes Controller Class
 *
 * @package App\Controllers
 */
class NotesController {

    private $notesRepository;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        global $db;
        $this->notesRepository = new NoteRepositoryImpl($db);
    }

    /**
     * Authenticated user's Notes index
     *
     * @return mixed
     */
    public function index()
    {
        $this->require_auth();

        $notes = $this->notesRepository->all(auth());

        return view('notes/index', [
            'notes' => $notes
        ]);
    }

    protected function require_auth()
    {
        if(! isAuthenticated())
        {
            return redirect('login');
        }
    }
}