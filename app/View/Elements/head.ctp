<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo __($this->fetch('title')); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    //CSS
    echo $this->Html->css(array(
        "/AdminLTE-2.3.11/bootstrap/css/bootstrap.min",
        "/AdminLTE-2.3.11/plugins/bootstrap-select/bootstrap-select",
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css",
        "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css",
//                                    "/AdminLTE-2.3.11/plugins/datepicker/datepicker3",
//                                    "/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datetimepicker.min",
//                                    "/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker-bs3",
//                                    "/AdminLTE-2.3.11/plugins/morris/morris.css",
//                                    "/AdminLTE-2.3.11/plugins/auto-complete/token-input",
//                                    "/AdminLTE-2.3.11/plugins/auto-complete/token-input-facebook",
        "/AdminLTE-2.3.11/plugins/iCheck/square/blue",
        "/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-1.2.2",
        "/AdminLTE-2.3.11/dist/css/AdminLTE.min",
        "/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css"
    ));
    echo $this->fetch('script');
    echo $this->Html->script('/AdminLTE-2.3.11/dist/js/jQuery-2.1.3.min');
    ?>
</head>