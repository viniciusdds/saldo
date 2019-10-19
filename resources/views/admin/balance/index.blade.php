@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>
    
    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('balance.deposito') }}" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Recarregar</a>
            @if($amount > 0)
                <a href="{{ route('balance.withdraw') }}" class="btn btn-danger"><i class="fa fa-cart-arrow-down"></i> Sacar</a>
            @endif
            @if($amount > 0)
                <a href="{{ route('balance.transfer') }}" class="btn btn-info"><i class="fa fa-exchange"></i> Transferir</a>
            @endif
        </div> 
        <div class="box-body">
            @include('admin.includes.alerts')
            <div class="small-box bg-green">
            <div class="inner">
              <h3>R$ {{ number_format($amount, 2, ',', '') }}</h3>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
                <br>
            <a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
    </div>
@stop

