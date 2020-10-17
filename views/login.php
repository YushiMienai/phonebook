<form action="/user/auth" method="post">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
    <button type="button" class="btn btn-link"><a href="/user/register">Перейти к регистрации</a></button>
</form>