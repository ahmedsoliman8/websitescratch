<?php

namespace App\Http\Controllers\BackEnd;


use App\Http\Requests\BackEnd\Messages\Store;
use App\Mail\ReplayContact;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class Messages extends BackEndController
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public  function  replay(Store $request,$id){
        $message=$this->model->findOrfail($id);
        Mail::send(new ReplayContact($message,$request->replay));
        return redirect()->route('messages.edit',['id'=>$message->id]);
    }


}
