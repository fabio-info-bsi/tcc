<?php
echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?><section class="content-header">
    <h1>
        <?php echo __('Activities'); ?>
        <small><?php echo __('Edit') . ' ' . __('Activity'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Activities'), '/Activities');
    $this->Html->addCrumb(__('Edit Activity'));
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
                            echo $this->Html->div('row', $this->Form->input('id', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('type_activity', array('type'=>'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('nm_activity', array('div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('nm_activity'), 'title' => __('nm_activity'), 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('ds_activity', array('id' => 'ds_activity', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('ds_activity'), 'title' => __('ds_activity'), 'class' => 'form-control input-sm')), array('escape' => false));
                            ?>
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
                                <?php //echo $this->Html->div('row', $this->Form->input('room_id', array('div' => 'col-xs-12', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'data-live-search' => 'true', 'style' => 'width:100%', 'empty' => __('room_id'))), array('escape' => false)); ?>
                            </div><?php
                            //echo $this->Html->div('row', $this->Form->input('Team', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            //echo $this->Html->div('row', $this->Form->input('Matriculation', array('div' => 'col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            ?>

                            <div class="row">
                                <?php if (!empty($this->request->data['Team'])) { ?>
                                    <div class="table-responsive">
                                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid" style="margin: 20px">                 
                                            <table  class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" style="text-align: center" ><?php echo __('Team winner') ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo __('nm_team'); ?></th>
                                                        <th class="actions col-xs-5" style="text-align: center"><?php echo __('Winner'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    for ($index = 0; $index < count($this->request->data['Team']); $index++) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            //debug($this->request->data)or die;
                                                            ?>
                                                            <td>
                                                                <?php
                                                                echo $this->request->data['Team'][$index]['nm_team'];
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center">
                                                                <?php
                                                                echo $this->Form->input('Team.' . $index . '.id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Team.' . $index . '.room_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));

                                                                echo $this->Form->input('Team.' . $index . '.ActivitiesTeam.id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Team.' . $index . '.ActivitiesTeam.activity_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Team.' . $index . '.ActivitiesTeam.team_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                $options = array("w");
                                                                if ('at' == strtolower($this->request->data['Activity']['type_activity'])) {
                                                                    $options = array('D' => ' Defeated ', 'A' => ' Attempt ', 'W' => ' Winner ');
                                                                    $attributes = array('legend' => false);
                                                                    echo $this->Form->radio('Team.' . $index . '.ActivitiesTeam.sts_activity_team', $options, $attributes);
                                                                } else if ('ct' == strtolower($this->request->data['Activity']['type_activity'])) {
                                                                    echo $this->Form->checkbox('Team.' . $index . '.ActivitiesTeam.sts_activity_team', array('value' => 'W', 'hiddenField' => 'D'));
                                                                }

                                                                //echo $this->Form->input('Matriculationif().' . $index . '.MatriculationsActivity.sts_activity', array('options' => $options,'type' => 'radio','div' => 'col-xs-4', 'class' => 'radio'), array('escape' => false));
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($this->request->data['Matriculation'])) { ?>
                                    <div class="table-responsive">
                                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid" style="margin: 20px">                 
                                            <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __('nm_student'); ?></th>
                                                        <th class="actions col-xs-5"><?php echo __('Avalietion'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    for ($index = 0; $index < count($this->request->data['Matriculation']); $index++) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            //debug($this->request->data)or die;
                                                            ?>
                                                            <td>
                                                                <?php
                                                                echo $this->request->data['Matriculation'][$index]['Student']['nm_student'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo $this->Form->input('Matriculation.' . $index . '.id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Matriculation.' . $index . '.room_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Matriculation.' . $index . '.student_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));

                                                                echo $this->Form->input('Matriculation.' . $index . '.MatriculationsActivity.id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Matriculation.' . $index . '.MatriculationsActivity.activity_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                echo $this->Form->input('Matriculation.' . $index . '.MatriculationsActivity.matriculation_id', array('type' => 'hidden', 'div' => 'col-xs-12', 'data-toggle' => 'tooltip', 'data-original-title' => __('id'), 'title' => __('id'), 'class' => 'form-control input-sm'));
                                                                $options = array('N' => ' failed ', 'A' => ' Attempt ', 'S' => ' Sucess ');
                                                                $attributes = array('legend' => false);
                                                                echo $this->Form->radio('Matriculation.' . $index . '.MatriculationsActivity.sts_activity', $options, $attributes);
                                                                //echo $this->Form->input('Matriculation.' . $index . '.MatriculationsActivity.sts_activity', array('options' => $options,'type' => 'radio','div' => 'col-xs-4', 'class' => 'radio'), array('escape' => false));
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

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
    //$('#ds_activity').wysihtml5();

</script>