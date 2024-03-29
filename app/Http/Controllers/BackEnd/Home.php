<?php

namespace App\Http\Controllers\BackEnd;


use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Home extends BackEndController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public  function index(){
        $comments=Comment::orderby('id','desc')->paginate(20);
        return view('back-end.home',compact('comments'));
    }

}
