console.log('etst');

function appendLoading(){
    $("body").append('<div class="loading">Loading&#8230;</div>');
    $(".loading").show(1);
}

function removeLoading(){
    $(".loading").remove();
}

function hideLoading(){
    $(".loading").hide();
}
//POST отправка формы form ajax комментариев
function sendAjaxForm(form)
{
    appendLoading();
    console.log('submit');
    $.ajax({
        url: $(form).attr('action'),
        type: "POST",
        data: $(form).serialize(),
        success: function(response) {
            console.log('success');
            $("#js-blog_add_comments_container").html(response);
            $('#js-blog_add_comments_container textarea').val('').change();

            //обновляем комментарии
            $.ajax({
                url: window.location.pathname+'/comments/',
                type: "GET",
                success: function(response) {
                    console.log('комментарии success');
                    $("#js-blog_list_comments_container").html(response);
                },
                error: function(response) {
                    alert("На сервере произошла ошибка при обработке Вашего запроса");
                    removeLoading();
                },
                complete:function () {
                    try {}
                    finally {
                        console.log('комментарии complete');
                        hideLoading();
                    }
                }
            });
        },
        error: function(response) {
            alert("На сервере произошла ошибка при обработке Вашего запроса");
            removeLoading();
        },
        complete:function () {
            try {}
            finally {
                console.log('complete');
            }
        }
    });

    return false;
}

//$("#js-blog_add_comments").submit(function(e){
//    sendAjaxForm($('#js-blog_add_comments'),false,false);
//});