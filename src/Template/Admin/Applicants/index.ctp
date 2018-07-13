<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[]|\Cake\Collection\CollectionInterface $applicants
 */
?>
<h2><?= __('Applicants') ?></h2>
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
                        <th scope="col"><?= $this->Paginator->sort('latin_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('latin_surname') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('latin_patronym') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('sex') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('birth_date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address_country_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address_region_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address_district_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address_extended') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('education_level_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('industry_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('professional_skills') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('is_archive') ?></th>
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
                <input type="text" name="latin_name">
            </th>
                        <th>
                <input type="text" name="latin_surname">
            </th>
                        <th>
                <input type="text" name="latin_patronym">
            </th>
                        <th>
                <input type="text" name="sex">
            </th>
                        <th>
                <input type="text" name="birth_date">
            </th>
                        <th>
                <input type="text" name="address_country_id">
            </th>
                        <th>
                <input type="text" name="address_region_id">
            </th>
                        <th>
                <input type="text" name="address_district_id">
            </th>
                        <th>
                <input type="text" name="address_extended">
            </th>
                        <th>
                <input type="text" name="education_level_id">
            </th>
                        <th>
                <input type="text" name="industry_id">
            </th>
                        <th>
                <input type="text" name="professional_skills">
            </th>
                        <th>
                <input type="text" name="is_archive">
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
        <?php foreach ($applicants as $applicant): ?>
        <tr>
            <td><?= $this->Number->format($applicant->id) ?></td>
            <td><?= h($applicant->latin_name) ?></td>
            <td><?= h($applicant->latin_surname) ?></td>
            <td><?= h($applicant->latin_patronym) ?></td>
            <td><?= h($applicant->sex) ?></td>
            <td><?= h($applicant->birth_date) ?></td>
            <td><?= $applicant->has('dictionary_country') ? $this->Html->link($applicant->dictionary_country->id, ['controller' => 'DictionaryCountries', 'action' => 'view', $applicant->dictionary_country->id]) : '' ?></td>
            <td><?= $applicant->has('dictionary_region') ? $this->Html->link($applicant->dictionary_region->id, ['controller' => 'DictionaryRegions', 'action' => 'view', $applicant->dictionary_region->id]) : '' ?></td>
            <td><?= $applicant->has('dictionary_district') ? $this->Html->link($applicant->dictionary_district->id, ['controller' => 'DictionaryDistricts', 'action' => 'view', $applicant->dictionary_district->id]) : '' ?></td>
            <td><?= h($applicant->address_extended) ?></td>
            <td><?= $applicant->has('dictionary_education_level') ? $this->Html->link($applicant->dictionary_education_level->id, ['controller' => 'DictionaryEducationLevels', 'action' => 'view', $applicant->dictionary_education_level->id]) : '' ?></td>
            <td><?= $applicant->has('dictionary_industry') ? $this->Html->link($applicant->dictionary_industry->id, ['controller' => 'DictionaryIndustries', 'action' => 'view', $applicant->dictionary_industry->id]) : '' ?></td>
            <td><?= implode(', ', $applicant->professional_skills) ?></td>
            <td><?= h($applicant->is_archive) ?></td>
            <td><?= h($applicant->created) ?></td>
            <td><?= $this->Number->format($applicant->created_by) ?></td>
            <td><?= h($applicant->modified) ?></td>
            <td><?= $this->Number->format($applicant->modified_by) ?></td>
            <td class="actions">
                <?= $this->Html->link('<span class="fa fa-eye"></span>', ['action' => 'view', $applicant->id], ['escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Html->link('<span class="fa fa-pencil"></span>', ['action' => 'edit', $applicant->id], ['escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Form->postLink('<span class="fa fa-remove"></span>', ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id), 'escape' => false, 'class' => 'btn btn-default btn-sm']) ?>
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
