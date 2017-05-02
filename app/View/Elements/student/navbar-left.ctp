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
                       'plugin' => false,
                       'controller' => 'Pages',
                       'action' => 'student_home'
                   ));
                   ?>">
                    <i class="fa fa-dashboard"></i> <span><?php echo __("Dashboard") ?></span>
                </a>

            </li>
            
<!--            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'plugin' => false,
                    'controller' => 'Students',
                    'action' => 'teacher_index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Students") ?></span>
                </a>
            </li>-->
<!--            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Teachers',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Teachers") ?></span>
                </a>
            </li>-->
<!--            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Subjects',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa fa-child"></i> <span><?php echo __("Subjects") ?></span>
                </a>
            </li>-->
<!--            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Rooms',
                    'action' => 'index'
                ));
                   ?>">
                    <i class="fa  fa-group"></i> <span><?php echo __("Rooms") ?></span>
                </a>
            </li>-->
            
<!--            <li>
                <a href="<?php
                echo $this->Html->url(array(
                    'controller' => 'Matriculations',
                    'action' => 'teacher_index'
                ));
                   ?>">
                    <i class="fa  fa-group"></i> <span><?php echo __("Matriculations") ?></span>
                </a>
            </li>-->
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Teams',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-ticket"></i> <span><?php echo __("Teams") ?></span>
                </a>
            </li>
            
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'plugin' => false,
                       'controller' => 'Activities',
                       'action' => 'student_time_line'
                   ));
                   ?>">
                    <i class="fa fa-gavel"></i> <span><?php echo __("Activities") ?></span>
                </a>
            </li>
            
<!--            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Activities',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-glass"></i> <span><?php echo __("Challenge") ?></span>
                </a>
            </li>-->
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Points',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-bar-chart"></i> <span><?php echo __("Points") ?></span>
                </a>
            </li>
<!--            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'MatriculationsRewards',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-diamond"></i> <span><?php echo __("To award") ?></span>
                </a>
            </li>-->
            
            <li>
                <a href="<?php
                   echo $this->Html->url(array(
                       'controller' => 'Rewards',
                       'action' => 'teacher_index'
                   ));
                   ?>">
                    <i class="fa fa-gift"></i> <span><?php echo __("Rewards") ?></span>
                </a>
            </li>
            
        </ul>    
    </section>
    <!-- /.sidebar -->
</aside>