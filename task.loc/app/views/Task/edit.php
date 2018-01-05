<div class="row">
    <ol class="breadcrumb">
        <li><a href="/">Список всех задач</a></li>
        <li class="active">Редактирование задачи</li>
    </ol>

    <div class="col-sm-12">
        <?php MessageShow(); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <div class="form-group">
                        <b>Ваше имя:</b>  <?= h($findDataById[0]['name'])?>
                    </div>
                    <div class="form-group">
                        <b> Ваш Email:</b>  <?= h($findDataById[0]['email'])?>
                    </div>
                    <div class="form-group">
                        <b>Статус:</b> <?= h($findDataById[0]['status_name'])?>
                    </div>
                </div>
            </div>
        </div>
        <form  class="form-horizontal" name="new_task" action="/task/edit" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <b>Переопределить статус:</b>

            <div class="panel-status">
                <label class="radio-inline">
                    <input type="radio" name="status" <?=(h($findDataById[0]['status_id']) === '1') ? 'checked="checked"' : ''; ?> value="1"> Не определено


                </label><br>
                <label class="radio-inline">
                    <input type="radio" name="status" <?=(h($findDataById[0]['status_id']) === '2') ? 'checked="checked"' : ''; ?> value="2"> Просрочено
                </label><br>
                <label class="radio-inline">
                    <input type="radio" name="status" <?=(h($findDataById[0]['status_id']) === '3') ? 'checked="checked"' : ''; ?> value="3"> Выполнено


                </label><br>
                <label class="radio-inline">
                    <input type="radio" name="status" <?=(h($findDataById[0]['status_id']) ==='4') ? 'checked="checked"' : ''; ?> value="4"> Выполняется
                </label><br>
            </div>
        </div>
            <div class="form-group">
                <b> Изображение:</b><br>
                    <img class="img-rounded" title="изображение" src="<?= h($findDataById[0]['img'])?>">
            </div>


            <input type="hidden" name="id" value="<?= (int)$get?>">
            <div class="form-group">
                <label for="InputTask">Задача</label>
                <textarea class="form-control" name="user_task"  rows="5" placeholder="Текст задачи"><?= h(nl2br($findDataById[0]['task']))?></textarea>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <p><input type="submit" class="btn btn-success" value='Обновить задачу'></p>
            </div>
        </form>
    </div>
</div>
