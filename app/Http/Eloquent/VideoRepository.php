<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\VideosRepositoryInterface;
use App\Models\Video;

class VideoRepository implements  VideosRepositoryInterface {

    protected  $video;
    public function __construct(Video $video)
    {
        $this->video=$video;
    }

    public  function GetAllVideos($id){
        return  $this->video::where('id',$id)->get();
    }

}