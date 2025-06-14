@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Добавление товаров</h1>
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
          <form action="{{ route('product.store') }}" method='POST' enctype="multipart/form-data"  class = "w-25">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="Название продукта" value = "{{ old('title') }}">
              @error('title')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="description" placeholder="Описание продукта" value = "{{ old('description') }}">
              @error('description')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="price" placeholder="Цена" value = "{{ old('price') }}">
              @error('price')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputFile">Загрузите превью изображения</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name='preview_image' class="custom-file-input" id="exampleInputFile" value = "{{ old('preview_image') }}">
                      <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                      @error('preview_image')
                        <div class='text-danger'>Это поле необходимо заполнить!</div>
                      @enderror
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
            </div>  
            <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputFile">Загрузите главное изображения</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name='main_image' class="custom-file-input" id="exampleInputFile" value = "{{ old('main_image') }}">
                      <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                      @error('main_image')
                        <div class='text-danger'>Это поле необходимо заполнить!</div>
                      @enderror
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
            </div> 
            <div class="form-group">
              <label for="exampleSelectBorderWidth2">Категория</label>
              <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="category_id" value = "{{ old('category_id') }}">
                @foreach($categories as $category)
            <option 
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
        @endforeach
              </select>
            </div>
            
            <input type="submit" class="btn btn-primary" value='Добавить'>
          </form>
        </div>
      </div>
      <!-- /.row -->

    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection