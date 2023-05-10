


<form  action="{{route('addTask')}}" method="post" enctype="multipart/form-data">
  @csrf
   <input type="hidden"  name="id" value="{{$TaskDatas['id'] ?? ''}}">
  <div class="form-group">
      <label>Title</label>
    <div class="input-group col-xs-8">
       <input type="text" class="form-control"  placeholder="title here" name="title" value="{{$TaskDatas['title'] ?? ''}}">
      </div>
   </div>
   <div class="form-group">
      <label>Description</label>
    <div class="input-group col-xs-8">
       <textarea class="form-control"  rows="4" name="description">{{$TaskDatas['description'] ?? ''}}</textarea>
      </div>
   </div>
   
   <div class="row justify-content-center">
        <button type="submit" class="btn btn-success">Save</button>
   </div>
</form> 

