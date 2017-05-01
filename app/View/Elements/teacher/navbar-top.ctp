<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo"><b>IF</b>LIP<i class="fa fa-gamepad"></i> </a>
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
        <?php echo $this->Form->create(false, array('url'=> array('controller'=> 'Rooms', 'action'=> 'update_select_room'))); ?>
        <div class="navbar-custom">
            <?php echo $this->Html->div('novo', $this->Form->input('room_id', array('value'=>$this->Session->read('Auth.User.SelectRoom.id'), 'label' => FALSE,'onChange'=>'javascript:this.form.submit()', 'div' => 'col-lg-8 col-xs-9', 'class' => 'form-control input-sm selectpicker', 'data-style' => 'btn-primary', 'style' => 'width:10%',)), array('escape' => false)); ?>
        </div>
        <?php echo $this->Form->end(); ?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
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
                                    "controller" => "users",
                                    "action" => "edit",
                                    $this->Session->read('Auth.User.id')))
                                ?>" class="btn btn-default btn-flat"><?php echo __('Profile'); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php
                                echo $this->Html->url(array(
                                    "controller" => "users",
                                    "action" => "logout",
                                    //"plugin" => "admin/admin"
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