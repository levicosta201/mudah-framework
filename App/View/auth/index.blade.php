@extends('static.base')
@section('content')
    <form class="form-signin" method="POST" action="">
        <img class="mb-4" src="https://img.apksum.com/25/br.com.kabum.webviewapp/2.42/icon.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Por favor faça Login</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; Kabum {{ \Carbon\Carbon::now()->format('Y') }}</p>
    </form>
@endsection