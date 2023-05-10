<form  action="{{route('addEmployee')}}" method="post" enctype="multipart/form-data">
  @csrf
   <input type="hidden"  name="id" value="{{$employeesDatas['id'] ?? ''}}">
  <div class="form-group">
      <label>Name</label>
    <div class="input-group col-xs-8">
       <input type="text" class="form-control"  placeholder="name here" name="name" value="{{$employeesDatas['name'] ?? ''}}">
      </div>
   </div>
   <div class="form-group">
      <label>Email</label>
    <div class="input-group col-xs-8">
       <input type="email" class="form-control"  placeholder="email here" name="email" value="{{$employeesDatas['email'] ?? ''}}">
      </div>
   </div>
   <div class="form-group">
      <label>Mobile</label>
    <div class="input-group col-xs-8">
       <input type="number" class="form-control"  placeholder="phone number here" name="phone"value="{{$employeesDatas['phone'] ?? ''}}" >
      </div>
   </div>
   <div class="form-group">
      <label>Departments</label>
    <div class="input-group col-xs-8">
      <select name="department" class="form-control" >
          <option value="Sales" <?php if(isset($employeesDatas)) if($employeesDatas['department'] == 'Sales') {echo "selected";} ?>>Sales</option>
          <option value="Marketing" <?php if(isset($employeesDatas)) if($employeesDatas['department'] == 'Marketing') {echo "selected";} ?>>Marketing</option>
          <option value="IT" <?php if(isset($employeesDatas)) if($employeesDatas['department'] == 'IT') {echo "selected";} ?>>IT</option>
      </select>
    </div>
   </div>
   <div class="form-group">
      <label>Status</label>
    <div class="input-group col-xs-8">
     <input type="radio" id="html" name="status" value="Active" <?php if(isset($employeesDatas)){ if($employeesDatas['status'] == 'Active') {echo "checked";} }else {echo "checked"; } ?>>
      <label for="html">&nbsp;Active&nbsp;&nbsp;</label><br>
      <input type="radio" id="css" name="status" value="Inactive" <?php if(isset($employeesDatas)) if($employeesDatas['status'] == 'Inactive') {echo "checked";} ?>>
     <label for="css">&nbsp;Inactive&nbsp;&nbsp;</label><br>
    </div>
   </div>
   <div class="row justify-content-center">
         <button type="submit" class="btn btn-success">Save</button>
   </div>
</form> 

