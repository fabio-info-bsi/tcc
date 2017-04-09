<section class="content-header">
    <h1>
        <?php echo __('Matriculations'); ?>
        <small><?php echo __('All Registered'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Matriculations'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>

</section>
<section class="content">
    <div class="matriculations index" style="margin: 20px" >
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
                                <th><?php echo $this->Paginator->sort('student_id', __('student_id'), array('data-toggle' => 'tooltip', 'data-original-title' => __('student_id'), 'title' => __('student_id'))); ?></th>
                                <th class="actions col-xs-1"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $base_url = array('controller' => 'Matriculations', 'action' => 'teacher_index'); ?>
                                <?php echo $this->Form->create("Filter", array('url' => $base_url, 'class' => 'filter')); ?>
                                <td><div data-original-title='<?= __('student_id') ?>' data-toggle="tooltip"><?php echo $this->Form->input('student_id', array('label' => '', 'default' => '', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('student_id'))); ?></div></td>
                                <td><?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Search'), 'title' => __('Search'))) ?></td>
                                <?php echo $this->Form->end(); ?>
                            </tr>
                            <?php foreach ($matriculations as $matriculation): ?>
                                <tr>
                                    <td>
                                        <?php echo $this->Html->link($matriculation['Student']['nm_student'], array('controller' => 'students', 'action' => 'view', $matriculation['Student']['id'])); ?>
                                    </td>
                                    <td class="actions"  title='Actions' data-original-title='Actions' data-toggle="tooltip">
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                                                    <i class="fa fa-gear fa-fw"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li><?php echo $this->Html->link($this->Html->tag('i', __(' View'), array('class' => 'fa fa-eye fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'view', $matriculation['Matriculation']['id'])), array('escape' => false)); ?></li>
                                                    <li><?php echo $this->Html->link($this->Html->tag('i', __(' Edit'), array('class' => 'fa fa-edit fa-fw'), array('class' => 'btn btn-primary', 'escape' => false)), $this->Html->url(array('action' => 'teacher_edit', $matriculation['Matriculation']['id'])), array('escape' => false)); ?></li>
                                                    <li><?php echo $this->Form->postLink($this->Html->tag('i', __(' Delete'), array('class' => 'fa fa-trash-o fa-fw')), array('action' => 'delete', $matriculation['Matriculation']['id']), array('escape' => false), __('Are you sure you want to delete the %s?', $matriculation['Matriculation']['id']), array('class' => 'btn btn-mini')); ?> </li>
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