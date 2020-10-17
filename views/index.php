<div class="card shadow bg-light">
    <h5 class="card-header text-center">
        <strong>Добавление новой записи</strong>
    </h5>
    <div class="card-body">
        <form method="post" action="/index/add" id="phoneForm" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name"><strong>Имя</strong></label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname"><strong>Фамилия</strong></label>
                    <input type="text" class="form-control" name="lastname" id="lastname">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone"><strong>Телефон</strong></label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="+7(999)123-45-67" pattern="^[+-()a-zA-Z0-9]{10,16}$" required>
                    <small id="phoneHelp" class="form-text text-muted">Телефон может начинаться с +7 или 8. Допускаются только цифры, +, - и скобки.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="email"><strong>Электронный адрес</strong></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" required>
                </div>
            </div>
            <div class="form-group">
                <label for="pic"><strong>Изображение</strong></label>
                <input type="file" class="form-control-file" name="pic" id="pic" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Принимаются jpeg или png, до 5 мб.</small>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>
<div class="table-responsive-sm">
    <table class="table table-bordered" id="phoneTable">
        <thead class="thead-dark">
        <tr>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Номер телефона</td>
            <td>Электронная почта</td>
            <td></td>
        </tr>
        </thead>
    </table>
</div>
<div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="phoneTitle"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="phoneBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>