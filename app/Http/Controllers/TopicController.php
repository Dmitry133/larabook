<?php

namespace App\Http\Controllers;

use App\Block;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topisc = Topic::all();
        return view('topic.index',['topics'=>$topisc, 'id'=>0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topic = new Topic;
        return view('topic.create',['topic'=>$topic]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = new Topic;
        //взаимодействуем с моделью
        $topic->topicname = $request->topicnameform;

        if (!$topic->save()) {
            $err = $topic->getErrors();
            return redirect()->action('TopicController@create')->with('errors', $err)->withInput();
        }




//        try {
//            $topic->save();
//        } catch (\Exception $e){
//            $err = $e->getMessage();
//            //если ошибка то вас перенаправит на страницу create и передаст ошибку а так же заполененые поля!
//            //при ошибке в файле topic/creat.blade/php будет передана переменаая errors
//            return redirect()->action('TopicController@create')->with('errors', $err);//->withInput();
//
//        }

        //при успехе в файле topic/create.blade.php будет передана переменная message
        return redirect()->action('TopicController@create')->with('message', "New topic {$topic->topicname} has bid added with ID {$topic->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blocks = Block::where('topicid',$id)->get();//выбираем все блоки соответствующиевыбранному разделу(topic)
        // получение всех топиков
        $topics = Topic::all();
        $is_admin = 0;
        if (Auth::check()) {
            $user_id = Auth::id();
            //echo $user_id;
            $is_admin = User::find($user_id)->is_admin;
        }


       // $topicname = Topic::pluck('topicname','id')->get($id);
        //или
        $topicname = Topic::find($id)->topicname;


        return view('topic.index',['topics'=>$topics,'blocks'=>$blocks,'id'=>$id, 'topicname'=>$topicname, 'is_admin'=>$is_admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function search(Request $request) {
        $search = $request->searchform;
        $search = '%'.$search.'%';//маска поиска на содержимое в любом месте в строке
        $topic = Topic::where('topicname','like',$search)->get();//like ql оператор для поиска совпадений внутри текста
        return view('topic.index',['topics'=>$topic, 'id'=>0]);
    }
}
