<div class="pagePadding">
    <div class="mainContainer minContainer500">
        <div class="contentBlockBold">
            <div class="textCenter hButtons">
            <?= $this->Html->link('Узбекча', ['prefix'=>false, 'controller'=>'users', 'action'=>'change-language', 'uz-latn'],['class' => 'btn0 btn1 btnBold btnBlock']) ?>
            <?= $this->Html->link('O`zbekcha', ['prefix'=>false, 'controller'=>'users', 'action'=>'change-language', 'uz-cyrl'],['class' => 'btn0 btn1 btnBold btnBlock']) ?>
            <?= $this->Html->link('Русский', ['prefix'=>false, 'controller'=>'users', 'action'=>'change-language', 'ru'],['class' => 'btn0 btn1 btnBold btnBlock']) ?>
            <?= $this->Html->link('Қарақалпақша', ['prefix'=>false, 'controller'=>'users', 'action'=>'change-language', 'kaa'],['class' => 'btn0 btn1 btnBold btnBlock']) ?>
            </div>
        </div>
    </div>
</div>
