<section class="content-header">
    <h1>
        <?php echo __('Teams'); ?>
        <small><?php echo __('Edit') . ' ' . __('Team'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Teams'), '/Teams');
    $this->Html->addCrumb(__('Edit Team'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>
</section>
<section class="content">
    <div class="teams form" style="margin: 20px" >
        <?php echo $this->Form->create('Team'); ?>
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading" align="right">
                    <a href="<?php echo $this->Html->url(array('action' => 'teacher_index')); ?>"><button class="btn btn-primary" title='<?= __('Back') ?>' data-original-title='<?= __('Back') ?>' data-toggle="tooltip" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
                    <a href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" title='<?= __('Refresh') ?>' data-original-title='<?= __('Refresh') ?>' data-toggle="tooltip" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-xs-12">
                        <div style="margin: 20px">
                            <?php
                            echo $this->Html->div('row', $this->Form->input('id', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm')), array('escape' => false));
                            $options = array('S' => __('Active'), 'N' => __('Inactive'));
                            ?><div data-original-title='<?= __('active') ?>' data-toggle="tooltip"><?php echo $this->Html->div('row', $this->Form->input('active', array('div' => 'col-xs-12', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'options' => $options, 'default' => 'S')), array('escape' => false)); ?></div>
                            <?php
                            echo $this->Html->div('row', $this->Form->input('removed', array('value' => 'N', 'type' => 'hidden', 'div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('nm_team', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('nm_team'), 'title' => __('nm_team'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('ds_team', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('ds_team'), 'title' => __('ds_team'), 'class' => 'form-control input-sm')), array('escape' => false));
                            //echo $this->Html->div('row', $this->Form->input('room_id', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('room_id'), 'title' => __('room_id'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('Activity', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('Matriculation', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <tr>
                    <td style="padding: 15px" ><button class="btn btn-primary" title='<?= __('Confirm') ?>' data-original-title='<?= __('Confirm') ?>' data-toggle="tooltip" type="submit"><i class="fa fa-check fa-fw"></i> <?= __('Confirm') ?></button></td>
                    <td><a href="<?= $this->Html->url(array('action' => 'teacher_index')); ?>"><button title='<?= __('Cancel') ?>' data-original-title='<?= __('Cancel') ?>' data-toggle="tooltip" class="btn btn-primary" type="button"><i class="fa fa-close fa-fw"></i><?= __('Cancel') ?></button></a></td>
                </tr>
            </table>
        </fieldset>
    </div>
</section>