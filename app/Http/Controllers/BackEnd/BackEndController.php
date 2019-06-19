<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class BackEndController extends Controller
{
    protected  $model;
    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function create(){
        $modelName=$this->getModelName();
        $pageTitle="Create ".$modelName;
        $pageDes="Here you can create ".$modelName;
        $folderName=$this->getClassNameFromModel();
        $routeName=$folderName;
        $append=$this->append();
        return view('back-end.'.$this->getClassNameFromModel().'.create',compact('modelName','pageTitle','pageDes','folderName','routeName'))
            ->with($append);
    }
    public function index(){

        $rows=$this->model;
        $rows=$this->filter($rows);
        $with=$this->with();
        if(!empty($with)){
            $rows=$rows->with($with);
        }
        $rows=$rows->paginate(10);
        $modelName=$this->pluralModelName();
        $sModelName=$this->getModelName();
        $pageTitle=$modelName." Control";
        $pageDes="Here you can add / edit / delete ".$modelName;
        $routeName=$this->getClassNameFromModel();

        return view('back-end.'.$this->getClassNameFromModel().'.index',compact('rows','modelName','pageTitle','pageDes','sModelName','routeName'));
    }

    public function edit($id){

        $modelName=$this->getModelName();
        $pageTitle="Edit ".$modelName;
        $pageDes="Here you can edit ".$modelName;
        $folderName=$this->getClassNameFromModel();
        $routeName=$folderName;
        $row=$this->model->findOrfail($id);
        $append=$this->append();
        return view('back-end.'.$this->getClassNameFromModel().'.edit',compact('row','modelName','pageTitle','pageDes','folderName','routeName'))
            ->with($append);
    }

    public  function destroy($id){
        $this->model->findOrfail($id)->delete();
        return redirect()->route($this->getClassNameFromModel().'.index');

    }
    protected function filter($rows){
        return $rows;
    }

    protected  function getClassNameFromModel(){
        return str_plural(strtolower($this->getModelName()));
    }

    protected  function pluralModelName(){
        return str_plural($this->getModelName());
    }
    protected  function getModelName(){
        return class_basename($this->model);
    }

    protected  function  with(){
        return [];
    }

    protected  function  append(){
        return [];
    }


}




