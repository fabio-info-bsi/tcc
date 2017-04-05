<section class="content-header">
    <h1>
        <?php echo __('Users'); ?>
        <small><?php echo __('View').' '.__('User'); ?></small>
    </h1>
    <?php  $this->Html->addCrumb(__(' Home'), '/',['i','class'=>'fa fa-dashboard']);
            $this->Html->addCrumb(__('Users'),'/Users');
              $this->Html->addCrumb(__('View User'));
            echo $this->Html->getCrumbList(['class'=>'breadcrumb','lastClass'=>'active']);?>
</section>
<div class="panel panel-default" style="margin: 20px">
    <div class="panel-heading" align="right">
        <section class="content-header">
        	<a title='<?=__('Back')?>' data-original-title='<?=__('Back')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'index')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
        	<a title='<?=__('Refresh')?>' data-original-title='<?=__('Refresh')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
        	<a title='<?=__('Edit')?>' data-original-title='<?=__('Edit')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-edit fa-fw"></i></button></a>
        	<?php echo $this->Form->postLink('<button title='.__('Delete').' data-original-title='.__('Delete').' data-toggle="tooltip" class="btn btn-primary"><i class="fa fa-trash-o fa-fw"></i></button>',
                                                array('action' => 'delete',  $user['User']['id']),
                                                array('escape'=>false),
                                                __('Are you sure you want to delete # %s?',  $user['User']['id'])
                                            );?>
        </section>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a data-toggle="tab" href="#tab_1-1" aria-expanded="false"><?=__("User")?></a></li>
                          <li class=""><a data-toggle="tab" href="#tab_2-2" aria-expanded="true"><?=__("Logs")?></a></li>
                                <li class=""><a data-toggle="tab" href="#tab_3-3" aria-expanded="true"><?=__("Students")?></a></li>
                                <li class=""><a data-toggle="tab" href="#tab_4-4" aria-expanded="true"><?=__("Teachers")?></a></li>
                          <li class="pull-left header"><i class="ion ion-clipboard"></i><?=__("Data")?></li>
        </ul>
        <div class="tab-content">
          <div id="tab_1-1" class="tab-pane active">
                <div style="margin: 20px">
		<?php if($user['User']['username']){?>
		<dt><?php echo __('Username'); ?></dt>
		<dd><?php echo h($user['User']['username']); ?></dd>
		<?php }?>
		<?php if($user['User']['password']){?>
		<dt><?php echo __('Password'); ?></dt>
		<dd><?php echo h($user['User']['password']); ?></dd>
		<?php }?>
		<?php if($user['User']['group_id']){?>
		<dt><?php echo __('Group'); ?></dt>
		<dd><?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?></dd>
		<?php }?>
		<?php if($user['User']['created']){?>
		<dt><?php echo __('Created'); ?></dt>
		<dd><?php echo h($user['User']['created']); ?></dd>
		<?php }?>
		<?php if($user['User']['modified']){?>
		<dt><?php echo __('Modified'); ?></dt>
		<dd><?php echo h($user['User']['modified']); ?></dd>
		<?php }?>
		<?php if($user['User']['status']){?>
		<dt><?php echo __('Status'); ?></dt>
		<dd><?php echo h($user['User']['status']); ?></dd>
		<?php }?>
		<?php if($user['User']['name']){?>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($user['User']['name']); ?></dd>
		<?php }?>
		<?php if($user['User']['email']){?>
		<dt><?php echo __('Email'); ?></dt>
		<dd><?php echo h($user['User']['email']); ?></dd>
		<?php }?>
                </div>
            </div>
                        <div id="tab_2-2" class="tab-pane">
                <div class="related">
                    
                    
                    <?php if (!empty($user['Log'])){ ?>
                       <h3><?php echo __('Related Logs'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'logs', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th><?php echo __('model'); ?></th>
                                                        <th><?php echo __('action'); ?></th>
                                                        <th><?php echo __('old_data'); ?></th>
                                                        <th><?php echo __('new_data'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($user['Log'] as $log): ?>
									<tr>
										<td><?php echo $log['model']; ?>&nbsp;</td>
										<td><?php echo $log['action']; ?>&nbsp;</td>
										<td><?php echo $log['old_data']; ?>&nbsp;</td>
										<td><?php echo $log['new_data']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'logs','action' => 'view', $log['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'logs','action' => 'edit', $log['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'logs','action' => 'delete', $log['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $log['id']),array('class' => 'btn btn-mini'));?> </li>
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
                    
                    
                    <?php if (!empty($user['Student'])){ ?>
                       <h3><?php echo __('Related Students'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'students', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th class="actions col-xs-1"><?php echo __('active'); ?></th>
                                                        <th><?php echo __('nm_student'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($user['Student'] as $student): ?>
									<tr>
										<td><?php if($student['active'] == 'S'){
                                                                  echo '<span  class="btn-sm bg-green pull-right">'.__('Active').'</span>';
                                                               }else{
                                                                  echo '<span  class="btn-sm bg-red pull-right">'.__('Inactive').'</span>';
                                                               } ?></td>
										<td><?php echo $student['nm_student']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'students','action' => 'view', $student['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'students','action' => 'edit', $student['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'students','action' => 'delete', $student['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $student['id']),array('class' => 'btn btn-mini'));?> </li>
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
                    
                    
                    <?php if (!empty($user['Teacher'])){ ?>
                       <h3><?php echo __('Related Teachers'); ?></h3>
                       <div class="panel panel-default">
                            <div class="panel-heading" align="right">
                                <a data-toggle='tooltip' data-original-title='<?=__('Add')?>' title'=<?=__('Add')?>' href="<?php echo $this->Html->url(array('controller' => 'teachers', 'action' => 'add')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw" ></i></button></a>                            </div>
                            <div style="margin: 20px">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline table-responsive" role="grid">                 
                                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                           
                                                    <th class="actions col-xs-1"><?php echo __('active'); ?></th>
                                                        <th><?php echo __('nm_teacher'); ?></th>
                                                        <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach ($user['Teacher'] as $teacher): ?>
									<tr>
										<td><?php if($teacher['active'] == 'S'){
                                                                  echo '<span  class="btn-sm bg-green pull-right">'.__('Active').'</span>';
                                                               }else{
                                                                  echo '<span  class="btn-sm bg-red pull-right">'.__('Inactive').'</span>';
                                                               } ?></td>
										<td><?php echo $teacher['nm_teacher']; ?>&nbsp;</td>
										<td class="actions">
											<div class="pull-right">
												<div data-toggle='tooltip' data-original-title='<?=__('Actions')?>' title'=<?=__('Add')?>' class="btn-group">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
														<i class="fa fa-gear fa-fw"></i>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu pull-right" role="menu">
														<li><a href="<?php echo $this->Html->url(array('controller' => 'teachers','action' => 'view', $teacher['id'])); ?>"><i class="fa fa-eye fa-fw"></i> View</a></li>
														<li><a href="<?php echo $this->Html->url(array('controller' => 'teachers','action' => 'edit', $teacher['id'])); ?>"><i class="fa fa-edit fa-fw"></i> Edit</a></li>
														<li><?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o fa-fw')). " Delete", array('controller' => 'teachers','action' => 'delete', $teacher['id']),array('escape'=>false),__('Are you sure you want to delete the %s?', $teacher['id']),array('class' => 'btn btn-mini'));?> </li>
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