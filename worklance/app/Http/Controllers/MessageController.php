<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $id = Auth()->user()->id;
        $request->validate([
            'text' => 'required',
            'user_id' => 'required'
        ]);


        //Saving the Response
        $message = new Message;
        $message->text = $request->text;
        $message->user_id = $request->user_id;
        $message->from_user_id = $id;
        $message->save();


        //Archiving the Message after saving the response
        if ($request->has('message_id_to_be_archived')) {
            $archived_message = Message::findOrFail($request->message_id_to_be_archived);
            $archived_message->archived = 1;
            $archived_message->save();
        }

        return redirect()
            ->back()
            ->with('msg', 'Message has been sent successfully');

    }

    public function sendArchive(Request $request){
        //Saving the Response
        $message = new Message;
        $message->text = $request->text;
        $message->user_id = $request->user_id;
        $message->from_user_id = Auth()->user()->id;
        $message->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function archive($id)
    {
        //Archiving the message
        $msg = Message::findOrFail($id);
        $msg = Message::findOrFail($id);
        $msg->archived = 1;
        $msg->save();
        return redirect()
            ->back()
            ->with('msg', 'Message archived successfully!');
    }
}
