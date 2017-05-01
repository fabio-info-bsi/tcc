<section class="content-header">
    <h1>
        <?php echo __('Você não tem acesso a esta página !'); ?>        
        <small><?php echo __('Negado'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link($this->Html->tag('i', __(' Home'), array('class' => 'fa fa-dashboard')), $this->Html->url(array('controller' => 'Pages', 'action' => 'display_candidate')), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link(__('Users'), array('action' => 'index'), array()); ?></li>
        <li class="active"><?php echo __('Edit User'); ?></li>
    </ol>
</section>
<section class="content">
    <small style="font-size: 100%;">:\</small>
</section>

