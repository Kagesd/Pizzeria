@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Категории</h1>
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
        <div class="col-1 mb-3">
          <a href='{{ route('category.create') }}' class="btn btn-block btn-primary">Добавить</a>
        </div>
      </div>
        <div class='row'>
        <div class='col-6'>
          <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Название</th> 
                    <th colspan="2">Действие</th>            
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    
                    <th>{{ $category->id }}</th>
                    <th>{{ $category->title }}</th>
                    <td><a href="{{ route('category.edit', $category->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                    <td>
                      <form action="{{ route('category.delete', $category->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type='submit' class='border-0 bg-transparent'>
                          <i class="fas fa-trash text-danger" role='button'></i>
                        </button>
                      </form>         
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->

    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection