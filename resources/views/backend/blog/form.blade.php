
@include('backend.sessionMsg')
<div class="card-body">





  <div class="form-group">
    <label for="exampleInputEmail1">Name <span style="color:red" >*</span></label>

  
    <select name="skintype_id" id="" class="form-control">
      @foreach ($skintype as $item)
      <option value="{{ $item->id }}">{{ $item->name }}</option>
      @endforeach
       
      
    </select>

  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Description <span style="color:red" >*</span></label>

    <textarea name="description" id="" cols="30" rows="10" class="form-control">{!!old('description',@$edit->description)!!}</textarea>

  </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>


<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>



<script>

    CKEDITOR.replace( 'description' );

</script>






