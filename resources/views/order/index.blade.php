@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Заказы</h1>
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
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Продукт</th> 
                    <th>Кол-во</th> 
                    <th colspan="2">Действие</th>            
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    @foreach($order->items as $item)
                  <tr>
                    <th>{{ $order->id }}</th>
                    <th>{{ $item->product->title }}</th>
                    <th>{{ $item->quantity }}</th>
                    <td><a href="{{ route('order.edit', $order->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                  </tr>
                    @endforeach
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