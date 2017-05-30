<section class="content-header">
    <h1>
        <?php echo __('Matriculations'); ?>
        <small><?php echo __('Ranking'); ?></small>
    </h1>
    <?php
    $this->Html->addCrumb(__(' Home'), '/', ['i', 'class' => 'fa fa-dashboard']);
    $this->Html->addCrumb(__('Ranking'));
    echo $this->Html->getCrumbList(['class' => 'breadcrumb', 'lastClass' => 'active']);
    ?>

</section>
<section class="content">
    <div class="matriculations index" style="margin: 20px" >
        <div class="panel panel-default">
            <div class="panel-heading" align="left">
                <section class="content-header">
                    <h1><?php echo __('Ranking for Points') ?></h1>
                </section>
            </div>
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th style="text-align: center">Order ID</th>
                            <th><?php echo __('nm_student') ?></th>
                            <th>Itens</th>
                            <th style="text-align: center"><?php echo __('Punctuation') ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($rankingPoints as $matriculation): //debug($matriculation)or die; ?>
                            <tr>
                                <td style="text-align: center">
                                    <div class="user-panel">
                                    <div class="pull-center image">
                                        <?php
                                        if ($matriculation['User']['image'] != null) {
                                            echo $this->Html->Image(str_replace('img/', "", $matriculation['User']['image']), array('class' => 'img-circle', 'alt' => 'User Image'));
                                        } else {
                                            echo $this->Html->Image('avatar.jpg', array('class' => 'img-circle', 'alt' => 'User Image'));
                                        }
                                        ?>  
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <?php echo $matriculation['Student']['nm_student']; ?>
                                </td>
                                <td>
                                    [Vazio]
                                </td>
                                <td style="text-align: center">
                                    <h2><?php echo $matriculation[0]['total_points']; ?> <i class="glyphicon glyphicon-star-empty"></i></h2>
                                    <h6><?php echo $matriculation[0]['total_points_redeemable']; ?> <i class="ion-pricetags"></i></h6>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
</section>