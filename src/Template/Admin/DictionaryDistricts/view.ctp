<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryDistrict $dictionaryDistrict
 */
?>

<h2><?= __('Dictionary District') ?> #<?= h($dictionaryDistrict->id) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Dictionary Districts'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Dictionary District'), ['action' => 'edit', $dictionaryDistrict->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Dictionary District'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Dictionary Region') ?></th>
        <td><?= $dictionaryDistrict->has('dictionary_region') ? $this->Html->link($dictionaryDistrict->dictionary_region->id, ['controller' => 'DictionaryRegions', 'action' => 'view', $dictionaryDistrict->dictionary_region->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Uz C') ?></th>
        <td><?= h($dictionaryDistrict->name_uz_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Uz L') ?></th>
        <td><?= h($dictionaryDistrict->name_uz_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Ru C') ?></th>
        <td><?= h($dictionaryDistrict->name_ru_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name En L') ?></th>
        <td><?= h($dictionaryDistrict->name_en_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr C') ?></th>
        <td><?= h($dictionaryDistrict->name_qr_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr L') ?></th>
        <td><?= h($dictionaryDistrict->name_qr_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Is Active') ?></th>
        <td><?= h($dictionaryDistrict->is_active) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($dictionaryDistrict->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($dictionaryDistrict->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= $this->Number->format($dictionaryDistrict->modified_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($dictionaryDistrict->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($dictionaryDistrict->modified) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Dictionary District'), ['action' => 'delete', $dictionaryDistrict->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dictionaryDistrict->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>