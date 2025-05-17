@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Редактирование товара</h1>
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
          <form action="{{ route('order.update', $order->id) }}" method="POST">
          @csrf
          @method('PATCH')

          <select name="status" id="status" class="form-control">
              @foreach ($statuses as $status)
                <option value="{{ $status->value }}"
                  {{ $order->status === $status->value ? 'selected' : '' }}>
                {{ $status->label() }}
                </option>
              @endforeach
          </select>
          <input type="submit" class="btn btn-primary" value='Изменить'>
            <a href='{{ route('order.index') }}'class = "btn btn-danger">Назад</a>
          </form>
        </div>
      </div>
      <!-- /.row -->

    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection