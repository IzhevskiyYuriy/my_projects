<div class="row">
    <ol class="breadcrumb">
        <li><a href="/">Список всех задач</a></li>
        <li class="active">Просмотр</li>
    </ol>

    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-body">
                    <?php foreach ($findDataById as $res ):?>
                    <div class="col-md-5"><img class="img-rounded" title="изображение" src="<?= h($res['img'])?>"><br></div>
                    <h3 class="panel-title">
                        <div class="form-group">
                            <b>Ваше имя:</b> <?= h($res['name'])?>
                        </div>
                        <div class="form-group">
                            <b>Ваше email:</b> <?= h($res['email'])?>
                        </div>
                        <div class="form-group">
                            <b>Статус:</b> <?= h($res['status_name'])?>
                        </div>

                    <hr>
                    <div class="col-md-7">
                        <em>
                        <?= h($res['task'])?>
                        </em>
                    </div>
                <?php endforeach;?>

            </div>

        </div>
    </div>
</div>

