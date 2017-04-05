<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
                if ($this->Session->read('Auth.User.image') != null) {
                    echo $this->Html->Image(str_replace('img/', "", $this->Session->read('Auth.User.image')), array('class' => 'img-circle', 'alt' => 'User Image'));
                } else {
                    echo $this->Html->Image('avatar.jpg', array('class' => 'img-circle', 'alt' => 'User Image'));
                }
                ?>  
            </div>
            <div class="pull-left info">
                <p><?php
                echo $this->Html->para(null, __('Hello ') . $this->Session->read('Auth.User.name'));
                ?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><?php echo __("MAIN NAVIGATION") ?></li>
            <li class="treeview">
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'pages',
                       'action' => 'display'
                   ));
                   ?>">
                    <i class="fa fa-dashboard"></i> <span><?php echo __("Dashboard") ?></span>
                </a>

            </li>
            
            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Students',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Students") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Teachers',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Teachers") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Subjects',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Subjects") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Rooms',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa  fa-group"></i> <span><?php echo __("Rooms") ?></span>
                </a>
            </li>
            
            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Matriculations',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa  fa-group"></i> <span><?php echo __("Matriculations") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Points',
                       'action' => 'index'
                   ));
                   ?>">
                    <i class="fa fa-glass"></i> <span><?php echo __("Points") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Activities',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-glass"></i> <span><?php echo __("Activities") ?></span>
                </a>
            </li>
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Teams',
                       'action' => 'index'
                   ));
                   ?>">
                    <i class="fa fa-ticket"></i> <span><?php echo __("Teams") ?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> 
                    <span><?php echo __('Configs') ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>"><i class="fa fa-user"></i> <?php echo __('Users') ?></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'Groups', 'action' => 'index')); ?>"><i class="fa fa-users"></i> <?php echo __('Groups') ?></a></li>
                    <li><a href="<?php echo $this->Html->url(array('plugin' => 'admin', 'controller' => 'permissions', 'action' => 'index')); ?>"><i class="fa fa-unlock-alt"></i> <?php echo __('Access Control') ?></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'Logs', 'action' => 'index')); ?>"><i class="fa f fa-newspaper-o"></i> <?php echo __('Logs') ?></a></li>

                </ul>
            </li>
        </ul>    
    </section>
    <!-- /.sidebar -->
</aside>