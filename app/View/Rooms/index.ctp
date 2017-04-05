<section class="content-header">
    <h1>
        <?php echo __('Rooms'); ?>
        <small><?php echo __('All Registered'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Rooms'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>

</section>
<div class="rooms index" style="margin: 20px" >
    <div class="panel panel-default">
        <div class="panel-heading" align="right">
            <section class="content-header">
                <?php echo $this->Html->link($this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fa fa-refresh fa-fw')), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Refresh'), 'title' => __('Refresh'), 'escape' => false)), $this->Html->url(), array('escape' => false)); ?>
                <?php echo $this->Html->link($this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fa fa-plus fa-fw')), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Add'), 'title' => __('Add'), 'escape' => false)), $this->Html->url(array('action' => 'add')), array('escape' => false)); ?>
            </section>
        </div>
        <div class="table-responsive">
            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid" style="margin: 20px">                 
                <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="actions col-xs-1"><?php echo $this->Paginator->sort('active', __('active'), array('data-toggle' => 'tooltip', 'data-original-title' => __('active'), 'title' => __('active'))); ?></th>
                            <th><?php echo $this->Paginator->sort('subject_id', __('subject_id'), array('data-toggle' => 'tooltip', 'data-original-title' => __('subject_id'), 'title' => __('subject_id'))); ?></th>
                            <th><?php echo $this->Paginator->sort('teacher_id', __('teacher_id'), array('data-toggle' => 'tooltip', 'data-original-title' => __('teacher_id'), 'title' => __('teacher_id'))); ?></th>
                            <th><?php echo $this->Paginator->sort('ds_room', __('ds_room'), array('data-toggle' => 'tooltip', 'data-original-title' => __('ds_room'), 'title' => __('ds_room'))); ?></th>
                            <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $base_url = array('controller' => 'Rooms', 'action' => 'index'); ?>
                            <?php echo $this->Form->create("Filter", array('url' => $base_url, 'class' => 'filter')); ?>
                            <?php $options = array('S' => __('Active'), 'N' => __('Inactive')); ?>
                            <td class="actions col-xs-1"><div data-original-title='<?= __('active') ?>' data-toggle="tooltip"><?php echo $this->Form->input('active', array('label' => '', 'default' => '', 'style' => 'width:100%', 'empty' => __('Status'), 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'options' => $options)); ?></div></td>
                            <td><div data-original-title='<?= __('subject_id') ?>' data-toggle="tooltip"><?php echo $this->Form->input('subject_id', array('label' => '', 'default' => '', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('subject_id'))); ?></div></td>
                            <td><div data-original-title='<?= __('teacher_id') ?>' data-toggle="tooltip"><?php echo $this->Form->input('teacher_id', array('label' => '', 'default' => '', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('teacher_id'))); ?></div></td>
                            <td><?php echo $this->Html->div('row', $this->Form->input('ds_room', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('ds_room'), 'title' => __('ds_room'), 'class' => 'form-control input-sm')), array('escape' => false)); ?></td>
                            <td><?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Search'), 'title' => __('Search'))) ?></td>
                            <?php echo $this->Form->end(); ?>
                        </tr>
                        <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td><?php
                                    if ($room['Room']['active'] == 'S') {
                                        echo '<span  class="btn-sm bg-green pull-right">' . __('Active') . '</span>';
                                    } else {
                                        echo '<span  class="btn-sm bg-red pull-right">' . __('Inactive') . '</span>';
                                    }
                                    ?></td>
                                <td>
                                    <?php echo $this->Html->link($room['Subject']['nm_subject'], array('controller' => 'subjects', 'action' => 'view', $room['Subject']['id'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($room['Teacher']['nm_teacher'], array('controller' => 'teachers', 'action' => 'view', $room['Teacher']['id'])); ?>
                                </td>
                                <td><?php echo h($room['Room']['ds_room']); ?>&nbsp;</td>
                                <td class="actions"  title='Actions' data-original-title='Actions' data-toggle="tooltip">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                                                <i class="fa fa-gear fa-fw"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><?php echo $this->Html->link($this->Html->tag('i', __(' View'), array('class' => 'fa fa-eye fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'view', $room['Room']['id'])), array('escape' => false)); ?></li>
                                                <li><?php echo $this->Html->link($this->Html->tag('i', __(' Edit'), array('class' => 'fa fa-edit fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'edit', $room['Room']['id'])), array('escape' => false)); ?></li>
                                                <li><?php echo $this->Form->postLink($this->Html->tag('i', __(' Delete'), array('class' => 'fa fa-trash-o fa-fw')), array('action' => 'delete', $room['Room']['id']), array('escape' => false), __('Are you sure you want to delete the %s?', $room['Room']['id']), array('class' => 'btn btn-mini')); ?> </li>
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