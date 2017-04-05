<section class="content-header">
    <h1>
        <?php echo __('Matriculations'); ?>
        <small><?php echo __('View').' '.__('Matriculation'); ?></small>
    </h1>
    <?php  $this->Html->addCrumb(__(' Home'), '/',['i','class'=>'fa fa-dashboard']);
            $this->Html->addCrumb(__('Matriculations'),'/Matriculations');
              $this->Html->addCrumb(__('View Matriculation'));
            echo $this->Html->getCrumbList(['class'=>'breadcrumb','lastClass'=>'active']);?>
</section>
<section class="content">
<div class="panel panel-default" style="margin: 20px">
    <div class="panel-heading" align="right">
        <section class="content-header">
        	<a title='<?=__('Back')?>' data-original-title='<?=__('Back')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'index')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
        	<a title='<?=__('Refresh')?>' data-original-title='<?=__('Refresh')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
        	<a title='<?=__('Edit')?>' data-original-title='<?=__('Edit')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'edit', $matriculation['Matriculation']['id'])); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-edit fa-fw"></i></button></a>
        	<?php echo $this->Form->postLink('<button title='.__('Delete').' data-original-title='.__('Delete').' data-toggle="tooltip" class="btn btn-primary"><i class="fa fa-trash-o fa-fw"></i></button>',
                                                array('action' => 'delete',  $matriculation['Matriculation']['id']),
                                                array('escape'=>false),
                                                __('Are you sure you want to delete # %s?',  $matriculation['Matriculation']['id'])
                                            );?>
        </section>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a data-toggle="tab" href="#tab_1-1" aria-expanded="false"><?=__("Matriculation")?></a></li>
                          <li class=""><a data-toggle="tab" href="#tab_2-2" aria-expanded="true"><?=__("Points")?></a></li>
                                <li class=""><a data-toggle="tab" href="#tab_3-3" aria-expanded="true"><?=__("Activities")?></a></li>
                                <li class=""><a data-toggle="tab" href="#tab_4-4" aria-expanded="true"><?=__("Rewards")?></a></li>
                                <li class=""><a data-toggle="tab" href="#tab_5-5" aria-expanded="true"><?=__("Teams")?></a></li>
                          <li class="pull-left header"><i class="ion ion-clipboard"></i><?=__("Data")?></li>
        </ul>
        <div class="tab-content">
          <div id="tab_1-1" class="tab-pane active">
                <div style="margin: 20px">
		<?php if($matriculation['Matriculation']['student_id']){?>
		<dt><?php echo __('Student'); ?></dt>
		<dd><?php echo $this->Html->link($matriculation['Student']['id'], array('controller' => 'students', 'action' => 'view', $matriculation['Student']['id'])); ?></dd>
		<?php }?>
		<?php if($matriculation['Matriculation']['room_id']){?>
		<dt><?php echo __('Room'); ?></dt>
		<dd><?php echo $this->Html->link($matriculation['Room']['id'], array('controller' => 'rooms', 'action' => 'view', $matriculation['Room']['id'])); ?></dd>
		<?php }?>
                </div>
            </div>
                        <div id="tab_2-2" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($matriculation['Point'])){ ?>
                       <h3><?php echo __('Related Points'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'points', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('vl_point'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($matriculation['Point'] as $point): ?>
									<tr>
										<td><?php echo $point['vl_point']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'points','action' => 'view', $point['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'points','action' => 'edit', $point['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'points','action' => 'delete', $point['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $point['id']),array('class' => 'btn btn-mini'));?> </li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
<?php }else{ ?>

<?php } ?>

                    </div>
                </div>
            <div id="tab_3-3" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($matriculation['Activity'])){ ?>
                       <h3><?php echo __('Related Activities'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'activities', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('ds_activity'); ?></th>
                                                        <th><?php echo __('vl_activity'); ?></th>
                                                        <th><?php echo __('room_id'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($matriculation['Activity'] as $activity): ?>
									<tr>
										<td><?php echo $activity['ds_activity']; ?>&nbsp;</td>
										<td><?php echo $activity['vl_activity']; ?>&nbsp;</td>
										<td><?php echo $activity['room_id']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'activities','action' => 'view', $activity['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'activities','action' => 'edit', $activity['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'activities','action' => 'delete', $activity['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $activity['id']),array('class' => 'btn btn-mini'));?> </li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
<?php }else{ ?>

<?php } ?>

                    </div>
                </div>
            <div id="tab_4-4" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($matriculation['Reward'])){ ?>
                       <h3><?php echo __('Related Rewards'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'rewards', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('ds_brinde'); ?></th>
                                                        <th><?php echo __('vl_pontos_brinde'); ?></th>
                                                        <th><?php echo __('room_id'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($matriculation['Reward'] as $reward): ?>
									<tr>
										<td><?php echo $reward['ds_brinde']; ?>&nbsp;</td>
										<td><?php echo $reward['vl_pontos_brinde']; ?>&nbsp;</td>
										<td><?php echo $reward['room_id']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'rewards','action' => 'view', $reward['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'rewards','action' => 'edit', $reward['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'rewards','action' => 'delete', $reward['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $reward['id']),array('class' => 'btn btn-mini'));?> </li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
<?php }else{ ?>

<?php } ?>

                    </div>
                </div>
            <div id="tab_5-5" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($matriculation['Team'])){ ?>
                       <h3><?php echo __('Related Teams'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'teams', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('nm_team'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($matriculation['Team'] as $team): ?>
									<tr>
										<td><?php echo $team['nm_team']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'teams','action' => 'view', $team['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'teams','action' => 'edit', $team['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'teams','action' => 'delete', $team['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $team['id']),array('class' => 'btn btn-mini'));?> </li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
<?php }else{ ?>

<?php } ?>

                    </div>
                </div>
            </div>
        </div>
     </div>|

<script>
    $.extend( $.fn.dataTable.defaults, {
        "searching": false
    } );
    
    $('#dataTables-example').DataTable();
</script>