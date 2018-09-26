<div class="pagePadding">
    <div class="mainContainer minContainer500">
        <div class="contentBlockBold">
            <div class="textCenter hButtons">
                <?php if (count($languages) > 0): ?>
                    <?php foreach ($languages as $locale => $language): ?>
                        <?= $this->Html->link($language, ['controller'=>'users', 'action'=>'change-language', $locale],['class' => 'btn0 btn1 btnBold btnBlock']) ?>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
