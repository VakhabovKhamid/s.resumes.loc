<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="mainContainer minContainer500">
    <div class="contentBlockBold">
        <div class="title-3"><?= __('Введите номер телефона') ?></div>
        <?= $this->Form->create() ?>
            <div class="formControl">
                <div class="field">
                    <?= $this->Form->control('phone', ['class'=>'phone formField', 'label'=>false, 'autofocus' => true]) ?>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
                <?= $this->Form->button(__('Получить код'), ['class'=>'btn0 btn1 btnBold btnBlock']); ?><br/>
                <?= $this->Html->link(__('Назад'), ['controller' => 'pages', 'action' => 'home'],['class'=>'btn0 btnDefault btnBold btnBlock']); ?><br/>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>