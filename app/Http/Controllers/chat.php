<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\private_message;
use App\Models\Messages_model;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\User;

class chat extends Controller
{
    function test_message() {
        event(new NewMessage("hello world"));
    }

    function public_message(Request $request) {
        $data['user_id'] = $request->user()->id;
        $data['user'] = $request->user();
        return view('public_chat',$data);
    }

    function send_message(Request $request) {
        $request->validate([
            'message' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $fileName = null;
        if($request->hasFile('image')){
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
        }

        $data['message'] = $request->input('message');
        $data['user_id'] = $request->user();
        $data['image'] = ($fileName)?'storage/images/'. $fileName:$fileName;
        event(new NewMessage($data));
        $insert_data = [
            'sender_id' => $request->user()->id,
            'receiver_id' => "all",
            'message' => $request->input('message'),
            'image' => ($fileName)?'storage/images/'. $fileName:$fileName
        ];
        Messages_model::insert($insert_data);
    }

    function send_message_private(Request $request) {
        $request->validate([
            'message' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $fileName = null;
        // dd($request->file('image'));
        if($request->hasFile('image')){
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
        }

        $data['message'] = $request->input('message');
        $data['user_id'] = $request->user();
        $data['image'] = ($fileName)?'storage/images/'. $fileName:$fileName;
        $receiver = $request->input("user_id");
        $sender = $request->user()->id;
        event(new private_message($data,"private.$receiver.$sender"));
        $insert_data = [
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->input("user_id"),
            'message' => $request->input('message'),
            'image' => ($fileName)?'storage/images/'. $fileName:$fileName
        ];
        Messages_model::insert($insert_data);
    }

    function get_users(Request $request) {
        $users = User::where('id','!=', $request->user()->id)->get();
        return response()->json($users);
    }

    function fetch_messages(Request $request) {
        $receiver = $request->input("user_id");
        if($receiver == 'public_chat') {
            $data = Messages_model::with('sender_users')->where('receiver_id', 'all')->get();
        } else {
            $data = Messages_model::with('sender_users')->where(function($query) use ($receiver,$request){
                $query->where(['receiver_id'=> $receiver,'sender_id'=> $request->user()->id])->orWhere(['receiver_id'=> $request->user()->id,'sender_id'=> $receiver]);
            })->where('receiver_id', '!=', 'all')->get();
        }
        return response()->json($data);
    }
}
