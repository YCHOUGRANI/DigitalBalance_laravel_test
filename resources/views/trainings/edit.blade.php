@extends('layouts.app')

@section('content')
<div class="container">


<div class="d-flex flex-row justify-content-between align-items-center">
      <div><h1>Edit Details for {{$training->title}}</h1></div><div><a class="btn btn-success" href="{{route('training_home')}}" >Back</a></div>
   </div>


@if (count($errors) > 0)
   <div class = "alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif

    <form  action="{{ route('training_update',$training->id)}}" method="post" enctype="multipart/form-data" >
         @csrf
         @method('patch')
         @include('trainings.form')
         
        <button type="submit" class="btn btn-primary mt-1">Save Training</button>
   
   </form>
</div>
@endsection