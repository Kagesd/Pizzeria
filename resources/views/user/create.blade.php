@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Добавление пользователей</h1>
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
          <form action="{{ route('user.store') }}" method='POST' enctype="multipart/form-data"  class = "w-25">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="first_name" placeholder="Имя" value = "{{ old('first_name') }}">
              @error('first_name')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="last_name" placeholder="Фамилия" value = "{{ old('last_name') }}">
              @error('last_name')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Почта" value = "{{ old('email') }}">
              @error('email')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="string" class="form-control" name="phone_number" placeholder="Номер телефона" value = "{{ old('phone_number') }}">
              @error('phone_number')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="string" class="form-control" name="password" placeholder="Пароль" value = "{{ old('password') }}">
              @error('password')
                <div class='text-danger'>Это поле необходимо заполнить!</div>
              @enderror
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