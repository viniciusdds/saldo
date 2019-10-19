@extends('site.layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<h1>Meu Perfil</h1>

@include('admin.includes.alerts')
 <script>
        function voltar(){
            location.href="{{route('home')}}";
        }
</script>
<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" value="{{ auth()->user()->name }}" name="name" placeholder="Nome" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" value="{{ auth()->user()->email }}" name="email" placeholder="E-mail" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="Senha" class="form-control">
    </div>
    <div class="form-group">
        @if(auth()->user()->image != null)
        <img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="max-width: 50px">
        @endif
       
        <label for="image">Imagem:</label>
        <input type="file" name="image" class="btn btn-primary">
    </div>
    
    <div class="form-group">
        <button type="button" onclick="voltar();" class="btn btn-dark">Voltar</button>
        <button type="submit" class="btn btn-info">Atualizar Perfil</button>
    </div>
</form>

@endsection