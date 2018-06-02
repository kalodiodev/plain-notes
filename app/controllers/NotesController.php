<?php

namespace App\Controllers;

use PDOException;
use App\Request\NoteRequest;
use App\Repository\NoteRepositoryImpl;

/**
 * Notes Controller Class
 *
 * @package App\Controllers
 */
class NotesController {

    use AuthRedirection;

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

    /**
     * Create New Note
     *
     * @return mixed
     */
    public function create()
    {
        $this->require_auth();

        return view('notes/create');
    }

    /**
     * Store Note
     */
    public function store()
    {
        $this->require_auth();

        $request = new NoteRequest();
        $note = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            set_form_errors($request->errors());
            $_SESSION['old_note'] = serialize($note);

            return redirect('notes/create');
        }

        try{
            $this->notesRepository->add($note);
        } catch (PDOException $ex ) {
            error_message($this->exception_message($ex));
        }

        return redirect('notes');
    }

    /**
     * @param PDOException $ex
     *
     * @return string error message
     */
    protected function exception_message(PDOException $ex)
    {
        if ($ex->getCode() == 23000) {
            return "Note already exists!";
        }

        return "Failed to store Note! Something went wrong!" . $ex;
    }
}