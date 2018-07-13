<?php
    //var_dump($groups, $users, $allAcos);
  foreach ($allAcos as $key => $value) {
    $arrKey = explode('.', $key);
    array_pop($arrKey);
    $newKey = false;
    if ($arrKey) {
      $newKey = implode('.', $arrKey);
    }
    $allAcos[$key]['type'] = 'child';
    if (isset($allAcos[$newKey])) {
      $allAcos[$newKey]['type'] = 'parent';
    }
  }
?>
<style>
.col-primary {
  width: 200px !important;
  text-align: left !important;
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
    <button type="button" class="btn btn-default" onClick="$('.collapse').collapse('show');">Показать все</button>
    <button type="button" class="btn btn-default" onClick="$('.collapse').collapse('hide');">Закрыть все</button>
  </div>
</div>
<br>
<form action="/admin/acl/setgrouppermissions" method="POST">
  <table id="master-table" class="table table-bordered table-striped table-condensed">
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
    <?php foreach ($allAcos as $acoCode => $aco):
        $classMenuGroup = str_replace(".", "", $acoCode);
      ?>
      <?php if ($aco['type'] == 'parent'): ?>
        <tr class="col-group group-<?=$classMenuGroup?> collapsed">
          <td id="<?=$acoCode?>" class="col-primary">
            <a data-toggle="collapse" data-parent="tbody" href=".<?=$classMenuGroup?>">
              <?=h($acoCode); ?>
            </a>
          </td>
          <?php foreach ($groups as $groupId => $group): ?>
          <td>
            <div class="row" style="text-align: center; font-weight: normal; font-size: 11px;">
              <div class="col-md-6">Доступ</div>
              <div class="col-md-6">Логирование</div>
            </div>
          </td>
          <?php endforeach; ?>
        </tr>
      <?php else: ?>
        <?php 
          $split = explode('.', $acoCode);
          $action = end($split);
          array_pop($split);
          $classMenuGroup = implode('',$split);
        ?>
        <tr class="<?=$classMenuGroup?> collapsed collapse">
          <td id="<?=$acoCode?>" class="col-primary">
            <a target="_blank" href="/<?=str_replace('.', '/', $acoCode)?>">
            <?=h($action); ?>
            </a>  
          </td>
          <?php foreach ($groups as $groupId => $group): ?>
          <?php $access = isset($group['Permissions'][$acoCode]); ?>
          <td>
            <div class="row" style="text-align: center;">
              <div class="col-md-6">
                <input <?=($access)?"checked":""?> type="checkbox" data-toggle="toggle" name="<?="data[Access][$groupId][$acoCode]"?>"/>
              </div>
              <div class="col-md-6">
                <input type="checkbox" data-toggle="toggle" disabled="disabled" />
              </div>
            </div>
          </td>
          <?php endforeach; ?>
        </tr>
      <?php endif ?>
    <?php endforeach; ?>
    </tbody>
  </table>
  <div class="text-right">
    <input class="btn btn-success" type="submit" value="<?=__('Accept')?>" />
  </div>
</form>
</div>
