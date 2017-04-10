<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versão</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">2days</a>.</strong> Todos os Direitos Reservados.

    <?php //echo $this->element('sql_dump'); ?>
</footer>
<?php
//scripts
echo $this->Html->script(array(
    "/AdminLTE-2.3.11/bootstrap/js/bootstrap.min",
    "/AdminLTE-2.3.11/dist/js/app.min",
    
    "/AdminLTE-2.3.11/plugins/sparkline/jquery.sparkline.min",
    "/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-1.2.2.min",
    "/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-world-mill-en",
//    '/AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask',
//    '/AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.date.extensions',
//    '/AdminLTE-2.3.11/plugins/input-mask/jquery.inputmask.extensions',
//    "/AdminLTE-2.3.11/plugins/fastclick/fastclick.min",
//    "/AdminLTE-2.3.11/plugins/sparkline/jquery.sparkline.min",
//    "/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
//    "/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
//    "/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker",
//    "/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker",
//    "/AdminLTE-2.3.11/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js",
//    "/AdminLTE-2.3.11/plugins/iCheck/icheck.min",
    "/AdminLTE-2.3.11/plugins/iCheck/icheck",
    "/AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min",
    "/AdminLTE-2.3.11/plugins/chartjs/Chart.min",
    "/AdminLTE-2.3.11/dist/js/demo.js",
    "/AdminLTE-2.3.11/dist/js/pages/dashboard2",
//    "/AdminLTE-2.3.11/plugins/auto-complete/jquery.tokeninput",
    '/AdminLTE-2.3.11/plugins/bootstrap-select/bootstrap-select'
));
echo $this->fetch('script');
?>
