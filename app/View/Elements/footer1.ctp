<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versão</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">2days</a>.</strong> Todos os Direitos Reservados.
    <?php //echo $this->element('sql_dump'); ?>
</footer>
<script type="text/javascript">
    $(function () {
        //Money Euro
        $("[data-mask]").inputmask();

    });
</script>
<?php
//scripts
echo $this->Html->script(array(
    "bootstrap.min.js",
    '/plugins/input-mask/jquery.inputmask',
    '/plugins/input-mask/jquery.inputmask.date.extensions',
    '/plugins/input-mask/jquery.inputmask.extensions',
    "fastclick/fastclick.min",
    "app.min",
    "sparkline/jquery.sparkline.min",
    "jvectormap/jquery-jvectormap-1.2.2.min.js",
    "jvectormap/jquery-jvectormap-world-mill-en.js",
    "daterangepicker/moment.min",
    //"/plugins/datepicker/locales/bootstrap-datepicker.pt-BR",


    "/plugins/datepicker/moment-with-locales",
    "/plugins/datepicker/bootstrap-datetimepicker.min",

    "/plugins/daterangepicker/daterangepicker",

    "/plugins/auto-complete/jquery.tokeninput",
    "/plugins/datepicker/bootstrap-datepicker",
    "/plugins/iCheck/icheck.min",
    "slimScroll/jquery.slimscroll.min",
    "chartjs/Chart.min",
    "/plugins/auto-complete/jquery.tokeninput",
    'bootstrap-select',
    //  "pages/dashboard2",
    // "demo.js"
));
echo $this->fetch('script');
?>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#recipient-name').val(recipient)
    })
</script>
<script>
    function consultacep(cep) {
        cep = cep.replace(/\D/g, "")
        url = "http://cep.correiocontrol.com.br/" + cep + ".js"
        s = document.createElement('script')
        s.setAttribute('charset', 'utf-8')
        s.src = url
        document.querySelector('head').appendChild(s)
    }
    function correiocontrolcep(valor) {
        if (valor.erro) {
            alert('Cep não encontrado');
            return;
        }
        ;
        document.getElementById('logradouro').value = valor.logradouro
        document.getElementById('bairro').value = valor.bairro
        document.getElementById('localidade').value = valor.localidade
        document.getElementById('uf').value = valor.uf
    }
</script>