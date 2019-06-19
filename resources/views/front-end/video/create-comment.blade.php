@if(auth()->user())
    <form action="{{route('front.commentStore',['id'=>$video->id])}}" method="post">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="">Add Comment</label>
            <textarea class="form-control" name="comment" rows="4"></textarea>
        </div>
        <button class="btn btn-default" type="submit">Add Comment</button>
    </form>
@endif