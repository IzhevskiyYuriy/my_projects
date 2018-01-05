<div class="row">
    <p class="col-sm-12">
        <?php if (empty($findAll)) :?>
            <h4 class="text-center">Вы можете быть первым, кто создаст новую задачу</h4>
        <?php else:?>
            <?php MessageShow(); ?>
            <table class="table table-bordered"  id='table_sort' class='tablesorter'>
                <thead>
                    <tr class="table-header" >
                        <th>Картинка</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Задача</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="table-responsive">
                        <?php foreach ($findAll as $res ):?>
                        <tr>
                            <td ><a href="/task/view/<?= $res['id']?>"><img class="img_size" title="изображение" src="<?= $res['img']?>"></a></td>
                            <td><?= h($res['name'])?></td>
                            <td><?= h($res['email'])?>
                            <td><?= h($model->getShortText($res['task']))?>
                            <td><?= h($res['status_name'])?>
                            <td>
                                <?php if (!empty($_SESSION['admin'])  ):?>
                                <a class="btn btn-success btn-sm" href="/task/edit/<?= $res['id']?>" role="button">Изменить</a><br><br>
                                <?php endif;?>
                                <a class="btn btn-info btn-sm" href="/task/view/<?= $res['id']?>" role="button">Просмотр</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </div>
                </tbody>
            </table>
        </p>
        <?php endif;?>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $("#table_sort").tablesorter({
            headers: {
                0: {sorter: false},3: {sorter: false},5: {sorter: false}
            }
        });
    });
</script>