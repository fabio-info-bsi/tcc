<?php
echo $this->Html->script(
        array(
            "moment",
            "lightbox/js/lightbox.min"
        )
);
echo $this->Html->css(
        array(
            "lightbox/css/lightbox"
        )
);
?>
<section class="content-header">
    <h1>
        <?php echo __('Users'); ?>        
        <small><?php echo __('Edit User'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link($this->Html->tag('i', __(' Home'), array('class' => 'fa fa-dashboard')), $this->Html->url(array('controller' => 'Pages', 'action' => 'display_candidate')), array('escape' => false)); ?></li>
        <li><?php echo $this->Html->link(__('Users'), array('action' => 'index'), array()); ?></li>
        <li class="active"><?php echo __('Edit User'); ?></li>
    </ol>
</section>
<section class="content">
    <div class="users form" style="margin: 20px" >
        <?php echo $this->Form->create('User', array('type' => 'file')); ?>
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading" align="right">
                    <a href="<?php echo $this->Html->url($this->request->referer()); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-reply fa-fw"></i></button></a>                <a href="<?php echo $this->Html->url(); ?>" ><button class="btn btn-primary" type="button"><i class="fa fa-refresh fa-fw"></i></button></a>            </div>
                <div style="margin: 20px">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12" style="text-align: center">
                            <div id="image">
                                <?php
                                if (!empty($this->request->data['User']['image'])) {
                                    echo $this->Html->link(
                                            $this->Html->Image(str_replace('img/', "", $this->request->data['User']['image']), array('class' => 'img-rounded', 'alt' => 'Condo Image', 'width' => 220, 'height' => 220)), '../' . $this->request->data['User']['image'], array('escapeTitle' => false, 'title' => 'img', 'data-lightbox' => 'roadtrip', 'class' => 'class_url', 'width' => 500, 'height' => 400)
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <?php
                            echo $this->Html->div('row', $this->Form->input('id', array('div' => 'col-xs-5', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('username', array('disabled' => true, 'div' => 'col-lg-8 col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('name', array('label' => __('nickname'), 'div' => 'col-lg-8 col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('email', array('div' => 'col-lg-8 col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            echo $this->Html->div('row', $this->Form->input('image', array('type' => 'file', 'div' => 'col-lg-8 col-xs-12', 'class' => 'form-control input-sm')), array('escape' => false));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <tr >
                    <td style="padding: 15px" >
                        <?php
                        echo $this->Form->submit('Confirmar', array(
                            'class' => 'btn btn-primary',
                        ));
                        ?>                </td>
                    <td>
                        <?php echo $this->Html->link(__('Cancelar'), array('controller' => 'Pages', 'action' => 'display_candidate'), array('class' => 'btn btn-primary')); ?>                </td>
                </tr>
            </table>
        </fieldset>
    </div>
</section>