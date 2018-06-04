<?php

namespace App\Controllers;

use PDOException;
use App\Core\Helper\Pager;
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

        global $config;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $notesCount = $this->notesRepository->count(auth());
        $pager = new Pager($page, $notesCount, $config['pagination_items_per_page']);

        $notes = $this->notesRepository->paginated(auth(), $pager->page());

        return view('notes/index', [
            'notes' => $notes,
            'pager' => $pager
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
     * Edit Note
     * 
     * @return mixed|void
     */
    public function edit()
    {
        $this->require_auth();

        if(! isset($_GET['id']))
        {
            return redirect('notes');
        }

        $note = $this->notesRepository->find($_GET['id'], auth());

        if($note != null) {
            return view('notes/edit', [
                'note' => $note
            ]);
        }

        return redirect('notes');
    }

    /**
     * Update Note
     */
    public function update()
    {
        $this->require_auth();

        $request = new NoteRequest();
        $note = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            set_form_errors($request->errors());
            $_SESSION['old_note'] = serialize($note);

            return redirect('notes/edit?id=' . $note->id);
        }

        try{
            $this->notesRepository->update($note, auth());
        } catch (PDOException $ex ) {
            error_message($this->exception_message($ex));
        }

        return redirect('notes');
    }

    /**
     * Delete Note
     */
    public function destroy()
    {
        $this->require_auth();

        if(isset($_GET['id'])) {
            $this->notesRepository->delete($_GET['id']);
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