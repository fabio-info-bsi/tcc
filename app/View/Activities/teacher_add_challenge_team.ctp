<?php
echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?><section class="content-header">
    <h1>
        <?php echo __('Activities'); ?>
        <small><?php echo __('Add') . ' ' . __('Activity'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Activities'), '/Activities');
    $this->Html->addCrumb(__('Add Activity'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>
</section>
<section class="content">
    <div class="activities form" style="margin: 20px" >
        <?php echo $this->Form->create('Activity'); ?>
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
                            echo $this->Html->div('row', $this->Form->input('nm_activity', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('nm_activity'), 'title' => __('nm_activity'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('ds_activity', array('id' => 'ds_activity', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('ds_activity'), 'title' => __('ds_activity'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('type_activity', array('value' => 'CG', 'type' => 'hidden', 'div' => 'col-xs-5', 'class' => 'form-control input-sm')), array('escape' => false));
                            ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo __('vl_point_redeemable') ?></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion-pricetags"></i>
                                            </div>
                                            <?php
                                            echo $this->Form->input('vl_point_redeemable', array('label'=> false,'data-toggle' => 'tooltip', 'data-original-title' => __('vl_point_redeemable'), 'title' => __('vl_point_redeemable'), 'class' => 'form-control input-sm'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                echo $this->Html->div('', $this->Form->input('vl_activity_sucess', array('div' => 'col-xs-4', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_sucess'), 'title' => __('vl_activity_sucess'), 'class' => 'form-control input-sm')), array('escape' => false));
                                echo $this->Html->div('', $this->Form->input('vl_activity_attempt', array('div' => 'col-xs-4', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_attempt'), 'title' => __('vl_activity_attempt'), 'class' => 'form-control input-sm')), array('escape' => false));
                                echo $this->Html->div('', $this->Form->input('vl_activity_failed', array('div' => 'col-xs-4', 'data-toggle' => 'tooltip', 'data-original-title' => __('vl_activity_failed'), 'title' => __('vl_activity_failed'), 'class' => 'form-control input-sm')), array('escape' => false));
                                ?>
                            </div>
                            <div data-original-title='<?= __('reward_id') ?>' data-toggle="tooltip">
                                <?php echo $this->Html->div('row', $this->Form->input('reward_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('reward_id'))), array('escape' => false)); ?>
                            </div>
                            <div data-original-title='<?= __('room_id') ?>' data-toggle="tooltip">
                                <?php //echo $this->Html->div('row', $this->Form->input('room_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('room_id'))), array('escape' => false));  ?>
                            </div><?php
                            echo $this->Html->div('row', $this->Form->input('Team', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            //echo $this->Html->div('row', $this->Form->input('Matriculation', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
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
<script>
    $('#ds_activity').wysihtml5();
</script>