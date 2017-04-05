<?php
    class Magic{
        function __construct() {}
        
        public function returnField($schema,$field,$belongTo){
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
                default:
                    //echo $schema[$field]['type'];
                    echo "\t\t\t\t\t echo \$this->Html->div('row',\$this->Form->input('{$field}',array('div'=>'col-xs-12','data-toggle'=>'tooltip','data-original-title'=>__('{$field}'),'title'=>__('{$field}'),'class'=>'form-control input-sm')),array('escape'=>false));\n";
                                 
                    break;
            }
        }

        public function callMethods($schema,$fields){
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
                            
                            default:
                                //echo $schema[$field]['type'];
                                         
                                break;
                        }
                    }
                }
            }
    }
