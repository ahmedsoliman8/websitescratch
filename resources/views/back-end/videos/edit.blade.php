@extends('back-end.layout.app')



@section('title')
    {{$pageTitle}}
@endsection

@section('content')
    @component('back-end.layout.header')
        @slot('nav_title')
            {{$pageTitle}}
        @endslot

    @endcomponent
   @component('back-end.shared.edit',['pageTitle'=>$pageTitle,'pageDes'=>$pageDes])

           <form action="{{route($routeName.".update",["id"=>$row])}}" method="POST"  enctype="multipart/form-data">
               {{method_field("put")}}
               @include('back-end.'.$folderName.'.form')
               <button type="submit" class="btn btn-primary pull-right">Update {{$modelName}}</button>
               <div class="clearfix"></div>
           </form>
           @slot("md4")
               @php $url= getYoutubeId($row->youtube)  @endphp
               @if($url)
               <iframe width="250"  src="https://www.youtube.com/embed/{{$url}}" frameborder="0"  style="margin-bottom: 20px" allowfullscreen></iframe>
               @endif

               <img src="{{url('uploads/'.$row->image)}}"  width="250" alt="">
           @endslot
    @endcomponent
    @component('back-end.shared.edit',['pageTitle'=>'Comments','pageDes'=>'here We can Control comments'])
        @include('back-end.comments.index')
        @slot("md4")
        @include('back-end.comments.create')
        @endslot
    @endcomponent







@endsection
