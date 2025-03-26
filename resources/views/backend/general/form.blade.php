
@include('backend.sessionMsg')
<div class="card-body">

  <div class="form-group row">
    <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
    <div class="col-md-6">

    <img id="showImage" src="{{(!empty($edit->logo))?URL::to('storage/'.$edit->logo):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt="">
  </div>
</div>
  <div class="form-group">
    <label for="exampleInputFile">Logo <span style="color:red" >*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input type="file" name="logo" class="custom-file-input"  id="image"  value="{{ @$edit->logo }}">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
      </div>

    </div>
  </div>


  <div class="form-group row">
    <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
    <div class="col-md-6">

    <img id="showSliderImage" src="{{(!empty($edit->slider_logo))?URL::to('storage/'.$edit->slider_logo):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt="">
  </div>
</div>
  <div class="form-group">
    <label for="exampleInputFile">Slider Logo <span style="color:red" >*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input type="file" name="slider_logo" class="custom-file-input"  id="image_slider"  value="{{ @$edit->slider_logo }}">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
      </div>

    </div>
  </div>


</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>





