@extends('backend.layouts.master')
@section('title')
    General Form- Index
@endsection
@section('content')
  <!-- Include SweetAlert CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <section class="content-header" >
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6 offset-3">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row offset-1">
          <!-- left column -->
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">General Form</h3>

                @if ($generalCount < 1)
                <a href="{{route('general.create')}}" class="float-right btn btn-outline-dark btn-sm mb-2"><i class="fas fa-plus-square"></i></a>

                @endif
           


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.sessionMsg')
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Slider Image</th>
                 
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>






                  

                    @if ($generalCount > 0)
                    <tr>
                      <td>1</td>
                      <td><img src="{{(!empty($general->logo))?URL::to('storage/'.$general->logo):URL::to('image/no_image.png')}}" alt="image_profile" style="max-height: 150px"></td>
                      <td><img src="{{(!empty($general->slider_logo))?URL::to('storage/'.$general->slider_logo):URL::to('image/no_image.png')}}" alt="slider_image" style="max-width: 250px"></td>
                   
                      <td>
                        <a href="{{route('event.edit',[$item])}}" title="Edit">
                          <button class="btn btn-outline-info btn-sm"><i class="fas fa-pen-square"></i></button>
                        </a>
                        <button class="btn btn-outline-danger btn-sm" title="Delete" onclick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                        <form id="delete-form-{{ $item->id }}" action="{{route('event.destroy',[$item])}}" method="POST" style="display:none;">
                          @method('DELETE')
                          @csrf
                        </form>
                      </td>
  
                    </tr>
                    @endif

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Slider Image</th>
                    <th>Action</th>

                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <script>
      function confirmDelete(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
          }
        })
      }
    </script>
@endsection
