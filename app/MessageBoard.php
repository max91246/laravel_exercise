<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class MessageBoard extends Model
{
    protected $fillable = [
        'user_id' , 'content' , 'dateTime' , 'return_id'
    ];

    protected $table = 'message_boards';

    /**
     * 顯示應用程式中所有使用者的列表。
     *
     * @return Response
     */
    public function message_select()
    {

        $MessageBoard = DB::table('message_boards')->whereNull('return_id')
               ->orderBy('id', 'desc')
               ->get();

        foreach($MessageBoard as $k => $v){
            $MessageSencond = DB::table('message_boards')->where('return_id', $v->id)
            ->orderBy('id', 'asc')
            ->get();
            $MessageBoard[$k]->data_array = $MessageSencond;
        }

        return $MessageBoard;
    }

    /**
     * 發佈帖子進行新增
     *
     * @return Response
     */
    public function newPast($request)
    {
        $MessageBoard = new MessageBoard;

        $MessageBoard->user_id = $request->input('user_id');
        $MessageBoard->content = $request->input('content');
        $MessageBoard->dateTime = date('Y-m-d H:i:s');
        $newPast = $MessageBoard->save();

        return json_encode($newPast);
    }

    /**
     * 回覆帖子進行新增
     *
     * @return Response
     */
    public function returnPast($request , $return_id)
    {

        $MessageBoard = new MessageBoard;

        $MessageBoard->user_id = $request->input('user_id');
        $MessageBoard->return_id = $return_id;
        $MessageBoard->content = $request->input('content');
        $MessageBoard->dateTime = date('Y-m-d H:i:s');
        
        $returnPast = $MessageBoard->save();
        
        return json_encode($returnPast);
    }
    

}
