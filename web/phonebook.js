$(function(){
    $("#phoneForm").bind('submit', function(e) {
        e.preventDefault();
        console.log('submit');
        let formData = new FormData($(this)[0]);
        formData.append('pic', $('#pic')[0].files[0]);
        $.ajax({
            type     : "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            url      : $(this).attr('action'),
            data     : formData,
            success  : function(data) {
                $("#phoneForm")[0].reset();
                appendPhone(data);
            }
        });
    });

    $('#pic').bind('change', function() {
        let errorStr = '';
        if (this.files[0].size > 5242880) {
            errorStr = 'Превышен размер файла.<br>';
        }
        if(!this.files[0].type.match('image/jpeg') && !this.files[0].type.match('image/png')){
            errorStr = errorStr + 'Допустимые типы файлов: jpg и png.';
        }
        if(errorStr !== ''){
            $("#phoneTitle").html('Некорректный файл');
            $("#phoneBody").html(errorStr);
            $("#phoneModal").modal('toggle');
            $('#pic').val('');
        }
    });

    function appendPhone(data){
        $("#phoneTable").append(`
<tr id="tr_${data.id}">
    <td>${data.name}</td>
    <td>${data.lastname}</td>
    <td>${data.phone}</td>
    <td>${data.email}</td>
    <td>
        <button type="button" class="btn btn-primary" onclick="showPhone(${data.id})">Посмотреть</button>
        <button type="button" class="btn btn-primary" onclick="delPhone(${data.id})">Удалить</button>
    </td>
</tr>`)
    }

    fetch('/index/all')
        .then(res => res.json())
        .then((out) => {
            for(let key in out){
                appendPhone(out[key]);
            }
        })
        .catch(err => { throw err });
});

function delPhone(id){
    console.log(id);

    fetch('/index/del/?id=' + id)
        .then(res => res.text())
        .then((del) => {
            if (del === "1") $("#tr_" + id).remove();
        })
        .catch(err => { throw err });
}
function showPhone(id){
    console.log(id);

    fetch('/index/show/?id=' + id)
        .then(res => res.json())
        .then((data) => {
            $("#phoneTitle").html(`
<div>${data.lastname} ${data.name}</div>
`);
            $("#phoneBody").html(`
            <div>Телефон: ${data.phone}</div>
            <div>EMail: ${data.email}</div>
            <div><img src="${data.pic}" width="100%"></div>
            `);
            $("#phoneModal").modal('toggle');
        })
        .catch(err => { throw err });
}