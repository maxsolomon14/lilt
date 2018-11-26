<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;

        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', '=', $user)
                  ->orWhere('recipient_id', '=', $user);
        })
        ->groupBy('sender_id', 'recipient_id')
        ->get()
        ->unique(function ($message) {
            return $message['sender_id'] + $message['recipient_id'];
        });
        
    
        return view('pages.messages')->with('messages', $messages);
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

        $new_message = Message::create(['message' => $request->message, 
                                        'sender_id' => $sender_id, 
                                        'recipient_id' => $recipient_id]);

        return redirect("/inbox/$sender_id/$recipient_id");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message, $sender_id, $recipient_id)
    {
        // $users = Message::where(function ($query) use ($recipient_id, $sender_id) {
        //     $query->where('sender_id', '=', $recipient_id)
        //           ->orWhere('sender_id', '=', $sender_id);
        // })->first();

        $conversation = DB::select('SELECT * FROM messages Where sender_id = ? AND recipient_id = ? OR sender_id = ? AND recipient_id = ?', [$sender_id, $recipient_id, $recipient_id, $sender_id]);

        $users = ['sender_id' => $sender_id,
                  'recipient_id' => $recipient_id];

        return view('pages.inbox')->with('conversation', $conversation)->with('users', $users);
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
