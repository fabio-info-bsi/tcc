<header class="main-header">
    <!-- Logo -->

    <!-- Logo -->
    <a href="/Pages/student_home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>IF</b><i class="fa fa-gamepad"></i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>IF</b>LIP<i class="fa fa-gamepad"></i></span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <style>
            .novo{
                position: absolute; height: 116px; top: 20%; width: 90%; left: 14%;
            }
        </style>
        <?php echo $this->Form->create(false, array('url'=> array('controller'=> 'Matriculations', 'action'=> 'update_select_matriculation'))); ?>
        <div class="navbar-custom">
            <?php echo $this->Html->div('novo', $this->Form->input('matriculation_id', array('value'=>$this->Session->read('Auth.User.SelectMatriculation.id'), 'label' => FALSE,'onChange'=>'javascript:this.form.submit()', 'div' => 'col-lg-8 col-xs-5', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-success', 'style' => 'width:10%',)), array('escape' => false)); ?>
        </div>
        <?php echo $this->Form->end(); ?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-star-empty"></i>
                        <span class="label label-primary">
                            <?php echo $this->requestAction(array('controller' => 'Points', 'action' => 'total_points_xp')); ?>
                        </span>
                    </a>
                    
                </li>
                
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ion-pricetags"></i>
                        <span class="label label-warning pull-right">
                            <?php echo $this->requestAction(array('controller' => 'Points', 'action' => 'total_points_redeemable')); ?>
                        </span>
                    </a>
                    
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if ($this->Session->read('Auth.User.image') != null) {
                            echo $this->Html->Image(str_replace('img/', "", $this->Session->read('Auth.User.image')), array('class' => 'user-image', 'alt' => 'User Image'));
                        } else {
                            echo $this->Html->Image('avatar.jpg', array('class' => 'user-image', 'alt' => 'User Image'));
                        }
                        ?> 
                      <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/> -->
                        <span class="hidden-xs"><?php echo $this->Session->read('Auth.User.name'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <?php
                            if ($this->Session->read('Auth.User.image') != null) {
                                echo $this->Html->Image(str_replace('img/', "", $this->Session->read('Auth.User.image')), array('class' => 'img-circle', 'alt' => 'User Image'));
                            } else {
                                echo $this->Html->Image('avatar.jpg', array('class' => 'img-circle', 'alt' => 'User Image'));
                            }
                            ?> <p>
                                <?php echo $this->Session->read('Auth.User.name'); ?>
                                - 
                                <?php echo $this->Session->read('Auth.User.Group.name'); ?>
                                <small><?php echo __('Member since') . $this->Time->nice($this->Session->read('Auth.User.created'), null, ' %B, %Y') ?></small>
                            </p>

                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">

                                <a href="<?php
                                echo $this->Html->url(array(
                                    'plugin' => false,
                                    "controller" => "users",
                                    "action" => "session_edit"))
                                ?>" class="btn btn-default btn-flat"><?php echo __('Profile'); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php
                                echo $this->Html->url(array(
                                    'plugin' => false,
                                    "controller" => "users",
                                    "action" => "logout",
                                ))
                                ?>" class="btn btn-default btn-flat"><?php echo __('Sign out'); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>