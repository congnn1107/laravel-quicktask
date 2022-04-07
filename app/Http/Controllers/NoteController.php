<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notes = DB::table('notes')->where('user_id', Auth::user()->id)->get();

        return view('pages.note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('pages.note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        //
        $params = $request->all('title', 'content');
        $params['user_id'] = Auth::user()->id;
        $params['title'] = !empty($params['title']) ? $params['title'] : 'untitled';
        $params['created_at'] = Carbon::now()->toDateTimeString();
        $params['updated_at'] =  $params['created_at'];

        $note = DB::table('notes')->insertGetId($params);

        if ($note) {
            $key = 'success';
            $message = __('pages.create_note_success');

            return redirect()->route('note.edit', $note)->with($key, $message);
        } else {
            $key = 'error';
            $message = __('pages.has_error');

            return back()->with($key, $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $note
     * @return \Illuminate\Http\Response
     */
    public function show($note)
    {
        //
        $note = DB::table('notes')
            ->join('users', 'notes.user_id', '=', 'users.id')
            ->where('notes.id', $note)
            ->first(['notes.*', 'users.first_name', 'users.last_name']);
        if (!$note) {
            abort(404);
        }

        return view('pages.note.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $note
     * @return \Illuminate\Http\Response
     */
    public function edit($note)
    {
        $note = DB::table('notes')->where('notes.id', $note)->where('user_id', Auth::user()->id)->first();

        if (!$note) {
            abort(404);
        }

        return view('pages.note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NoteRequest  $request
     * @param  $note
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $note)
    {

        $params = $request->all('title', 'content');
        $params['title'] = !empty($params['title']) ? $params['title'] : 'untitled';
        $params['updated_at'] = Carbon::now()->toDateTimeString();

        $result = DB::table('notes')->where('id', $note)->where('user_id', Auth::user()->id)->update($params);

        if ($result) {
            $key = 'success';
            $message = __('pages.update_note_success');
        } else {
            $key = 'error';
            $message = __('pages.has_error');
        }

        return back()->with($key, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($note)
    {
        //
        $result = DB::table('notes')->where('id', $note)->where('user_id', Auth::user()->id)->delete();

        if ($result) {

            return  redirect()->route('note.index');
        } else {

            return back()->with('error', __('pages.has_error'));
        }
    }
}
