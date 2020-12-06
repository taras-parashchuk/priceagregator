$(function() {
$('#load_file').on('change', loadfile);
});

function loadfile() {
$('#addfile span').html('Загружено 0 %');
files = $('#load_file')[0].files;
var form = new FormData();
form.append('upload', files[0]);
$.ajax({
url: '<url-адрес>',
    type: 'POST',
    data: form,
    cache: false,
    processData: false,
    contentType: false,
    xhr: function() {
    var myXhr = $.ajaxSettings.xhr();
    if (myXhr.upload) {
    myXhr.upload.addEventListener('progress',ShowProgress, false);
    }
    return myXhr;
    },
    complete: function(data){
    $('#addfile span').html('Загрузить изображение');
    $('#load_file').val('');
    },
    success: function(message){
    alert(message);
    },
    error: function(jqXHR, textStatus, errorThrown) {
    alert(textStatus+' '+errorThrown);
    }
    });
    }

    function ShowProgress(e) {
    if(e.lengthComputable){
    $('#addfile span').html('Загружено '+Math.round(100*e.loaded/e.total)+' %');
    }
    }
