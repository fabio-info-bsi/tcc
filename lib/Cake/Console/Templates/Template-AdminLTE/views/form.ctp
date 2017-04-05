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
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
?>
<?php
    foreach ($fields as $field) {
        if(!in_array($field, array('created', 'modified', 'updated'))){
            switch ($schema[$field]['type']) {
                case 'text':
                    echo "<?php echo \$this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); 
echo \$this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?>";
                    break;
                
                default:
                    break;
            }
        }
    }          
?>
<section class="content-header">
    <h1>
        <?php echo "<?php echo __('{$pluralHumanName}'); ?>\n"; ?>
        <small><?php printf("<?php echo __('%s').' '.__('%s'); ?>", Inflector::humanize($action), $singularHumanName); ?></small>
    </h1>
     <?php echo "<?php  \$this->Html->addCrumb(__(' Home'), '/',['i','class'=>'fa fa-dashboard']);\n";
          echo "            \$this->Html->addCrumb(__('{$pluralHumanName}'),'/{$pluralHumanName}');\n";
          printf("              \$this->Html->addCrumb(__('%s %s'));\n", Inflector::humanize($action), $singularHumanName);
          echo "            echo \$this->Html->getCrumbList(['class'=>'breadcrumb','lastClass'=>'active']);?>\n";?>
</section>
<div class="<?php echo $pluralVar; ?> form" style="margin: 20px" >
<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
    <fieldset>
        <div class="panel panel-default">
            <div class="panel-heading" align="right">
                <?php echo "<a href=\"<?php echo \$this->Html->url(array('action' => 'index')); ?>\"><button class=\"btn btn-primary\" title='<?=__('Back')?>' data-original-title='<?=__('Back')?>' data-toggle=\"tooltip\" type=\"button\"><i class=\"fa fa-reply fa-fw\"></i></button></a>\n"?>
                <?php echo "<a href=\"<?php echo \$this->Html->url(); ?>\" ><button class=\"btn btn-primary\" title='<?=__('Refresh')?>' data-original-title='<?=__('Refresh')?>' data-toggle=\"tooltip\" type=\"button\"><i class=\"fa fa-refresh fa-fw\"></i></button></a>\n"?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-7 col-xs-12">
                    <div style="margin: 20px">
                        <?php
                    		echo "<?php\n";
                    		foreach ($fields as $field) {
                    		    $isKey = false;
                                if (!empty($associations['belongsTo'])) {
                                    foreach ($associations['belongsTo'] as $alias => $details) {
                                        if ($field === $details['foreignKey']) {
                                            $isKey = true;
                                            echo "\t\t\t\t\t\t\t?><div data-original-title='<?=__('{$field}')?>' data-toggle=\"tooltip\">\n\t\t\t<?php echo \$this->Html->div('row',\$this->Form->input('{$field}',array('div'=>'col-xs-12','class'=>'form-control input-sm selectpicker','data-style'=>'btn-primary','data-live-search'=>'true','style'=>'width:100%','empty' => __('{$field}'))),array('escape'=>false)); ?>\n\t\t</div><?php\n";
                                            break;
                                        }
                                    }
                                }
                    			if (strpos($action, 'add') !== false && $field === $primaryKey) {
                    				continue;
                    			}elseif($isKey){
                    			    
                    			}elseif($field === 'active'){
                    			    echo "\t\t\t\t\t\$options = array('S' => __('Active'),'N' => __('Inactive'));\n";
                                    echo "\t\t\t\t\t?><div data-original-title='<?=__('{$field}')?>' data-toggle=\"tooltip\"><?php echo \$this->Html->div('row',\$this->Form->input('{$field}',array('div'=>'col-xs-12','type'=>'select','class'=>'form-control input-sm selectpicker','data-style'=>'btn-primary','data-live-search'=>'true','options' => \$options,'default'=>'S')),array('escape'=>false));?></div>\n<?php";
                                    
                                }elseif($field === 'removed'){
                    			    echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$field}',array('value'=>'N','type'=>'hidden','div'=>'col-xs-12','class'=>'form-control input-sm')),array('escape'=>false));\n";
                                    
                    			}elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                    			    
                    			    //Essa é a magica
                    			    switch ($schema[$field]['type']) {
                                        case 'date':
                                            echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$field}',array('id'=>'{$field}','div'=>'col-xs-12 datetimepicker','type'=>'text','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                            
                                            break;
                                        case 'datetime':
                                            echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$field}',array('id'=>'{$field}','div'=>'col-xs-12 datetimepicker','type'=>'text','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                            
                                            break;
                                        case 'time':
                                            echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$field}',array('id'=>'{$field}','div'=>'col-xs-12 datetimepicker','type'=>'text','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                            
                                            break;
                                        case 'text':
                                            echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$field}',array('id'=>'{$field}','div'=>'col-xs-12','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                            
                                            break;
                                        default:
                                            //echo $schema[$field]['type'];
                                            echo "\t\t\t\t\t echo \$this->Html->div('row',\$this->Form->input('{$field}',array('div'=>'col-xs-12','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                                         
                                            break;
                                    }
                    			}
                    		}
                    		if (!empty($associations['hasAndBelongsToMany'])) {
                    			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                    			    echo "\t\t\t\t\techo \$this->Html->div('row',\$this->Form->input('{$assocName}',array('div'=>'col-xs-12','class'=>'form-control input-sm')),array('escape'=>false));\n";
                             
                    			}
                    		}
                    		echo "\t\t\t\t?>\n";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <td style="padding: 15px" ><button class="btn btn-primary" title='<?php echo"<?=__('Confirm')?>"?>' data-original-title='<?php echo"<?=__('Confirm')?>"?>' data-toggle="tooltip" type="submit"><i class="fa fa-check fa-fw"></i> <?php echo"<?=__('Confirm')?>"?></button></td>
                <td><a href="<?php echo "<?=\$this->Html->url(array('action' => 'index'));?>" ?>"><button title='<?php echo"<?=__('Cancel')?>"?>' data-original-title='<?php echo"<?=__('Cancel')?>"?>' data-toggle="tooltip" class="btn btn-primary" type="button"><i class="fa fa-close fa-fw"></i><?php echo"<?=__('Cancel')?>"?></button></a></td>
            </tr>
        </table>
	</fieldset>
</div>
<?php
    foreach ($fields as $field) {
        if(!in_array($field, array('created', 'modified', 'updated'))){
            switch ($schema[$field]['type']) {
                case 'date':
                    echo "<script>
    $(function () {
                    $('#{$field}').datetimepicker({
                        locale: 'pt',
                        format: 'DD-MM-YYYY',
                        viewMode: 'days',
                    });
                    
                });
</script>";
                    break;
                case 'datetime':
                    echo "<script>
    $(function () {
                    $('#{$field}').datetimepicker({
                        locale: 'pt',
                        format: 'DD-MM-YYYY HH:mm',
                        viewMode: 'days',
                    });
                    
                });
</script>";
                    break;
                case 'time':
                    echo "<script>
    $(function () {
                    $('#{$field}').datetimepicker({
                        locale: 'pt',
                        format: 'HH:mm',
                        viewMode: 'days',
                    });
                    
                });
</script>";
                    break;
                
                case 'text':
                 echo "<script>
                    $('#{$field}').wysihtml5();
</script>";
                    break;     
                default:
                    //echo $schema[$field]['type'];
                             
                    break;
            }
        }
    }
            
?>
