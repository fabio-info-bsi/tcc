<section class="content-header">
    <h1>
        <?php echo __('Matriculations Rewards'); ?>
        <small><?php echo __('View').' '.__('Matriculations Reward'); ?></small>
    </h1>
    <?php  $this->Html->addCrumb(__(' Home'), '/',['i','class'=>'fa fa-dashboard']);
            $this->Html->addCrumb(__('Matriculations Rewards'),'/Matriculations Rewards');
              $this->Html->addCrumb(__('View Matriculations Reward'));
            echo $this->Html->getCrumbList(['class'=>'breadcrumb','lastClass'=>'active']);?>
</section>
<div class="panel panel-default" style="margin: 20px">
    <div class="panel-heading" align="right">
        <section class="content-header">
        	<a title='<?=__('Back')?>' data-original-title='<?=__('Back')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'index')); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
        	<a title='<?=__('Refresh')?>' data-original-title='<?=__('Refresh')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
        	<a title='<?=__('Edit')?>' data-original-title='<?=__('Edit')?>' data-toggle='tooltip' href="<?php echo $this->Html->url(array('action' => 'edit', $matriculationsReward['MatriculationsReward']['id'])); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-edit fa-fw"></i></button></a>
        	<?php echo $this->Form->postLink('<button title='.__('Delete').' data-original-title='.__('Delete').' data-toggle="tooltip" class="btn btn-primary"><i class="fa fa-trash-o fa-fw"></i></button>',
                                                array('action' => 'delete',  $matriculationsReward['MatriculationsReward']['id']),
                                                array('escape'=>false),
                                                __('Are you sure you want to delete # %s?',  $matriculationsReward['MatriculationsReward']['id'])
                                            );?>
        </section>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a data-toggle="tab" href="#tab_1-1" aria-expanded="false"><?=__("Matriculations Reward")?></a></li>
                    <li class="pull-left header"><i class="ion ion-clipboard"></i><?=__("Data")?></li>
        </ul>
        <div class="tab-content">
          <div id="tab_1-1" class="tab-pane active">
                <div style="margin: 20px">
		<?php if($matriculationsReward['MatriculationsReward']['matriculation_id']){?>
		<dt><?php echo __('Matriculation'); ?></dt>
		<dd><?php echo $this->Html->link($matriculationsReward['Matriculation']['id'], array('controller' => 'matriculations', 'action' => 'view', $matriculationsReward['Matriculation']['id'])); ?></dd>
		<?php }?>
		<?php if($matriculationsReward['MatriculationsReward']['reward_id']){?>
		<dt><?php echo __('Reward'); ?></dt>
		<dd><?php echo $this->Html->link($matriculationsReward['Reward']['id'], array('controller' => 'rewards', 'action' => 'view', $matriculationsReward['Reward']['id'])); ?></dd>
		<?php }?>
		<?php if($matriculationsReward['MatriculationsReward']['activity_id']){?>
		<dt><?php echo __('Activity'); ?></dt>
		<dd><?php echo $this->Html->link($matriculationsReward['Activity']['id'], array('controller' => 'activities', 'action' => 'view', $matriculationsReward['Activity']['id'])); ?></dd>
		<?php }?>
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