<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessageBoard;
use App\Http\Requests\messageRequest;

class MessageBoardControll extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->MessageBoardClass = new MessageBoard;
    }

    public function index(){
        
        $MessageBoard = $this->MessageBoardClass->message_select();


        return view('message_board.index' , [
            'MessageBoards' => $MessageBoard
        ]);
    }

    public function newPast(messageRequest $request){

        $newPast = $this->MessageBoardClass->newPast($request);
        return redirect('/messageboard');


    }

    public function returnPast(messageRequest $request ,$return_id){

        $newPast = $this->MessageBoardClass->returnPast($request , $return_id);
        return redirect('/messageboard');

    }
    


    
}
