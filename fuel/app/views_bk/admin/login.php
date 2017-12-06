<div class="container">

  <form class="form-signin" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <h2 class="form-signin-heading">プロヌリ管理画面</h2>
    
    <label for="email" class="sr-only">メールアドレス</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="メールアドレス">
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif

    <label for="password" class="sr-only">パスワード</label>
    <input id="password" type="password" class="form-control" name="password" required placeholder="パスワード">
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

    <div class="checkbox">
      <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ログイン状態を保存する
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
  </form>

</div>
