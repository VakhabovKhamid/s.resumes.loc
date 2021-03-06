<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryIndustry $dictionaryIndustry
 */
?>
<h2><?= __('Add Dictionary Industry') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Dictionary Industries'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create($dictionaryIndustry) ?>
                                    <div class="form-group">
                            <?= $this->Form->control('name_uz_c', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name_uz_l', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name_ru_c', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name_en_l', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name_qr_c', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name_qr_l', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('is_active', ['class' => 'form-control']);?>
                        </div>

            <div class="text-right">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>
