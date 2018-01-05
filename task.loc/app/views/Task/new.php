<div class="row">
    <ol class="breadcrumb">
        <li><a href="/">Список всех задач</a></li>
        <li class="active">Новая задача</li>
    </ol>

    <div class="col-sm-12">
    <?php MessageShow(); ?>

        <form  class="form-horizontal" name="new_task" action="/task/add" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="InputName">Ваше имя</label>
                <input type="text"  name="user_name" class="form-control validation noempty" placeholder="Юрий">
            </div>

            <div class="form-group">
                <label for="InputEmail">Ваш Email</label>
                <input type="email" name="user_email" class="form-control validation noempty email" placeholder="example@email.com">
            </div>


            <div class="form-group">
                <label for="InputImg" >Изображение:<br>
                    <div class="upload_img_wrapper"><div id="preview_img"></div></div>
                </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="8192000" /><br />
                <input type="file" name="user_img" preview-target-id="preview_img">
                <p class="help-block">Допустимый формат <strong>jpg/gif/png</strong>.<br>Допустимый размер -
                    не более 320х240 пикселей, размер файла <strong>не больше 8192КБ</strong> </p>
            </div>

            <script>
                $('input[type="file"][preview-target-id]').on('change', function() {
                    var input = $(this)
                    if (!window.FileReader) return false // check for browser support
                    if (input[0].files && input[0].files[0]) {
                        var reader = new FileReader()
                        reader.onload = function (e) {
                            var target = $('#' + input.attr('preview-target-id'))
                            var background_image = 'url(' + e.target.result + ')'
                            target.css('background-image', background_image)
                            target.parent().show()
                        }
                        reader.readAsDataURL(input[0].files[0]);
                    }
                })
            </script>


            <div class="form-group">
                <label for="InputTask">Задача</label>
                <textarea class="form-control" name="user_task" rows="5" placeholder="Текст задачи"></textarea>
            </div>

            <div class="col-xs-12  col-sm-6 col-md-offset-2 col-md-4">
                <p><!-- вызов модального окна для предпросмотра -->
                    <input type="button" class="btn btn-success" name="button_Preview"  id="button_Preview"
                           value='Предварительный просмотр' data-toggle="modal" data-target="#Preview">
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <p><input type="submit" class="btn btn-default btn-block submit" value='Сохранить задачу'></p>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="Preview" tabindex="-1" role="dialog" aria-labelledby="mLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="mLabel">Предварительный просмотр</h4>
                    </div>
                    <div class="modal-body">
                        <div id="toPreview"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#button_Preview").click(function() {

                var InputName  = $('input[name="user_name"]').val();
                var InputEmail = $('input[name="user_email"]').val();
                var InputImg   = $('input[name="user_img"]').val();
                var InputTask  = $('textarea[name="user_task"]').val();

                $.post('/task/ajax/',
                    {
                        input_name:InputName,
                        input_email:InputEmail,
                        input_img:InputImg,
                        input_task:InputTask
                    },
                    function(data){
                     $("#toPreview").html(data);
                     },

                );}
                );
        });
    </script>
</div>

