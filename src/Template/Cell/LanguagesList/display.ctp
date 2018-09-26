<div class="langs">
    <?php if (count($languages) > 0): ?>
        <ul>
        <?php foreach ($languages as $locale => $language): ?>
            <li<?= $locale==$currentLang?' class="active"':'' ?>>
                <?= $this->Html->link($language, ['controller'=>'users', 'action'=>'change-language', $locale]) ?>
            </li>
        <?php endforeach ?>
        </ul>
    <?php endif ?>
</div>