<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="mainContainer minContainer1000">
    <div class="textCenter" style="font-size: 16px; ">
        <?= __("Добро пожаловать в единую базу данных граждан, желающих работать за рубежом.") ?>
        <br>
        <?= __("Пожалуйства, заполните все данные анкеты. Ваша анкета сохранится в нашей базе. Информация о вас станет доступна для компанией, занимающихся отправкой за рубеж. После заполнения анкеты с вами может связаться компания для предложения работы за рубежом.") ?>
    </div>
    <br>
    <br>
</div>
<div class="mainContainer minContainer500">
    <div class="contentBlockBold">
        <div class="title-3"><?= __('Введите номер телефона') ?></div>

        <?= $this->Flash->render('loginSmsPage') ?>
        
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