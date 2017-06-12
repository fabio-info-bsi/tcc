
<?php
echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?><section class="content-header">
    <h1>
        <?php echo __('Activities'); ?>
        <small><?php echo __('Time Line') . ' ' . __('Activities'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Activities'), '/Activities');
    $this->Html->addCrumb(__('Timeline'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>
</section>
<section class="content">

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">

                <?php
                //debug($timeLine)or die; 
                //Comparar datas na timeline

                $timeLine[-1]['Activity']['created'] = '';
                //debug($timeLine)or die;
                ?>
                <?php
                for ($index = 0; $index < count($timeLine) - 1; $index++) { //debug($timeLine['Activity'][$index])or die;
                    ?>

                    <?php if (date("d/m/Y", strtotime($timeLine[$index]['Activity']['created'])) != date("d/m/Y", strtotime($timeLine[$index - 1]['Activity']['created']))) { ?>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                <!--10 Feb. 2014-->
                                <?php echo date("d M Y", strtotime($timeLine[$index]['Activity']['created'])); ?>
                            </span>
                        </li>
                    <?php } ?>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <?php
                    if ($timeLine[$index]['Activity']['type_activity'] == 'AT' || $timeLine[$index]['Activity']['type_activity'] == 'CT') {
                        ?>
                        <li>
                            <i class="fa fa fa-group bg-blue"></i>
                            <br>
                        </li>
                        <?php
                    }
                    ?>
                    <li>

                        <i class="fa fa fa-gavel bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("G:i", strtotime($timeLine[$index]['Activity']['created'])); ?></span>

                            <h3 class="timeline-header">
                                <a href="#"> 
                                <?php 
                                switch ($timeLine[$index]['Activity']['type_activity']) {
                                    case 'A':
                                        echo __('Activity');
                                        break;
                                    case 'AT':
                                        echo __('Activity for team');
                                        break;
                                    case 'C':
                                        echo __('Challenge');
                                        break;
                                    case 'CT':
                                        echo __('Challenge for team');
                                        break;
                                    default:
                                        
                                        break;
                                }
                                ?>
                                </a>
                                <?php
                                echo $timeLine[$index]['Activity']['nm_activity']; 
                                ?>
                            </h3>

                            <div class="timeline-body">
                                <?php echo $timeLine[$index]['Activity']['ds_activity']; ?>
                            </div>
                            <div class="timeline-footer">
                                <?php
                                switch ($timeLine[$index]['MatriculationsActivity']['sts_activity']) {
                                    case 'S':
                                        echo '<span  class="btn-sm bg-green pull-right">' . __('Success') . '</span>';
                                        echo '<i class="glyphicon glyphicon-star-empty"></i><span class="label label-success">+' . $timeLine[$index]['Activity']['vl_activity_sucess'] . '</span>';
                                        break;
                                    case 'A':
                                        echo '<span  class="btn-sm bg-blue pull-right">' . __('Attempt') . '</span>';
                                        echo '<i class="glyphicon glyphicon-star-empty"></i><span class="label label-primary">+' . $timeLine[$index]['Activity']['vl_activity_attempt'] . '</span>';
                                        break;
                                    case 'F':
                                        echo '<span  class="btn-sm bg-red pull-right">' . __('Failed') . '</span>';
                                        echo '<i class="glyphicon glyphicon-star-empty"></i><span class="label label-danger">' . $timeLine[$index]['Activity']['vl_activity_failed'] . '</span>';
                                        break;
                                    default:
                                        echo '<span  class="btn-sm bg-yellow pull-right">' . __('Pending') . '</span>';
                                        echo '<i class="fa fa-clock-o"></i><span class="label label-waring"></span>';
                                        break;
                                }
                                ?>


                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                <?php } ?>

                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>