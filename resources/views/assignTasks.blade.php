<form  action="{{route('assignTask')}}" method="post" enctype="multipart/form-data">
  @csrf
   <input type="hidden"  name="id" value="{{$TaskDatas['id'] ?? ''}}">
  <div class="form-group">
      <label>Title</label>
    <div class="input-group col-xs-8">
       <input type="text" class="form-control"  placeholder="title here" name="title" value="{{$TaskDatas['title'] ?? ''}}" readonly>
      </div>
   </div>
   <div class="form-group">
      <label>Assignee</label>
    <div class="input-group col-xs-8">
       <select name="emp_id" class="form-control" >
       	@foreach ($employees as $em)
         <option value="{{$em['id']}}" <?php if(isset($TaskDatas)) if($TaskDatas['assigne'] == $em['id']) {echo "selected";} ?>>{{$em['name']}}</option>
         @endforeach
          
        
      </select>
      </div>
   </div>
   
   <div class="row justify-content-center">
        <button type="submit" class="btn btn-success">Save</button>
   </div>
</form> 

