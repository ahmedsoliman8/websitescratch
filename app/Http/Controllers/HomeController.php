<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontEnd\Comments\Store;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Page;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'commentUpdate','commentStore'
        ]);
    }

    public  function welcome(){
        $videos=Video::orderBy('id','desc')->paginate(9);
        $videos_count=Video::count();
        $comments_count=Comment::count();
        $tags_count=Tag::count();
        return view('welcome',compact('videos','videos_count','comments_count','tags_count'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public  function messageStore(\App\Http\Requests\FrontEnd\Messages\Store $request){

        Message::create(
           $request->all()
        );
        return redirect()->route('frontend.landing');
    }
    public function index()
    {

        $videos=Video::orderBy('id','desc');
        if(request()->has('search') && request()->get('search') != ''){

            $videos=$videos->where('name','like',"%".request()->get('search')."%");
        }
        $videos=$videos->paginate(30);
        return view('home',compact('videos'));
    }

    public function category($id){
        $cat=Category::findOrfail($id);
        $videos=Video::where('cat_id',$id)->orderBy('id','desc')->paginate(30);
        return view('front-end.category.index',compact('videos','cat'));
    }

    public  function tag($id){
        $tag=Tag::findOrfail($id);
        $videos=Video::whereHas('tags',function ($query)use($id){
            $query->where('tag_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('front-end.tag.index',compact('videos','tag'));
    }

    public function skill($id){
        $skill=Skill::findOrfail($id);
        $videos=Video::whereHas('skills',function ($query)use($id){
            $query->where('skill_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('front-end.skill.index',compact('videos','skill'));
    }

    public  function video($id){
        $video=Video::with('skills','tags','cat','user','comments.user')->findOrfail($id);
        return view('front-end.video.index',compact('video'));
    }

    public function commentUpdate($id,Store $request){
        $comment=Comment::findOrfail($id);
        if(($comment->user_id == auth()->user()->id) || (auth()->user()->group == 'sdmin')){
            $comment->update(['comment'=>$request->comment]);
        }
        return redirect()->route('frontend.video',['id'=>$comment->video_id,'#comments']);
    }

    public function commentStore($id,Store $request){
        $video=Video::findOrfail($id);
        Comment::create(['user_id'=>Auth::user()->id,'video_id'=>$id,'comment'=>$request->comment]);
        return redirect()->route('frontend.video',['id'=>$id,'#comments']);
    }
    public  function page($id,$slug=null){
        $page=Page::findOrfail($id);
        return view('front-end.page.index',compact('page'));
    }

    public  function profile($id,$slug=null){
        $user=User::findOrfail($id);
        return view('front-end.profile.index',compact('user'));

    }
}





