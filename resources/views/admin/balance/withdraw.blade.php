@extends('adminlte::page')

@section('title', 'Nova Retirada')

@section('content_header')
    <h1>Fazer Retirada</h1>
    
     <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Retirar</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Fazer Retirada</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            
            <form method="post" action="{{ route('withdraw.store') }}">
                {!! csrf_field() !!}
                
                <div class="form-group">
                    <input type="text" name="value" placeholder="Valor Retirado" class="form-control" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Sacar</button>
                </div>
            </form>
        </div>
    </div>
@stop
