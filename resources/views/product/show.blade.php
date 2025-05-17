@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 d-flex align-items-center">
          <h1 class="m-0 mr-2">{{ $product->title }}</h1>
          <a href="{{ route('product.edit', $product->id) }}"><i class="fas fa-pencil-alt"></i></a>
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
                    <td>{{ $product->id }}</td>
                  </tr>
                  <tr>
                    <th>Название</th>             
                    <td>{{ $product->title }}</td>
                  </tr>
                  <tr>
                    <th>Описание</th>             
                    <td>{{ $product->description }}</td>
                  </tr>
                  <tr>
                    <th>Категория</th>             
                    <td>{{ $product->category->title }}</td>
                  </tr>
                  <tr>
                    <th>Цена</th>             
                    <td>{{ $product->price }}</td>
                  </tr>
                  <tr>
                    <th>Превью</th>             
                    <td>
                      <img src="{{ asset('storage/' . $product->preview_image) }}" alt="Превью" style="max-width: 300px;">
                    </td>
                  </tr>
                  <tr>
                    <th>Главное изображение</th>             
                    <td>
                      <img src="{{ asset('storage/' . $product->main_image) }}" alt="Превью" style="max-width: 300px;">
                    </td>
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
      <a href='{{ route('product.index') }}'class = "btn btn-danger">Назад</a>
    </div>
    
  </section>
  <!-- /.content -->
</div>
@endsection