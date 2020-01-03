<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MessageBoard;
use App\Http\Requests\messageRequest;
ini_set('memory_limit','512M');
class MessageBoardApi extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->MessageBoardClass = new MessageBoard;
    }

    public function index()
    {
        $MessageBoard = $this->MessageBoardClass->message_select();
        return $MessageBoard;
    }

    public function show($id)
    {
        return MessageBoard::find($id);
    }

    public function newPast(messageRequest $request){

     
        $newPast = $this->MessageBoardClass->newPast($request);
        return $newPast;


    }

    public function returnPast(messageRequest $request ,$return_id){

        $returnPast = $this->MessageBoardClass->returnPast($request , $return_id);
        return $returnPast;

    }

    public function update(Request $request, $id)
    {
        $article = MessageBoard::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = MessageBoard::findOrFail($id);
        $article->delete();

        return 204;
    }
}
