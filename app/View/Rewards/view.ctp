<section class="content-header">
    <h1>
        <?php echo __('Rewards'); ?>
        <small><?php echo __('View').' '.__('Reward'); ?></small>
    </h1>
    <?php  $this->Html->addCrumb(__(' Home'), '/',['i','class'=>'fa fa-dashboard']);
            $this->Html->addCrumb(__('Rewards'),'/Rewards');
              $this->Html->addCrumb(__('View Reward'));
            echo $this->Html->getCrumbList(['class'=>'breadcrumb','lastClass'=>'active']);?>
</section>
<div class="panel panel-default" style="margin: 20px">
    <div class="panel-heading" align="right">
        <section class="content-header">
        	<a title='<?=__('Back')?>' data-original-title='<?=__('Back')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'index')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
        	<a title='<?=__('Refresh')?>' data-original-title='<?=__('Refresh')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
        	<a title='<?=__('Edit')?>' data-original-title='<?=__('Edit')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'edit', $reward['Reward']['id'])); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-edit fa-fw"></i></button></a>
        	<?php echo $this->Form->postLink('<button title='.__('Delete').' data-original-title='.__('Delete').' data-toggle="tooltip" class="btn btn-primary"><i class="fa fa-trash-o fa-fw"></i></button>',
                                                array('action' => 'delete',  $reward['Reward']['id']),
                                                array('escape'=>false),
                                                __('Are you sure you want to delete # %s?',  $reward['Reward']['id'])
                                            );?>
        </section>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a data-toggle="tab" href="#tab_1-1" aria-expanded="false"><?=__("Reward")?></a></li>
                          <li class=""><a data-toggle="tab" href="#tab_2-2" aria-expanded="true"><?=__("Matriculations")?></a></li>
                          <li class="pull-left header"><i class="ion ion-clipboard"></i><?=__("Data")?></li>
        </ul>
        <div class="tab-content">
          <div id="tab_1-1" class="tab-pane active">
                <div style="margin: 20px">
		<?php if($reward['Reward']['ds_brinde']){?>
		<dt><?php echo __('Ds Brinde'); ?></dt>
		<dd><?php echo h($reward['Reward']['ds_brinde']); ?></dd>
		<?php }?>
		<?php if($reward['Reward']['vl_pontos_brinde']){?>
		<dt><?php echo __('Vl Pontos Brinde'); ?></dt>
		<dd><?php echo h($reward['Reward']['vl_pontos_brinde']); ?></dd>
		<?php }?>
		<?php if($reward['Reward']['room_id']){?>
		<dt><?php echo __('Room'); ?></dt>
		<dd><?php echo $this->Html->link($reward['Room']['id'], array('controller' => 'rooms', 'action' => 'view', $reward['Room']['id'])); ?></dd>
		<?php }?>
                </div>
            </div>
                        <div id="tab_2-2" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($reward['Matriculation'])){ ?>
                       <h3><?php echo __('Related Matriculations'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'matriculations', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('student_id'); ?></th>
                                                        <th><?php echo __('room_id'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($reward['Matriculation'] as $matriculation): ?>
									<tr>
										<td><?php echo $matriculation['student_id']; ?>&nbsp;</td>
										<td><?php echo $matriculation['room_id']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'matriculations','action' => 'view', $matriculation['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'matriculations','action' => 'edit', $matriculation['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'matriculations','action' => 'delete', $matriculation['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $matriculation['id']),array('class' => 'btn btn-mini'));?> </li>
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