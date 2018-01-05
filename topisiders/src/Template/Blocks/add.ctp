<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Block $block
  */
// TODO: delete watermarks from /images/spritemap.png

$this->set('hide_css', ['bake.css', 'cake.css']);
$this->Html->css(['bootstrap.min', 'bootstrap-theme.min', 'sty', 'jquery.minicolors.css'], ['block' => true]);

$this->Html->script(['jquery.minicolors.js', 'jquery.serialize-object.min.js'], ['block' => 'scriptBottom']);

?>
<script type="text/javascript">
    var blockTemplates = <?= json_encode($blocksTemplatesObjs) ?>;
</script>

<div class="row">
            <header class="col-sm-12"></header>
</div>


<?= $this->Form->create($block, [

    'role' => 'form',
    'class' => 'row',
    'id' => 'block-config'
]) ?>


    <div class="form_row col-sm-12">
        <div class="title_block">Генерация блока</div>
        <div class="content_block">
            <label class="label_block">Вид блока</label>
               
            <div class="img_link_block">
                <a class="link_block">Тизер (CPC)</a>
            </div>
            <?= $this->Form->control('site_id', [
                'label' => [
                    'class' => 'label_block',
                    'text' => 'Плошадка'
                ],
                'class' => 'form-control',
            ],
                ['options' => $sites]
            ); ?>
        </div>
    </div>

    <div class="form_row col-sm-12">
        <div class="title_block"> <span class="glyphicon glyphicon-save btn-lg icon_section"></span>Общий вид</div>
        <div class="content_block">
            <?= $this->Form->control('name', [
                'label' => [
                    'class' => 'label_block',
                    'text' => 'Название блока'
                ],
                'class'=>'form-control'
            ]) ?>
                    
            <?= $this->Form->control('template_id', [
                'options' => $blocksTemplates,
                'class'=>'form-control select-block-template',
                'label' => [
                    'class' => 'label_block',
                    'text' => 'Шаблоны блоков'
                ]
            ]) ?>

            <div class="row">
                <div class="col-sm-4 form-group col_s4">
                    <label class="label_block col-sm-12">Кол-во тизеров</label>
                    <?= $this->Form->control('amount_x', [
                        'type' => 'select',
                        'class'=>'col-sm-4 form-control no_width_hundred',
                        'options' => $block->getAllowedTeasersXNumbers(),
                        'label' => false
                    ]) ?>
                    <?= $this->Form->control('amount_y', [
                        'type' => 'select',
                        'class'=>'col-sm-4 form-control no_width_hundred',
                        'options' => $block->getAllowedTeasersYNumbers() ,
                        'label' => false
                    ]) ?>
                </div>

                <div class="col-sm-4 form-group col_s4">
                    <label class="label_block col-sm-12">Ширина блока</label>
                    <?= $this->Form->control('width', [
                        'type' => 'number',
                        'default' => 100,
                        'class' => 'col-sm-3 form-control no_width_hundred',
                        'label' => false
                    ]) ?>
                    <?= $this->Form->control('width_units', [
                        'options' => $block->getWidthUnits(),
                        'class' => 'col-sm-2 form-control no_width_hundred select_size',
                        'label' => false
                    ]) ?>
                </div>
            </div>

            <?= $this->Form->control('no_elemens_code', [
                'class' => 'form-control',
                'label' => [
                    'text' => 'Код заглушки',
                    'class' => 'label_block col-sm-12'
                ]
            ]) ?>
        </div>
    </div>

    <?php /* $this->element('Blocks/logo_settings') */?>

    <div class="form_row col-sm-12">
        <div class="title_block"> <span class="glyphicon glyphicon-save btn-lg icon_section"></span> Внешний вид блока</div>
        <div class="content_block">
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет фона блока</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input type="text" name="blocks_style[block][background-color]" class="colorpick-input" data-position="bottom right" value="#ffffff">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет при наведении</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input type="text" name="blocks_style[block][:hover][background-color]" class="colorpick-input" data-position="bottom right" value="#ffffff">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col_s4">
                    <label class="label_block col-sm-12">Отступы тизеров</label>
                    <div class="form-group">
                        <input name="blocks_style[block][teaser_padding_x]" type="number" class="col-sm-2 form-control no_width" value="0">
                        <input name="blocks_style[block][teaser_padding_y]" type="number" class="col-sm-2 form-control no_width" value="0">
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Обводка блока</label>
                    <div class="block_border_style">
                        <input type="radio" value="solid" class="input_radio" name="blocks_style[block][border-style]" id="block_border_style_solid" checked="checked">
                        <label for="block_border_style_solid" class="label_for_borderstyle_radio borderstyle_label-solid">Сплошная</label>

                        <input type="radio" value="dashed" class="input_radio" name="blocks_style[block][border-style]" id="blockBorderStyledashed">
                        <label for="blockBorderStyledashed" class="label_for_borderstyle_radio borderstyle_label-dashed">Пунктирная</label>

                        <input type="radio" value="dotted" class="input_radio" name="blocks_style[block][border-style]" id="blockBorderStyledotted">
                        <label for="blockBorderStyledotted" class="label_for_borderstyle_radio borderstyle_label-dotted">Точки</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Толщина обводки</label>
                    <input name="blocks_style[block][border-width]" class="form-control" value="0">
                    <span class="block_font_px">px</span>
                </div>
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет обводки</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input type="text" name="blocks_style[block][border-color]" class="colorpick-input" data-position="bottom right" value="#ffffff">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Выравнивание горизонтальное</label>
                    <select name="blocks_style[block][align]" class="col-sm-2 form-control">
                        <option value="left">Слева</option>
                        <option value="center">По центру</option>
                        <option value="right">Справа</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Вертикальное</label>
                    <select name="blocks_style[block][valign]" class="col-sm-2 form-control">
                        <option value="top">По верху</option>
                        <option value="middle">По центру</option>
                        <option value="bottom">По низу</option>
                    </select>
                </div>
            </div>
        </div>
    </div>



    <div class="form_row col-sm-12">
        <div class="title_block"> <span class="glyphicon glyphicon-save btn-lg icon_section"></span> Внешний вид ссылки</div>
        <div class="content_block">
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="label_block">Читать далее</label>
                    <div class="block_show_more">
                        <?= $this->Form->control('blocks_style.link.show_read_more', [
                            'type' => 'checkbox',
                            'default' => false,
                            'label' => [
                                'text' => 'Показать ссылку «читать далее»',
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Выравнивание горизонтальное</label>
                    <select name="blocks_style[link][text-align]" class="col-sm-2 form-control">
                        <option value="left">Слева</option>
                        <option value="center">По центру</option>
                        <option value="right">Справа</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Отступ</label>
                    <input name="blocks_style[link][padding-top]" class="form-control" value="10">
                    <span class="block_font_px">px</span>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Шрифт ссылки</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select name="blocks_style[link][font-family]" class="col-sm-2 form-control">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Impact">Impact</option>
                        <option value="Open Sans">Open Sans</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Garamond">Garamond</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input name="blocks_style[link][font-size]" class="form-control" value="15">
                            <span class="block_font_px block_font_px_small">px</span>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 block__form_fontstyle">
                                <input type="hidden" name="blocks_style[link][font-weight]" value="normal">
                                <input name="blocks_style[link][font-weight]" type="checkbox" class="teaser_link_font_style_bold" value="bold">
                                <label class="label_margin"><b>Ж</b></label>

                                <input type="hidden" name="blocks_style[link][font-style]" value="normal">
                                <input name="blocks_style[link][font-style]" type="checkbox" class="teaser_link_font_style_italic" value="italic">
                                <label class="label_margin"><i>K</i></label>

                                <input type="hidden" name="blocks_style[link][text-decoration]" value="none">
                                <input name="blocks_style[link][text-decoration]" type="checkbox" class="teaser_link_font_style_underline" value="underline">
                                <label class="label_margin"><u>Ч</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[link][color]" type="text" class="colorpick-input" data-position="bottom right" value="#109dc6">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Шрифт ссылки при наведении</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select name="blocks_style[link][:hover][font-family]" class="col-sm-2 form-control">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Impact">Impact</option>
                        <option value="Open Sans">Open Sans</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Garamond">Garamond</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input name="blocks_style[link][:hover][font-size]" class="form-control" value="15">
                            <span class="block_font_px block_font_px_small">px</span>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 block__form_fontstyle">
                                <input type="hidden" name="blocks_style[link][:hover][font-weight]" value="normal">
                                <input name="blocks_style[link][:hover][font-weight]" type="checkbox" class="teaser_link_font_style_bold" value="bold">
                                <label class="label_margin"><b>Ж</b></label>

                                <input type="hidden" name="blocks_style[link][:hover][font-style]" value="normal">
                                <input name="blocks_style[link][:hover][font-style]" type="checkbox" class="teaser_link_font_style_italic" value="italic">
                                <label class="label_margin"><i>K</i></label>

                                <input type="hidden" name="blocks_style[link][:hover][text-decoration]" value="none">
                                <input name="blocks_style[link][:hover][text-decoration]" type="checkbox" class="teaser_link_font_style_underline" value="underline">
                                <label class="label_margin"><u>Ч</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[link][:hover][color]" type="text" class="colorpick-input" data-position="bottom right" value="#109dc6">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="form_row col-sm-12">
        <div class="title_block"> <span class="glyphicon glyphicon-save btn-lg icon_section"></span>Внешний вид тизера</div>
        <div class="content_block">
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет фона тизера</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][background-color]" type="text" class="colorpick-input" data-position="bottom right" value="#ffffff">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет при наведении</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][:hover][background-color]" type="text" class="colorpick-input" data-position="bottom right" value="#ffffff">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Обводка тизера</label>
                    <div class="block_border_style">
                        <input type="radio" class="input_radio" value="solid" name="blocks_style[teaser][border-style]" id="block_border_style_solid">
                        <label for="block_border_style_solid" class="label_for_borderstyle_radio borderstyle_label-solid">Сплошная</label>

                        <input type="radio" value="dashed" class="input_radio" name="blocks_style[teaser][border-style]"  id="blockBorderStyledashed">
                        <label for="blockBorderStyledashed" class="label_for_borderstyle_radio borderstyle_label-dashed">Пунктирная</label>

                        <input type="radio" value="dotted" class="input_radio" name="blocks_style[teaser][border-style]"  id="blockBorderStyledotted" checked="checked">
                        <label for="blockBorderStyledotted" class="label_for_borderstyle_radio borderstyle_label-dotted">Точки</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Толщина обводки</label>
                    <input name="blocks_style[teaser][border-width]" class="form-control" value="0">
                    <span class="block_font_px">px</span>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет обводки</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][border-color]" type="text" class="colorpick-input" data-position="bottom right" value="#919191">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Изображение</h3>
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Расположение</label>
                    <select name="blocks_style[teaser][image][manual][align]" class="col-sm-2 form-control">
                        <option value="left">Слева от текста</option>
                        <option value="right">Справа от текста</option>
                        <option value="top">Сверху от текста</option>
                        <option value="bottom">Снизу от текста</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Размер тизера</label>
                    <select name="blocks_style[teaser][image][height]" class="col-sm-2 form-control">
                        <option value="50">50x50</option>
                        <option value="60">60x60</option>
                        <option value="70">70x70</option>
                        <option value="80">80x80</option>
                        <option value="90">90x90</option>
                        <option value="100">100x100</option>
                        <option value="110">110x110</option>
                        <option value="120">120x120</option>
                        <option value="130">130x130</option>
                        <option value="140">140x140</option>
                        <option value="150" selected>150x150</option>
                        <option value="160">160x160</option>
                        <option value="170">170x170</option>
                        <option value="180">180x180</option>
                        <option value="190">190x190</option>
                        <option value="200">200x200</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Размер при наведении</label>
                    <select name="blocks_style[teaser][image][:hover][height]" class="col-sm-2 form-control">
                        <option value="50">50x50</option>
                        <option value="60">60x60</option>
                        <option value="70">70x70</option>
                        <option value="80">80x80</option>
                        <option value="90">90x90</option>
                        <option value="100">100x100</option>
                        <option value="110">110x110</option>
                        <option value="120">120x120</option>
                        <option value="130">130x130</option>
                        <option value="140">140x140</option>
                        <option value="150" selected>150x150</option>
                        <option value="160">160x160</option>
                        <option value="170">170x170</option>
                        <option value="180">180x180</option>
                        <option value="190">190x190</option>
                        <option value="200">200x200</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Закругление тизера</label>
                    <input name="blocks_style[teaser][image][border-radius]" class="form-control" value="0">
                    <span class="block_font_px">px</span>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Закругление при наведении</label>
                    <input name="blocks_style[teaser][image][:hover][border-radius]" class="form-control" value="0">
                    <span class="block_font_px">px</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Внутренний отступ</label>
                    <input name="blocks_style[teaser][padding]" class="form-control" value="10">
                    <span class="block_font_px">px</span>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Отступ от текста</label>
                    <input name="blocks_style[teaser][image][margin-text]" class="form-control" value="10">
                    <span class="block_font_px">px</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Обводка</label>
                    <div class="block_border_style">
                        <input type="radio" value="solid" class="input_radio" name="blocks_style[teaser][image][border-style]" id="block_border_style_solid" checked="checked">
                        <label for="block_border_style_solid" class="label_for_borderstyle_radio borderstyle_label-solid">Сплошная</label>

                        <input type="radio" value="dashed" class="input_radio" name="blocks_style[teaser][image][border-style]" id="blockBorderStyledashed">
                        <label for="blockBorderStyledashed" class="label_for_borderstyle_radio borderstyle_label-dashed">Пунктирная</label>

                        <input type="radio" value="dotted" class="input_radio" name="blocks_style[teaser][image][border-style]" id="blockBorderStyledotted">
                        <label for="blockBorderStyledotted" class="label_for_borderstyle_radio borderstyle_label-dotted">Точки</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Толщина обводки</label>
                    <input name="blocks_style[teaser][image][border-width]" class="form-control" value="0">
                    <span class="block_font_px">px</span>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Цвет обводки</label>
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][image][border-color]" type="text" class="colorpick-input" data-position="bottom right" value="#919191">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Текст</h3>
            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Расположение текста</label>
                    <select name="blocks_style[teaser][text][manual][text-align]" class="col-sm-2 form-control">
                        <option value="text_near_teaser">Около тизера</option>
                        <option value="text_on_teaser">На тизере</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="label_block col-sm-12">Высота заголовка</label>
                    <input name="blocks_style[teaser][text][line-height]" class="form-control" value="15">
                    <span class="block_font_px">px</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Шрифт заголовка</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select name="blocks_style[teaser][text][font-family]" class="col-sm-2 form-control">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Impact">Impact</option>
                        <option value="Open Sans">Open Sans</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Garamond">Garamond</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input name="blocks_style[teaser][text][font-size]" class="form-control" value="15">
                            <span class="block_font_px block_font_px_small">px</span>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 block__form_fontstyle">
                                <input type="hidden" name="blocks_style[teaser][text][font-weight]" value="normal">
                                <input name="blocks_style[teaser][text][font-weight]" type="checkbox" class="teaser_link_font_style_bold" value="bold">
                                <label class="label_margin"><b>Ж</b></label>

                                <input type="hidden" name="blocks_style[teaser][text][font-style]" value="normal">
                                <input name="blocks_style[teaser][text][font-style]" type="checkbox" class="teaser_link_font_style_italic" value="italic">
                                <label class="label_margin"><i>K</i></label>

                                <input type="hidden" name="blocks_style[teaser][text][text-decoration]" value="none">
                                <input name="blocks_style[teaser][text][text-decoration]" type="checkbox" class="teaser_link_font_style_underline" value="underline">
                                <label class="label_margin"><u>Ч</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][text][color]" type="text" class="colorpick-input" data-position="bottom right" value="#323232">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="label_block col-sm-12">Наведение на тизер</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select name="blocks_style[teaser][text][:hover][font-family]" class="col-sm-2 form-control">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Impact">Impact</option>
                        <option value="Open Sans">Open Sans</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Garamond">Garamond</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input name="blocks_style[teaser][text][:hover][font-size]" class="form-control" value="15">
                            <span class="block_font_px block_font_px_small">px</span>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 block__form_fontstyle">
                                <input type="hidden" name="blocks_style[teaser][text][:hover][font-weight]" value="normal">
                                <input name="blocks_style[teaser][text][:hover][font-weight]" type="checkbox" class="teaser_link_font_style_bold" value="bold">
                                <label class="label_margin"><b>Ж</b></label>

                                <input type="hidden" name="blocks_style[teaser][text][:hover][font-style]" value="normal">
                                <input name="blocks_style[teaser][text][:hover][font-style]" type="checkbox" class="teaser_link_font_style_italic" value="italic">
                                <label class="label_margin"><i>K</i></label>

                                <input type="hidden" name="blocks_style[teaser][text][:hover][text-decoration]" value="none">
                                <input name="blocks_style[teaser][text][:hover][text-decoration]" type="checkbox" class="teaser_link_font_style_underline" value="underline">
                                <label class="label_margin"><u>Ч</u></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group input-group сontainer_block colorpick-container">
                        <input name="blocks_style[teaser][text][:hover][color]" type="text" class="colorpick-input" data-position="bottom right" value="#323232">
                        <div class="color_pick">
                            <div class="change_color preset-black" data-color="#000000"></div>
                            <div class="change_color preset-gray" data-color="#888888"></div>
                            <div class="change_color preset-white" data-color="#ffffff"></div>
                            <div class="change_color preset-transparent" data-color></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12" id="show_res_block">
        <table id="table_show_res"></table>
        <div class="example_block">
        </div>
    </div>
    
    <?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

