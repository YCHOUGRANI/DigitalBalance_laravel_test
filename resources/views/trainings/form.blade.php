                    
         <div class="form-group">
            <label for="type_id">Select Type</label>
            <select id="type_id" name="type_id" class="form-control form-control-sm">
                 @foreach ($types as $type)
                 <option value="{{$type->id}}" {{$training->type_id == $type->id ? 'selected': ''}}>{{$type->name}}</option>
                 @endforeach
            </select>
         </div>

         <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" value="{{$training['title']}}"  id="title"  name="title" aria-describedby="titleHelp" placeholder="Enter Title">
            <small id="titleHelp" class="form-text text-muted">Title for this training.</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control"  id="description" name="description" aria-describedby="descriptionHelp" placeholder="Enter Description">{{$training['description']}}</textarea>
            <small id="descriptionHelp" class="form-text text-muted">Description for this training.</small>
        </div>
      <!--  <div class="form-group">
            <label for="multimedia">Multimedia {{$training['filename']}}</label>
            <input type="file" value="{{$training['filename']}}" class="form-control" id="multimedia" name="multimedia" aria-describedby="descriptionHelp" placeholder="Please select your file">
            <small id="fileHelp" class="form-text text-muted">File for this training.</small>
        </div> -->