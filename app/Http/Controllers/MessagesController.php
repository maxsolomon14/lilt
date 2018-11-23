<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curr_user = Auth::user()->id;
        $current_user = Auth::user()->id;

        $messages = Message::where(function ($query) use ($current_user, $curr_user) {
            $query->where('sender_id', '=', $current_user)
                  ->orWhere('recipient_id', '=', $curr_user);
        })->get();


        foreach($messages as $message) {
            $a = User::where('id', $message->recipient_id)->first();
        //    dump($a->name);
        //     dd(Auth::user($message->recipient_id)->name);
        if (Auth::user()->id !== $message->sender_id){
            $message->name = Auth::user(Auth::user()->id)->name;
        } else {
            $message->name = $a->name;
        }

                

        }
        if ($messages->isEmpty()) {
            $messages = null;
        }
        //dd($messages);

        $user = new User;

        return view('pages.messages')->with('messages', $messages)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new/message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sender_id, $recipient_id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:300',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
                        
        }

        $new_message = Message::create(['message' => $request->message, 'sender_id' => $sender_id, 'recipient_id' => $recipient_id]);

        dd($new_message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message, $sender_id, $recipient_id)
    {
        $conversation = Message::where(function ($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', '=', $sender_id)
                  ->orWhere('recipient_id', '=', $recipient_id);
        })->get();

        return view('pages.inbox/'.$sender_id.'/'.$recipient_id)->with('conversation', $conversation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
