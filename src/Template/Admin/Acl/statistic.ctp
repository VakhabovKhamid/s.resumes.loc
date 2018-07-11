<?php
/*
Tips:
	col-primary, col-text, col-number, col-datetime, col-date, col-time
*/
	$displayRowCnt = $this->Flash->displayRowCount();

	if (isset($filter)) {
		$this->Paginator->options(array('url'=> array('filter' => $filter), 'convertKeys' => array('page')));
	}
?>
<div class="accesslogs index">
  <div class="container data-grid row">
    <div class="row search-box">
      <div class="col-md-4">
	  <?php
		echo $this->Paginator->counter(
			'Page: <b>{:page}</b> / <b>{:pages}</b>, total records: <b>{:count}</b>'
		);
	  ?>
      </div>
      <div class="col-md-4" style="text-align: center;"></div>
      <div class="col-md-4">
        <div class="btn-group group-control">
          <button class="btn btn-default btn-sm btn-refresh" type="button">
            <span class="glyphicon glyphicon-refresh"></span>
          </button>
          <button class="btn btn-default btn-sm btn-search" type="button">
            <span class="glyphicon glyphicon-filter"></span>
          </button>
        </div>
      </div>
    </div>
    <table id="master-table" class="table table-bordered table-hover table-striped table-condensed">
      <thead>
        <tr>
		  <th class="col-sorting col-primary">
			<?=$this->flash->prettyOrder(__('id'),'AccessLog.id'); ?>
		  </th>
		  <th class="col-sorting col-text">
			<?=$this->flash->prettyOrder(__('aco_alias'),'AccessLog.aco_alias'); ?>
		  </th>
		  <th class="col-sorting col-text">
			<?=$this->flash->prettyOrder(__('url'),'AccessLog.url'); ?>
		  </th>
		  <?/*
		  <th class="col-sorting">
			<?=$this->flash->prettyOrder(__('request_parameters'),'AccessLog.request_parameters'); ?>
		  </th>
		  */?>
		  <th class="col-sorting col-number">
			<?=$this->flash->prettyOrder(__('ip'),'AccessLog.ip'); ?>
		  </th>
		  <th class="col-sorting col-datetime">
			<?=$this->flash->prettyOrder(__('created'),'AccessLog.created'); ?>
		  </th>
		  <th class="col-sorting col-text">
			<?=$this->flash->prettyOrder(__('UserCreated'),'UserCreated.username'); ?>
		  </th>
          <th class="col-actions"></th>
        </tr>
		<?php echo $this->Flash->prettySearchRow(
			array(
				'AccessLog.id', 'AccessLog.aco_alias', 'AccessLog.url', 'AccessLog.ip', 'AccessLog.created', 'UserCreated.username',
			),
			$filter,
            true
		);?>
      </thead>
      <tbody>
		<?php foreach ($accessLogs as $accessLog): ?>
		  <tr>
			<td class="col-primary"><?php echo h($accessLog['AccessLog']['id']); ?>&nbsp;</td>
			<td><?php echo h($accessLog['AccessLog']['aco_alias']); ?>&nbsp;</td>
            <td><?php echo h($accessLog['AccessLog']['url']); ?>&nbsp;</td>
			<?/*<td><?php echo h($accessLog['AccessLog']['request_parameters']); ?>&nbsp;</td>*/?>
            <td><?php echo h($accessLog['AccessLog']['ip']); ?>&nbsp;</td>
			<td><?php echo h($accessLog['AccessLog']['created']); ?>&nbsp;</td>
			<td>
			  <?php echo $this->Html->link($accessLog['UserCreated']['username'], array('controller' => 'users', 'action' => 'view', $accessLog['UserCreated']['id'])); ?>
			</td>
            <td class="col-actions"></td>
		  </tr>
		<?php endforeach; ?>
		<?php for ($index = 0; $index < $displayRowCnt - sizeof($accessLogs); $index++): ?>
		  <tr class="row-empty">
			<td></td>
			<td></td>
			<td></td>
			<?/*<td></td>*/?>
			<td></td>
			<td></td>
			<td></td>
            <td class="col-actions"></td>
		  </tr>
		<?php endfor; ?>
      </tbody>
    </table>
    <div class="row navigation-box">
      <div class="col-md-3"></div>
      <div class="col-md-6" style="text-align: center;">
        <ul class="pagination first">
		<?php
			echo $this->Paginator->first('«');
			echo $this->Paginator->prev('‹', array(), null, array('class' => 'prev disabled'));
		?>
        </ul>
        <ul class="pagination numbers">
		<?php
			$numbers = $this->Paginator->numbers(array(
				'separator' => '',
				'tag' => 'li',
				'currentTag' => 'a',
				'currentClass' => 'active'
			));
			echo ($numbers != "") ? $numbers : '<li class="active"><a>1</a></li>';
		?>
    	</ul>
        <ul class="pagination last">
		<?php
			echo $this->Paginator->next('›', array(), null, array('class' => 'next disabled'));
			echo $this->Paginator->last('»');
		?>
        </ul>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>
