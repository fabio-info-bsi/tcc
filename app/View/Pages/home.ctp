<?php
echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?>
<section class="content-header">
    <h1> <?php echo __("Dashboard") ?> <small>Version 1.0</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
            <?php echo __("Dashboard") ?>
        </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    
    <?php debug($this->Session->read("Auth.User")) ?>
    
</section><!-- /.content -->
