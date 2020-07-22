@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
  <div class="col-12 d-flex">
      <h1>Training List </h1> 
  </div>
</div>
<div class="row">
  <div class="col-4">
      <p>
        @can('create',\App\Training::class)
                <a class="btn btn-primary" href="{{route('training_create')}}"><i class="fa fa-plus-circle mr-2"></i>Add New Training</a>
       @endcan
    </p>
  </div>
  <div class="col-8 float-right">
  <form class="form-inline"  action="{{ route('training_home')}}" method="get" >
         @csrf
      <div class="input-group">
            <input type="text" class="form-control" value="{{ isset($keyword) ? $keyword : '' }}"  id="keyword"  name="keyword" aria-describedby="keywordHelp" placeholder="Search By Keyword">
            <select id="type_ids" name="type_ids" class="form-control">
                 <option value="">Search By Types</option>
                 @foreach ($types as $type)
                 <option value="{{$type->id}}" {{ (isset($type_ids) && ($type_ids === "$type->id")) ? 'selected' : '' }}> {{$type->name}} </option>
                 @endforeach
            </select>
            
           <select id="extension" name="extension" class="form-control">
                 <option value="">Search by Medias</option>
                 <option value="1" {{ (isset($extension) && ($extension === "1")) ? 'selected' : '' }}>Document(pdf,doc,txt..)</option>
                 <option value="2" {{ (isset($extension) && ($extension === "2")) ? 'selected' : '' }}>Video</option>
                 <option value="3" {{ (isset($extension) && ($extension === "3")) ? 'selected' : '' }}>audio</option>
                 <option value="4" {{ (isset($extension) && ($extension == "4")) ? 'selected' : '' }}>image</option>
            </select>
            
            <div class="input-group-append">
                 <button type="submit" class="btn btn-primary"><i class="fa fa-search mr-2"></i> Quick Search</button>
            </div>
       </div>
   </form>    
  </div>
</div> 

@if (!empty($trainings->count()))
  {{$training_count}} trainings found
@endif

<div class="table-responsive">
<table class="table table-striped table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col"> @sortablelink('title','Title') </th>
      <th scope="col">Training Type</th>
      <th scope="col"> @sortablelink('description','Description') </th>
      <th scope="col"> @sortablelink('created_at','Created Date') </th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
@if ($trainings->count())
@foreach($trainings as $training)
<tr>
     <td>{{$training->title}}</td>
     <td>{{$training->types[0]->name}}</td>
     <td>{{$training->description}}</td>
     <td>{{date('d-m-Y H:i:s', strtotime($training->created_at))}}</td>
     <td>
     <div class="btn-group" role="group" aria-label="Basic example">
     <a class="btn btn-success" href="{{route('training_show',$training->id)}}" >   <i class="{{$training->icon ?? 'fas fa-eye-slash'}}"></i> Show</a>
     @can('update',$training)
     <a class="btn btn-secondary" href="{{route('training_edit',$training->id)}}" ><i class="fa fa-edit"></i>Edit</a> 
     @endcan
     @can('delete',$training)
     <form action="{{route('training_destroy',$training->id)}}" method="POST">
         @method('DELETE')
         @csrf
         <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this training?');"><i class="fa fa-trash"></i>Delete</button>
     </form>
     @endcan
</td></tr>
@endforeach
@else
<tr>
     <td colspan="5">Sorry there are no training for your criterias.</td>
</tr> 
@endif    
</tbody>
</table>
</div>
{{$trainings->appends(request()->except(['page', '_token']))->links()}}

@endsection

