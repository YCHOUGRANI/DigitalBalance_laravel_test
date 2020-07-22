<?php

namespace App\Http\Controllers;

use Validator;
use App\Training;
use App\TrainingType;
//use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword =$request->get('keyword');
        $type_ids =$request->get('type_ids');
        $extension =$request->get('extension');

        
        
        $types= TrainingType::all();
        
        $training_count= Training::latest()
                          ->search($keyword)
                          ->searchCategory($type_ids)
                          ->searchExtension($extension)->count();
        $trainings= Training::sortable()
                          ->search($keyword)
                          ->searchCategory($type_ids)
                          ->searchExtension($extension)
                          ->paginate(6);
       
         return view('trainings.index',compact('trainings','training_count','types','keyword','type_ids','extension'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  // $request->session()->flash('status', 'Task was successful!');
        $types= TrainingType::all();
        //dd($types);
        $training = new Training();
        return view('trainings.create',compact('types','training'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $validation=$request->validate([
            'type_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required|max:2048',
            'multimedia' => 'file|max:5048|mimes:jpeg,png,bmp,gif,svg,mov,mp4,mpg,jpg,mpeg,ogv,webm,pdf'
        ]);

        if (!empty($validation['multimedia'])) {
        $path=$request->file('multimedia')->storeAs('images',$request->file('multimedia')->getClientOriginalName(),'s3');
        $training=Training::create([
             'filename' => basename($path),
             'type_id' => $request->type_id,
             'url' => Storage::disk('s3')->url($path),
             'title' => $request->title,
             'description' => $request->description,
             'original_name' => $request->file('multimedia')->getClientOriginalName(),
             'mime_type' => $request->file('multimedia')->getClientMimeType(),
             'extension' => strtolower($request->file('multimedia')->getClientOriginalExtension()),
             'size' => strtolower($request->file('multimedia')->getSize()),
        ]);
        } else {
            $training=Training::create([
                'type_id' => $request->type_id,
                'title' => $request->title,
                'description' => $request->description
           ]);
        }
        $notification = array(
            'message' => 'Training created successfully!',
            'alert-type' => 'success'
        );
        return redirect('/')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * 
     * 
     */
    public function show(Training $training)
    {
        $training_types =TrainingType::all();
        return view('trainings.show',compact('training','training_types'));
    }
    public function show_s3(Training $training)
    {   
        return Storage::disk('s3')->response('images/'.$training->filename);
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {   
        $types= TrainingType::all();
        return view('trainings.edit',compact('training','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Training $training)
    {  
        if (auth()->user()->can('update',$training)) {
        $data=$request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:2048',
            'type_id'=>'required'
        ]);
        $training->update($data);
        }

        $notification = array(
            'message' => 'Training updated successfully!',
            'alert-type' => 'success'
        );
        return redirect('training/'.$training['id'])->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        if (auth()->user()->can('delete',$training)) {
             $training->delete();
             Storage::disk('s3')->delete('images/'.$training->filename); 
        }
        $notification = array(
            'message' => 'Training deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect('/')->with($notification);
    }
}
