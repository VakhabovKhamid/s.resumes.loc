<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryDistrict $dictionaryDistrict
 */
?>
<h2><?= __('Add Dictionary District') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Dictionary Districts'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create($dictionaryDistrict) ?>
                                    <div class="form-group">
                            <?= $this->Form->control('region_id', ['options' => $dictionaryRegions, 'class' => 'form-control']);?>
                        </div>
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
