<form method="post" action="/user/create">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" name="login" id="login" aria-describedby="loginHelp" pattern="^[a-zA-Z0-9]{1,16}$" title="Допускаются только цифры и латинские буквы. Максимальный размер логина - 16 символов." required>
        <small id="loginHelp" class="form-text text-muted">Допускаются только цифры и латинские буквы. Максимальный размер логина - 16 символов.</small>
    </div>
    <div class="form-group">
        <label for="email">Электронный адрес</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" aria-describedby="passwordHelp" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Используйте разные регистры + цифры, не менее 6 символов" required>
        <small id="passwordHelp" class="form-text text-muted">Используйте разные регистры + цифры, не менее 6 символов.</small>
    </div>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>