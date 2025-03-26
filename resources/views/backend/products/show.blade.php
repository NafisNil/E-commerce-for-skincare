@extends('backend.layouts.master')
@section('title')
    Products - Show
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>{{@$product->name}}</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{@$product->name}}</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
      
          <!-- Main content -->
          <section class="content">
      
            <!-- Default box -->
            <div class="card card-solid">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{@$product->name}}</h3>
                    <div class="col-12">
                      <img src="{{(!empty($product->logo))?URL::to('storage/'.$product->logo):URL::to('image/no_image.png')}}" class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        @foreach (explode(',',$product->images)  as $key => $value) 
                         
                            <div class="product-image-thumb active"><img src="{{(!empty($value))?URL::to('storage/'.$value):URL::to('image/no_image.png')}}" alt="Product Image"></div>
                        @endforeach
                    
                     
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{@$product->name}}</h3>
                    <p>{!! $product->short_description !!}</p>
                    <b>Featured : </b> {{ @$product->featured == 1 ? 'Yes' : 'No' }} <br>
                    <b>SKU : </b> {{ @$product->SKU }} <br>
                    <b>Stock Status : </b>  @if (@$product->stock_status == 'instock')
                      <span class="badge badge-success">In Stock</span>
                    @else
                      <span class="badge badge-danger">Out Of Stock</span>
                        
                    @endif<br>
                    <b>Skin Type : </b> {{ @$product->skinType->name }} <br>
      
                    <hr>
            
      
       
      
                    <div class="bg-gray py-2 px-3 mt-4">
                      <h2 class="mb-0">
                        {{ @$product->sales_price }} Tk
                      </h2>
                      <h4 class="mt-0">
                        <small>Regular Price:   {{ @$product->regular_price }} Tk</small>
                      </h4>
                    </div>
      

      
                  </div>
                </div>
                <div class="row mt-4">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                      <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Brand/Category</a>
                      <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Quantity</a>
                    </div>
                  </nav>
                  <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {!! @$product->description !!}</div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                        <b>Brand : </b> {{ @$product->brand->name }} <br>
                        <b>Category : </b> {{ @$product->category->name }} <br>
                        <b>Sub Category : </b> {{ @$product->subCategory->name }} <br>
                    </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> {{ @$product->quantity }}</div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
          </section>
          <!-- /.content -->
@endsection