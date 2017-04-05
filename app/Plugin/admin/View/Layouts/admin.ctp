

 <?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
     <?php echo $this->element('head');
      echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
     ?>
    <?php 
          $app = array();
          $app['basePath'] = Router::url('/');
          $app['params'] = array(
            'controller' => $this->params['controller'],
            'action' => $this->params['action'],
            'named' => $this->params['named'],
          );
          echo $this->Html->scriptBlock('var App = ' . $this->Js->object($app) . ';');
     ?>
  </head>
    <body class="skin-black pace-done fixed">  
             <!-- Navigation -->
            <?php echo $this->element('navbar-top'); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <?php echo $this->element('navbar-left'); ?>
                
                <aside class="right-side">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-12 col-md-12 main">
                          <!-- <h1 class="page-header">Dashboard</h1> -->
                
                          <div class="row-fluid">
                            <?php 
                                echo $this->Session->flash();
                                echo $this->Session->flash('auth');
                              ?>
                              
                            <?php echo $this->fetch('content'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                </aside><!-- /.right-side -->
                <?php echo $this->element('footer'); ?>
            </div>
        <!-- <?php echo $this->element('sql_dump'); ?>-->
    </body>
</html>

                    
                
                    