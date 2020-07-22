@extends('layouts.app')

@section('content')
<div class="container">

   <div class="d-flex flex-row justify-content-between align-items-center">
      <div><h1>Details for training {{$training->title}}</h1></div><div><a class="btn btn-success" href="{{route('training_home')}}" >Back</a></div>
   </div>
   <div>
   <div class="btn-group" role="group" aria-label="Basic example">
   @can('update',$training)
      <a class="btn btn-secondary" href="{{route('training_edit',$training->id)}}" >Edit</a>
   @endcan   
      @can('delete',$training)
      <form action="{{route('training_destroy',$training->id)}}" method="POST">
         @method('DELETE')
         @csrf
         <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this training?');">Delete</button>
      </form>
      @endcan
   </div>   
   </div>

   <div class="row">
   <div class="col-12"><!-- fa-file-pdf-o   audio-o  movie-o  picture-o-->
   <div class="form-group row mt-1"><div class="col-sm-2"><strong>Title</strong> </div><div class="col-sm-10">{{$training->title}}</div></div>
   <div class="form-group row"><div class="col-sm-2"><strong>Type</strong> </div><div class="col-sm-10">{{$training->types[0]->name}}</div></div>
   
   <div class="form-group row"><div class="col-sm-2"><strong>Description</strong> </div><div class="col-sm-10">{{$training->description}}</div></div>
   <div class="form-group row"><div class="col-sm-2"><strong>Date</strong> </div><div class="col-sm-10">{{$training->created_at}}</div></div>
         
   @can('show_s3',$training)
   @isset($training->url)      
   <iframe src="{{route('training_show_s3',$training->id)}}" style='height: 180%; width: 100%;' title="{{$training->title}}"></iframe>
   @endisset
   @endcan      
       
         
         
   </div>
  
</div>
@endsection