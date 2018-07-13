<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="mainContainer minContainer500">
    <div class="contentBlockBold">
        <div class="title-3">Введите номер телефона</div>
        <?= $this->Form->create() ?>
            <div class="formControl">
                <div class="field">
                    <?= $this->Form->control('phone', ['class'=>'phone formField', 'label'=>false, 'autofocus' => true]) ?>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
                <?= $this->Form->button('Получить код', ['class'=>'btn0 btn1 btnBold btnBlock']); ?><br/>
                <a href="index.html" class="btn0 btnDefault btnBold btnBlock">Назад</a>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>