<?php
    //var_dump($groups, $users, $allAcos);
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
          preg_match('/(([A-Za-z]+)\.?([A-Z]{1}[a-z]+)?)/', $acoCode, $matches);
          $menuGroup = $matches[0];
          $classMenuGroup = str_replace(".", "", $menuGroup);
      ?>
    <tr class="<?=($acoCode != $menuGroup) ? "$classMenuGroup collapsed collapse" : "col-group group-$classMenuGroup collapsed";?>">
    <td id="<?=$acoCode?>" class="col-primary">
        <? if ($acoCode == $menuGroup): ?>
          <a data-toggle="collapse" data-parent="tbody" href=".<?=$classMenuGroup?>">
          <?=h($aco['title']); ?>
          </a>
        <? else: ?>
          <a target="_blank" href="/<?=str_replace('.', '/', $acoCode)?>">
          <?="&nbsp;&nbsp;&nbsp;".h($aco['title']); ?>
          </a>        
        <? endif; ?>
        </td>
        <?php foreach ($groups as $groupId => $group): ?>
        <td>
        <?php if ($acoCode != $menuGroup):
                $access = isset($group['Permissions'][$acoCode]);
        ?>
          <div class="row" style="text-align: center;">
            <div class="col-md-6">
              <input <?=($access)?"checked":""?> type="checkbox" data-toggle="toggle" name="<?="data[Access][$groupId][$acoCode]"?>"/>
            </div>
            <div class="col-md-6">
              <input type="checkbox" data-toggle="toggle" disabled="disabled" />
            </div>
          </div>
        <? else: ?>
          <div class="row" style="text-align: center; font-weight: normal; font-size: 11px;">
            <div class="col-md-6">Доступ</div>
            <div class="col-md-6">Логирование</div>
          </div>
        <? endif; ?>
        </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <div class="text-right">
    <input class="btn btn-success" type="submit" value="<?=__('Accept')?>" />
  </div>
</form>
</div>
