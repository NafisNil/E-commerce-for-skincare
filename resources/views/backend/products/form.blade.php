@include('backend.sessionMsg')
<div class="card-body">


    <div class="form-group row">
        <label for="Image" class="col-md-4 col-form-label text-md-right"></label>
        <div class="col-md-6">

        <img id="showImage" src="{{(!empty($edit->logo))?URL::to('storage/'.$edit->logo):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt=""  >
      </div>
    </div>
      <div class="form-group">
        <label for="exampleInputFile">Featured  Image<span style="color:red" >*</span></label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="logo" class="custom-file-input"  id="image" value="{{ @$edit->logo }}">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>

        </div>
      </div>




  <div class="form-group">
    <label for="exampleInputEmail1">Name <span style="color:red" >*</span></label>

    <input type="text"  class="form-control" name="name"  value="{!!old('name',@$edit->name)!!}">

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Category <span style="color:red" >*</span></label>

    <select name="category_id" id="category_id" class="form-control">
      <option value="">Select Category</option>
      @foreach ($category as $item)
      <option value="{{ $item->id }}" {{ @$edit->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
       
      
    </select>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Sub Category <span style="color:red" >*</span></label>

    <select name="sub_category_id" id="sub_category_id" class="form-control">
      <option value="">Select Sub Category</option>
      @foreach ($subCategory as $item)
      <option value="{{ $item->id }}" data-category-id="{{ $item->category_id }}" {{ @$edit->sub_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
       
      
    </select>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Brand <span style="color:red" >*</span></label>

    <select name="brand_id" id="brand_id" class="form-control">
      <option value="">Select Brand</option>
      @foreach ($brand as $item)
      <option value="{{ $item->id }}" {{ @$edit->brand_id == $item->id? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
       
      
    </select>

  </div>



  <div class="form-group">
    <label for="exampleInputEmail1">Skin Type <span style="color:red" >*</span></label>

    <select name="skintype_id" id="skintype_id" class="form-control">
      <option value="">Select Skin Type</option>
      @foreach ($skintype as $item)
      <option value="{{ $item->id }}" {{ @$edit->skintype_id == $item->id? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
       
      
    </select>

  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Short Description <span style="color:red" >*</span></label>

    <textarea name="short_description" id="" cols="30" rows="5" class="form-control">{!!old('description',@$edit->short_description)!!}</textarea>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Description <span style="color:red" >*</span></label>

    <textarea name="description" id="" cols="30" rows="10" class="form-control">{!!old('description',@$edit->description)!!}</textarea>

  </div>

  <div class="form-group row">
    <div class="col-md-6">
        <label for="exampleInputEmail1">Regular Price <span style="color:red">*</span></label>
        <input type="number" class="form-control" name="regular_price" value="{!!old('regular_price',@$edit->regular_price)!!}">
    </div>
    <div class="col-md-6">
        <label for="exampleInputEmail1">Sales Price <span style="color:red">*</span></label>
        <input type="number" class="form-control" name="sales_price" value="{!!old('sales_price',@$edit->sales_price)!!}">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-6">
        <label for="exampleInputEmail1">SKU  <span style="color:red">*</span></label>
        <input type="number" class="form-control" name="sku" value="{!!old('sku',@$edit->SKU)!!}">
    </div>
    <div class="col-md-6">
        <label for="exampleInputEmail1">Quantity  <span style="color:red">*</span></label>
        <input type="number" class="form-control" name="quantity" value="{!!old('quantity',@$edit->quantity)!!}">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-6">
        <label for="exampleInputEmail1">Stock Status  <span style="color:red">*</span></label>
       <select name="stock_status" id="" class="form-control">
            <option value="">Select Stock Status</option>
            <option value="instock" {{ @$edit->stock_status == 'instock' ? 'selected' : '' }}>In Stock</option>
            <option value="outofstock"  {{ @$edit->stock_status == 'outofstock' ? 'selected' : '' }}>Out Of Stock</option>
       </select>
    </div>
    <div class="col-md-6">
        <label for="exampleInputEmail1">Featured  <span style="color:red">*</span></label>
        <select name="featured" id="" class="form-control">
          
          <option value="1" {{ @$edit->featured == '1' ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ @$edit->featured == '0' ? 'selected' : '' }}>No</option>
     </select>
    </div>

    <div class="form-group">
      <label for="exampleInputFile">  Images<span style="color:red" >*</span></label>
     
      <div class="input-group">
        <div class="custom-file">
    
          <input type="file" name="images[]" class="custom-file-input"  id="images" value="{{ @$edit->images }}" multiple>
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
      </div>
      <div class="mt-2 mb-1 p-1">
        @foreach (explode(',',@$edit->images) as $image)
        <img src="{{ asset('storage/'.trim($image)) }}" alt="" style="max-height:80px; border-radius:10%;">
        @endforeach
      </div>
      <div id="imagePreviewContainer" class="mt-3 d-flex flex-wrap"></div>
    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        const imagesInput = document.getElementById('images');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

        categorySelect.addEventListener('change', function () {
            const selectedCategoryId = this.value;

            // Reset subcategory options
            subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';

            // Filter and append subcategories
            @foreach ($subCategory as $item)
            if (selectedCategoryId == '{{ $item->category_id }}') {
                const option = document.createElement('option');
                option.value = '{{ $item->id }}';
                option.textContent = '{{ $item->name }}';
                subCategorySelect.appendChild(option);
            }
            @endforeach
        });

        imagesInput.addEventListener('change', function () {
            imagePreviewContainer.innerHTML = ''; // Clear previous previews
            const files = Array.from(this.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.margin = '5px';
                    img.style.border = '1px solid #ddd';
                    img.style.objectFit = 'cover';
                    imagePreviewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>







