<section class="content-header">
    <h1>
        <?php echo __('Matriculations Rewards'); ?>
        <small><?php echo __('Add') . ' ' . __('Matriculations Reward'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Matriculations Rewards'), '/Matriculations Rewards');
    $this->Html->addCrumb(__('Add Matriculations Reward'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>
</section>
<div class="matriculationsRewards form" style="margin: 20px" >
    <?php echo $this->Form->create('MatriculationsReward'); ?>
    <fieldset>
        <div class="panel panel-default">
            <div class="panel-heading" align="right">
                <a href="<?php echo $this->Html->url(array('action' => 'teacher_index')); ?>"><button class="btn btn-primary" title='<?= __('Back') ?>' data-original-title='<?= __('Back') ?>' data-toggle="tooltip" type="button"><i class="fa fa-reply fa-fw"></i></button></a>
                <a href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" title='<?= __('Refresh') ?>' data-original-title='<?= __('Refresh') ?>' data-toggle="tooltip" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <div style="margin: 20px">
                        <?php
                        $options = array('S' => __('Active'), 'N' => __('Inactive'));
                        ?><div data-original-title='<?= __('active') ?>' data-toggle="tooltip">
                            <?php //echo $this->Html->div('row', $this->Form->input('active', array('div' => 'col-xs-12', 'type' => 'select', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'options' => $options, 'default' => 'S')), array('escape' => false)); ?></div>
                        <?php echo $this->Html->div('row', $this->Form->input('removed', array('value' => 'N', 'type' => 'hidden', 'div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                        ?><div data-original-title='<?= __('matriculation_id') ?>' data-toggle="tooltip">
                                <?php echo $this->Html->div('row', $this->Form->input('matriculation_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('matriculation_id'))), array('escape' => false)); ?>
                        </div><?php ?><div data-original-title='<?= __('reward_id') ?>' data-toggle="tooltip">
                            <?php echo $this->Html->div('row', $this->Form->input('reward_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('reward_id'))), array('escape' => false)); ?>
                        </div><?php
                            ?><div data-original-title='<?= __('activity_id') ?>' data-toggle="tooltip">
                            <?php //echo $this->Html->div('row', $this->Form->input('activity_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('activity_id'))), array('escape' => false)); ?>
                        </div><?php ?>
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
