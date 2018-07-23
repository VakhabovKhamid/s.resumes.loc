<?php
    //var_dump($groups, $users, $allAcos);
// dd($groups);
// dd($allAcos);
// dd($allAcosMenu);
// dd($this->Permissions->keyById(260, $allAcos));
?>
<style>
.col-primary {
  width: 208px !important;
  text-align: left !important;
  white-space: nowrap;
}
.col-group {
  font-weight: bold;  
}
</style>
<div>
<h2><?= __('Access rights management') ?></h2>
<hr>
<div class="clearfix">
  <div class="btn-group group-control pull-right">
    <button type="button" class="btn btn-default" id='showCollapse'>Показать все</button>
    <button type="button" class="btn btn-default" id='hideCollapse'>Закрыть все</button>
  </div>
</div>
<br>
<form action="/admin/acl/setgrouppermissions" method="POST">
  <table id="master-table" class="table table-bordered table-striped table-condensed jq-fixed-thead">
    <thead>
      <tr>
      <th class="col-primary"><?=__('Action')?></th>
        <?php foreach ($groups as $groupId => $group): ?>
        <th class="col-text col-vertical rotate">
        <?=(is_array($group)) ? ((isset($group['name'])) ? h($group['name']) : '') : h($group) ?>
        </th>
        <?php endforeach; ?>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($allAcosMenu as $key => $allAco): ?>
        <?php if (is_array($allAco)): ?>
          <tr class="col-group group-<?= $key ?> collapsed">
            <td id='<?= $key ?>' class="col-primary">
              <a class="toggleAccardion" data-parent="tbody" href='.<?= strtolower($key) ?>'><?= $key ?></a>
            </td>
            <?php foreach ($groups as $groupId => $group): ?>
            <td>
              <div class="row" style="text-align: center; font-weight: normal; font-size: 11px;">
                <div class="col-md-6">Доступ</div>
                <!-- <div class="col-md-6">Логирование</div> -->
              </div>
            </td>
            <?php endforeach; ?>
          </tr>
          <?php foreach ($allAco as $keyCh => $item): ?>
            <?php if (is_array($item)): ?>
              <tr class="col-group <?= strtolower($key) ?> collapsed collapse" aria-expanded="false">
                <td id='<?= $keyCh ?>' class="col-primary">
                  <a class="toggleAccardion" data-parent="tbody" href='.<?= strtolower($key).strtolower($keyCh) ?>'>-<?= $keyCh ?></a>
                </td>
                <?php foreach ($groups as $groupId => $group): ?>
                <td>
                  <div class="row" style="text-align: center; font-weight: normal; font-size: 11px;">
                    <div class="col-md-6">Доступ</div>
                    <!-- <div class="col-md-6">Логирование</div> -->
                  </div>
                </td>
                <?php endforeach; ?>
              </tr>
              <?php foreach ($item as $keyAction => $keyActionId): ?>
                <tr class="<?= strtolower($key).strtolower($keyCh) ?> collapsed collapse" aria-expanded="false">
                  <td id='<?= $keyAction ?>' class="col-primary">
                    <a href="/<?= strtolower($key) ?>/<?= strtolower($keyCh) ?>/<?= strtolower($keyAction) ?>" target="_blank">--<?= strtolower($keyAction) ?></a>
                  </td>
                  <?php foreach ($groups as $groupId => $group): ?>
                    <?php $acoCode = $this->Permissions->keyById($keyActionId, $allAcos); ?>
                    <?php $access = isset($group['Permissions'][$acoCode]); ?>
                    <td>
                      <div class="row" style="text-align: center;">
                        <div class="col-md-6">
                          <input <?=($access)?"checked":""?> type="checkbox" data-toggle="toggle" name="<?="data[Access][$groupId][$acoCode]"?>"/>
                        </div>
                        <?php /* ?>
                        <div class="col-md-6">
                          <input type="checkbox" data-toggle="toggle" disabled="disabled" />
                        </div>
                        <?php */ ?>
                      </div>
                    </td>
                  <?php endforeach; ?>
                </tr>  
              <?php endforeach ?>
            <?php else: ?>
              <tr class="<?= strtolower($key) ?> collapsed collapse" aria-expanded="false">
                <td id='<?= $keyCh ?>' class="col-primary">
                  <a href="/<?= strtolower($key) ?>/<?= strtolower($keyCh) ?>" target="_blank">-<?= strtolower($keyCh) ?></a>
                </td>
                <?php foreach ($groups as $groupId => $group): ?>
                  <?php $acoCode = $this->Permissions->keyById($item, $allAcos); ?>
                  <?php $access = isset($group['Permissions'][$acoCode]); ?>
                  <td>
                    <div class="row" style="text-align: center;">
                      <div class="col-md-6">
                        <input <?=($access)?"checked":""?> type="checkbox" data-toggle="toggle" name="<?="data[Access][$groupId][$acoCode]"?>"/>
                      </div>
                      <?php /* ?>
                      <div class="col-md-6">
                        <input type="checkbox" data-toggle="toggle" disabled="disabled" />
                      </div>
                      <?php */ ?>
                    </div>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endif; ?>
          <?php endforeach ?>
        <?php endif ?>
      <?php endforeach ?>  
    </tbody>
  </table>
  <div class="text-right">
    <input class="btn btn-success" type="submit" value="<?=__('Accept')?>" />
  </div>
</form>
</div>
