@extends('layouts.app')
@section('title')
    {{$video->name}}
@endsection

@section('meta_keywords',$video->meta_keywords)
@section('meta_des',$video->meta_des)


@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h1>{{$video->name}}</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @php $url= getYoutubeId($video->youtube)  @endphp
                    @if($url)
                        <iframe width="100%"  height="500" src="https://www.youtube.com/embed/{{$url}}" frameborder="0"  style="margin-bottom: 20px" allowfullscreen></iframe>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                   <i class="nc-icon nc-user-run"></i> :  <span style="margin-right: 20px">
                        {{$video->user->name}}
                    </span>
                        <i class="nc-icon nc-calendar-60"></i> : <span style="margin-right: 20px">
                        {{$video->created_at}}
                    </span>
                        <i class="nc-icon nc-single-copy-04"></i> :  <span style="margin-right: 20px">
                       <a href="{{route('front.category',['id'=>$video->cat->id])}}">{{$video->cat->name}}</a>
                    </span>
                    </p>
                    <p>
                        {{$video->des}}
                    </p>
                </div>
                <div class="col-md-3">
                    <h6>Tags</h6>
                    <p>
                        @foreach($video->tags as $tag)
                            <a href="{{route('front.tag',['id'=>$tag->id])}}">
                                <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
                            </a>
                        @endforeach
                    </p>
                </div>
                <div class="col-md-3">
                    <h6>Skills</h6>
                    <p>
                        @foreach($video->skills as $skill)
                            <a href="{{route('front.skill',['id'=>$skill->id])}}">
                                <span class="badge badge-pill badge-info">{{$skill->name}}</span>
                            </a>
                        @endforeach
                    </p>
                </div>


                </div>
            <br> <br>
           @include('front-end.video.comments')
           @include('front-end.video.create-comment')

            </div>
        </div>

@endsection
