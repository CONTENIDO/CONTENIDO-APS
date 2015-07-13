<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:15:23
         compiled from "C:\projects\workspace\conclaus-git\contenido\contenido\plugins\form_assistant\templates\template.right_bottom_data.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258545555b92bf3f1e7-87771829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02762b8ca52b762b80db1eecf75445c470b2919e' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\contenido\\plugins\\form_assistant\\templates\\template.right_bottom_data.tpl',
      1 => 1409900630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258545555b92bf3f1e7-87771829',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'trans' => 0,
    'form' => 0,
    'fields' => 0,
    'data' => 0,
    'exportUrl' => 0,
    'withTimestamp' => 0,
    'field' => 0,
    'columnName' => 0,
    'row' => 0,
    'columnData' => 0,
    'getFileUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555b92c14b662_69518883',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555b92c14b662_69518883')) {function content_5555b92c14b662_69518883($_smarty_tpl) {?><!-- form_assistant/templates/template.right_bottom_data.tpl -->


<fieldset>
    <legend><?php echo $_smarty_tpl->tpl_vars['trans']->value['legend'];?>
</legend>
<?php if (true!=$_smarty_tpl->tpl_vars['form']->value->isLoaded()) {?>
    <p><?php echo $_smarty_tpl->tpl_vars['trans']->value['pleaseSaveFirst'];?>
</p>
<?php } elseif (!is_array($_smarty_tpl->tpl_vars['fields']->value)) {?>
    
    <?php echo $_smarty_tpl->tpl_vars['fields']->value;?>

<?php } elseif (!is_array($_smarty_tpl->tpl_vars['data']->value)) {?>
    
    <?php echo $_smarty_tpl->tpl_vars['data']->value;?>

<?php } else { ?>
    
    <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['exportUrl']->value))) {?>
    <a class="form-data-export" href="<?php echo $_smarty_tpl->tpl_vars['exportUrl']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['trans']->value['export'];?>
</a>
    <?php }?>

    <!-- table cellpadding="0" class="generic" -->
    <table class="generic" width="97%" cellspacing="0" cellpadding="2" border="0">
        <tr>
            <th nowrap="nowrap">id</th>
    <?php if ($_smarty_tpl->tpl_vars['withTimestamp']->value) {?>
            <th nowrap="nowrap">timestamp</th>
    <?php }?>
    <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
        
        <?php if (null==$_smarty_tpl->tpl_vars['field']->value->getDbDataType()) {
continue 1;
}?>
        <?php $_smarty_tpl->tpl_vars['columnName'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value->get('column_name'), null, 0);?>
        <?php if (0==strlen($_smarty_tpl->tpl_vars['columnName']->value)) {?>
            <th nowrap="nowrap">&nbsp;</th>
        <?php } else { ?>
            <th nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['columnName']->value;?>
</th>
        <?php }?>
    <?php } ?>
        </tr>
    <?php if (0==count($_smarty_tpl->tpl_vars['data']->value)) {?>
        <tr>
            <td colspan="<?php echo count($_smarty_tpl->tpl_vars['fields']->value);?>
">no data</td>
        </tr>
    <?php } else { ?>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td nowrap="nowrap" class="bordercell"><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
</td>
        <?php if ($_smarty_tpl->tpl_vars['withTimestamp']->value) {?>
            <td nowrap="nowrap" class="bordercell"><?php echo $_smarty_tpl->tpl_vars['row']->value['pifa_timestamp'];?>
</td>
        <?php }?>
        <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
            
            <?php if (null==$_smarty_tpl->tpl_vars['field']->value->getDbDataType()) {
continue 1;
}?>
            <?php $_smarty_tpl->tpl_vars['columnName'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value->get('column_name'), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['columnData'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value[$_smarty_tpl->tpl_vars['columnName']->value], null, 0);?>
            <?php if (0==strlen($_smarty_tpl->tpl_vars['columnData']->value)) {?>
            <td nowrap="nowrap" class="bordercell">&nbsp;</td>
            <?php } elseif ('9'==$_smarty_tpl->tpl_vars['field']->value->get('field_type')) {?>
            
            <td nowrap="nowrap" class="bordercell"><a href="<?php echo $_smarty_tpl->tpl_vars['getFileUrl']->value;?>
&name=<?php echo $_smarty_tpl->tpl_vars['columnData']->value;?>
&file=<?php echo $_smarty_tpl->tpl_vars['form']->value->get('data_table');?>
_<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['columnName']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['columnData']->value;?>
</a></td>
            <?php } else { ?>
            <td nowrap="nowrap" class="bordercell"><?php echo $_smarty_tpl->tpl_vars['columnData']->value;?>
</td>
            <?php }?>
        <?php } ?>
        </tr>
        <?php } ?>
    <?php }?>
    </table>
<?php }?>
</fieldset>

<!-- /form_assistant/templates/template.right_bottom_data.tpl -->
<?php }} ?>
