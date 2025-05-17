@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 d-flex align-items-center">
          <h1 class="m-0 mr-2">{{ $category->title }}</h1>
          <a href="{{ route('category.edit', $category->id) }}"><i class="fas fa-pencil-alt"></i></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
      </div>
        <div class='row'>
        <div class='col-6'>
          <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <td>{{ $category->id }}</td>
                  </tr>
                  <tr>
                    <th>Название</th>             
                    <td>{{ $category->title }}</td>
                  </tr>
                </tbody> 
              </table>
            </div>
            
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->

    
    </div><!-- /.container-fluid -->
    <div class="col-1 mb-3">
      <a href='{{ route('category.index') }}'class = "btn btn-danger">Назад</a>
    </div>
    
  </section>
  <!-- /.content -->
</div>
@endsection