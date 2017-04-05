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
    <head>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php echo $this->element('head'); ?>
    </head>
    <body class="skin-purple sidebar-mini wysihtml5-supported sidebar-collapse" style="height: auto;">
        <div class="wrapper" style="height: auto;">
            <?php echo $this->element('teacher/navbar-top'); ?>
            <?php echo $this->element('teacher/navbar-left'); ?>
            <aside class="right-side">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </aside>
        </div>
        <?php echo $this->element('footer'); ?>
    </body>
</html>
