<div class="mainContainer minContainer500">
    <div class="contentBlockBold">
        <div class="title-3">Введите полученный код</div>
        <?= $this->Form->create() ?>
            <div class="formControl">
                <div class="field">
                    <?= $this->Form->control('token', ['class'=>'formField', 'label'=>false,'autofocus' => true]) ?>
                </div>
                <!-- <div class="fieldText textRight"><span class="timer"><span class="minute">05</span><span>:</span><span class="secound">00</span></span></div> -->
            </div>
            <hr/>
            <div class="formSubmit">
                <?= $this->Form->button('Войти', ['class'=>'btn0 btn1 btnBold btnBlock']); ?><br/>
                <?= $this->Html->link('Назад', ['controller' => 'users', 'action' => 'login_sms'],['class'=>'btn0 btnDefault btnBold btnBlock']); ?><br/>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>