<section class="content-header">
    <h1>
        <?php echo __('Activities'); ?>
        <small><?php echo __('All Registered'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Activities'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>

</section>
<section class="content">
    <div class="activities index" style="margin: 20px" >
        <div class="panel panel-default">
            <div class="panel-heading" align="right">
                <section class="content-header">
                    <?php echo $this->Html->link($this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fa fa-refresh fa-fw')), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Refresh'), 'title' => __('Refresh'), 'escape' => false)), $this->Html->url(), array('escape' => false)); ?>
                    <?php echo $this->Html->link($this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fa fa-plus fa-fw')), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Add'), 'title' => __('Add'), 'escape' => false)), $this->Html->url(array('action' => 'teacher_add')), array('escape' => false)); ?>
                </section>
            </div>
            <div class="table-responsive">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid" style="margin: 20px">                 
                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('nm_activity', __('ds_activity'), array('data-toggle' => 'tooltip', 'data-original-title' => __('ds_activity'), 'title' => __('ds_activity'))); ?></th>
                                <th><?php echo $this->Paginator->sort('vl_activity_sucess', __('vl_activity_sucess'), array('data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_sucess'), 'title' => __('vl_activity_sucess'))); ?></th>
                                <th><?php echo $this->Paginator->sort('vl_activity_attempt', __('vl_activity_attempt'), array('data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_attempt'), 'title' => __('vl_activity_attempt'))); ?></th>
                                <th><?php echo $this->Paginator->sort('vl_activity_failed', __('vl_activity_failed'), array('data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_failed'), 'title' => __('vl_activity_failed'))); ?></th>
                                <th><?php echo __('Reward'); ?></th>
                                <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $base_url = array('controller' => 'Activities', 'action' => 'index'); ?>
                                <?php echo $this->Form->create("Filter", array('url' => $base_url, 'class' => 'filter')); ?>
                                <td><?php echo $this->Html->div('row', $this->Form->input('nm_activity', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('ds_activity'), 'title' => __('ds_activity'), 'class' => 'form-control input-sm')), array('escape' => false)); ?></td>
                                <td><?php echo $this->Html->div('row', $this->Form->input('vl_activity_sucess', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_sucess'), 'title' => __('vl_activity_sucess'), 'class' => 'form-control input-sm')), array('escape' => false)); ?></td>
                                <td><?php echo $this->Html->div('row', $this->Form->input('vl_activity_attempt', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_attempt'), 'title' => __('vl_activity_attempt'), 'class' => 'form-control input-sm')), array('escape' => false)); ?></td>
                                <td><?php echo $this->Html->div('row', $this->Form->input('vl_activity_failed', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_failed'), 'title' => __('vl_activity_failed'), 'class' => 'form-control input-sm')), array('escape' => false)); ?></td>
                                <td></td>
                                <td><?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Search'), 'title' => __('Search'))) ?></td>
                                <?php echo $this->Form->end(); ?>
                            </tr>
                            <?php foreach ($activities as $activity): ?>
                            <tr>
                                    <td><?php echo h($activity['Activity']['nm_activity']); ?>&nbsp;</td>
                                    <td><?php echo h($activity['Activity']['vl_activity_sucess']); ?>&nbsp;</td>
                                    <td><?php echo h($activity['Activity']['vl_activity_attempt']); ?>&nbsp;</td>
                                    <td><?php echo h($activity['Activity']['vl_activity_failed']); ?>&nbsp;</td>
                                    <td>
                                        <i class="fa <?php echo $activity['Reward']['nm_icon'];  ?>"></i>
                                    </td>
                                    <td class="actions"  title='Actions' data-original-title='Actions' data-toggle="tooltip">
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                                                    <i class="fa fa-gear fa-fw"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li><?php echo $this->Html->link($this->Html->tag('i', __(' View'), array('class' => 'fa fa-eye fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'view', $activity['Activity']['id'])), array('escape' => false)); ?></li>
                                                    <li><?php echo $this->Html->link($this->Html->tag('i', __(' Edit'), array('class' => 'fa fa-edit fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'teacher_edit', $activity['Activity']['id'])), array('escape' => false)); ?></li>
                                                    <li><?php echo $this->Form->postLink($this->Html->tag('i', __(' Delete'), array('class' => 'fa fa-trash-o fa-fw')), array('action' => 'delete', $activity['Activity']['id']), array('escape' => false), __('Are you sure you want to delete the %s?', $activity['Activity']['id']), array('class' => 'btn btn-mini')); ?> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                    ));
                    ?>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?php
                            echo $this->Paginator->prev('<<', array('tag' => 'li', 'class' => 'prev',), $this->Paginator->link('<<', array()), array('tag' => 'li', 'escape' => false, 'class' => 'prev disabled',));
                            echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a'));
                            echo $this->Paginator->next('>>', array('tag' => 'li', 'class' => 'next',), $this->Paginator->link('>>', array()), array('tag' => 'li', 'escape' => false, 'class' => 'next disabled',));
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>