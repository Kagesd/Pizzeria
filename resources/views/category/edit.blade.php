@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Редактирование категории</h1>
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
        <div class='col-12'>
          <form action="{{ route('category.update', $category->id) }}" method='POST'  class = "w-25">
            @method('PATCH')
            @csrf
            <div class="form-group">

              <input type="text" class="form-control" name="title" placeholder="Название категории"
              value="{{ $category->title }}">
              @error('title')
                <div class='text-danger'>Это поле необходимо заполнить!</div>

              @enderror
            </div>
            
            <input type="submit" class="btn btn-primary" value='Изменить'>
            <a href='{{ route('category.index') }}'class = "btn btn-danger">Назад</a>
          </form>
        </div>
      </div>
      <!-- /.row -->

    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection