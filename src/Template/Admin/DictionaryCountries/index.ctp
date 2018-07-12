<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryCountry[]|\Cake\Collection\CollectionInterface $dictionaryCountries
 */
?>
<h2><?= __('Dictionary Countries') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
    <?= $this->Paginator->counter(['format' => __('Page: {{page}} / {{pages}}, total records {{count}}')]) ?>
    </div>
    <div class="pull-right">
        <div class="btn-group group-control">
            <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', ['action' => 'add'],['escape' => false,'class' => 'btn btn-default btn-sm']) ?>
            <button class="btn btn-default btn-sm btn-refresh">
                <span class="glyphicon glyphicon-refresh"></span>
            </button>
            <button class="btn btn-default btn-sm btn-search">
                <span class="glyphicon glyphicon-filter"></span>
            </button>
        </div>
    </div>
</div>
<br>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-condensed">
    <thead>
        <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_uz_c') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_uz_l') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_ru_c') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_en_l') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_qr_c') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_qr_l') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        <form action="" id='row-search' method="post">
        <tr class="row-search">
                        <th>
                <input type="text" name="id">
            </th>
                        <th>
                <input type="text" name="name_uz_c">
            </th>
                        <th>
                <input type="text" name="name_uz_l">
            </th>
                        <th>
                <input type="text" name="name_ru_c">
            </th>
                        <th>
                <input type="text" name="name_en_l">
            </th>
                        <th>
                <input type="text" name="name_qr_c">
            </th>
                        <th>
                <input type="text" name="name_qr_l">
            </th>
                        <th>
                <input type="text" name="is_active">
            </th>
                        <th>
                <input type="text" name="created">
            </th>
                        <th>
                <input type="text" name="created_by">
            </th>
                        <th>
                <input type="text" name="modified">
            </th>
                        <th>
                <input type="text" name="modified_by">
            </th>
                        <th>
                <button class="btn btn-default btn-xs btn-filter" type="submit">
                    <span class="glyphicon glyphicon-ok"></span>
                </button>
                <button class="btn btn-default btn-xs btn-filter-clear" type='button'>
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </th>
        </tr>
        </form>
    </thead>
    <tbody>
        <?php foreach ($dictionaryCountries as $dictionaryCountry): ?>
        <tr>
            <td><?= $this->Number->format($dictionaryCountry->id) ?></td>
            <td><?= h($dictionaryCountry->name_uz_c) ?></td>
            <td><?= h($dictionaryCountry->name_uz_l) ?></td>
            <td><?= h($dictionaryCountry->name_ru_c) ?></td>
            <td><?= h($dictionaryCountry->name_en_l) ?></td>
            <td><?= h($dictionaryCountry->name_qr_c) ?></td>
            <td><?= h($dictionaryCountry->name_qr_l) ?></td>
            <td><?= h($dictionaryCountry->is_active) ?></td>
            <td><?= h($dictionaryCountry->created) ?></td>
            <td><?= $this->Number->format($dictionaryCountry->created_by) ?></td>
            <td><?= h($dictionaryCountry->modified) ?></td>
            <td><?= $this->Number->format($dictionaryCountry->modified_by) ?></td>
            <td class="actions">
                <?= $this->Html->link('<span class="fa fa-eye"></span>', ['action' => 'view', $dictionaryCountry->id], ['escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Html->link('<span class="fa fa-pencil"></span>', ['action' => 'edit', $dictionaryCountry->id], ['escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Form->postLink('<span class="fa fa-remove"></span>', ['action' => 'delete', $dictionaryCountry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dictionaryCountry->id), 'escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator text-right">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
</div>
