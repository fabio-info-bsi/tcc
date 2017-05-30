<section class="content-header">
    <h1>
        <?php echo __('Points'); ?>
        <small><?php echo __('Extract'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Points'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>

</section>
<section class="content">
    <div class="points index" style="margin: 20px" >
        <div class="panel panel-default">
            <div class="panel-heading" align="right">
                <section class="content-header">
                    <?php echo $this->Html->link($this->Html->tag('button', $this->Html->tag('i', '', array('class' => 'fa fa-refresh fa-fw')), array('class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-original-title' => __('Refresh'), 'title' => __('Refresh'), 'escape' => false)), $this->Html->url(), array('escape' => false)); ?>
                </section>
            </div>
            <div class="table-responsive">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid" style="margin: 20px">                 
                    <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('vl_point', __('vl_point'), array('data-toggle' => 'tooltip', 'data-original-title' => __('vl_point'), 'title' => __('vl_point'))); ?> &nbsp;<i class="glyphicon glyphicon-star-empty"></i></th>
                                <th><?php echo $this->Paginator->sort('vl_point_redeemable', __('vl_point_redeemable'), array('data-toggle' => 'tooltip', 'data-original-title' => __('vl_point_redeemable'), 'title' => __('vl_point_redeemable'))); ?> &nbsp;<i class="ion-pricetags"></i></th>
                                <th><?php echo __('activity_id'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $base_url = array('controller' => 'Points', 'action' => 'student_extract_points'); ?>
                                <?php echo $this->Form->create("Filter", array('url' => $base_url, 'class' => 'filter')); ?>
                                <td><?php //echo $this->Html->div('row', $this->Form->input('vl_point', array('div' => 'col-xs-12', 'style' => 'width:100%', 'label' => '', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_point'), 'title' => __('vl_point'), 'class' => 'form-control input-sm')), array('escape' => false));      ?></td>
                                <td></td>
                                <td><div data-original-title='<?= __('activity_id') ?>' data-toggle="tooltip"><?php echo $this->Form->input('activity_id', array('label' => '', 'onChange' => 'javascript:this.form.submit()', 'default' => '', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('activity_id'))); ?></div></td>
                                <?php echo $this->Form->end(); ?>
                            </tr>
                            <?php foreach ($points as $point): ?>
                                <tr>
                                    <td><?php echo h($point['Point']['vl_point']); ?>&nbsp;</td>
                                    <td><?php echo h($point['Point']['vl_point_redeemable']); ?>&nbsp;</td>
                                    <td><?php echo h($point['Activity']['nm_activity']); ?>&nbsp;</td>
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