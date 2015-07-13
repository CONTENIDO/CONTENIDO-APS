<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 10:42:20
         compiled from "C:\projects\workspace\conclaus-git\contenido\contenido\plugins\form_assistant\templates\template.right_bottom_fields.tpl" */ ?>
<?php /*%%SmartyHeaderCode:255245555b16cc41e09-85589491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e95f2b5131e28b51edfede8be011b20aadbc420' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\contenido\\plugins\\form_assistant\\templates\\template.right_bottom_fields.tpl',
      1 => 1409900630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255245555b16cc41e09-85589491',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email_notification' => 0,
    'idform' => 0,
    'trans' => 0,
    'ajaxParams' => 0,
    'sortParams' => 0,
    'fieldTypes' => 0,
    'dragParams' => 0,
    'fieldTypeId' => 0,
    'fieldTypeName' => 0,
    'fields' => 0,
    'partialFieldRow' => 0,
    'field' => 0,
    'editField' => 0,
    'deleteField' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555b16ccda395_70968078',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555b16ccda395_70968078')) {function content_5555b16ccda395_70968078($_smarty_tpl) {?><!-- form_assistant/templates/template.right_bottom_fields.tpl -->



<?php if ($_smarty_tpl->tpl_vars['email_notification']->value) {
echo $_smarty_tpl->tpl_vars['email_notification']->value;?>
<br /><?php }?>

<?php if (null==$_smarty_tpl->tpl_vars['idform']->value) {?>

<p><?php echo $_smarty_tpl->tpl_vars['trans']->value['pleaseSaveFirst'];?>
</p>

<?php } else { ?>


<input type="hidden" id="ajaxParams" value="<?php echo $_smarty_tpl->tpl_vars['ajaxParams']->value;?>
" />


<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['sortParams']->value))) {?>
<input type="hidden" id="sortParams" value="<?php echo $_smarty_tpl->tpl_vars['sortParams']->value;?>
">
<?php }?>


<fieldset id="field-buttons">
    <legend><?php echo $_smarty_tpl->tpl_vars['trans']->value['legend'];?>
</legend>
    <ul>
        <?php  $_smarty_tpl->tpl_vars['fieldTypeName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fieldTypeName']->_loop = false;
 $_smarty_tpl->tpl_vars['fieldTypeId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fieldTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fieldTypeName']->key => $_smarty_tpl->tpl_vars['fieldTypeName']->value) {
$_smarty_tpl->tpl_vars['fieldTypeName']->_loop = true;
 $_smarty_tpl->tpl_vars['fieldTypeId']->value = $_smarty_tpl->tpl_vars['fieldTypeName']->key;
?>
        <li>
        <a
            
            <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['dragParams']->value))) {?>
            class="pifa-field-type-<?php echo $_smarty_tpl->tpl_vars['fieldTypeId']->value;?>
 img-draggable"
            href="<?php echo $_smarty_tpl->tpl_vars['dragParams']->value;?>
&field_type=<?php echo $_smarty_tpl->tpl_vars['fieldTypeId']->value;?>
"
            <?php } else { ?>
            class="pifa-field-type-<?php echo $_smarty_tpl->tpl_vars['fieldTypeId']->value;?>
"
            <?php }?>
            title="<?php echo $_smarty_tpl->tpl_vars['fieldTypeName']->value;?>
"
        >&nbsp;</a></li>
        <?php } ?>
    </ul>
</fieldset>


<fieldset id="field-list-field">
    <ul id="pifa-form-field-list"
    <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['sortParams']->value))) {?>
    class="sortable"
    <?php }?>>
        
        <?php if (null!=$_smarty_tpl->tpl_vars['fields']->value) {?>
            <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
                <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['partialFieldRow']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('field'=>$_smarty_tpl->tpl_vars['field']->value,'editField'=>$_smarty_tpl->tpl_vars['editField']->value,'deleteField'=>$_smarty_tpl->tpl_vars['deleteField']->value,'trans'=>$_smarty_tpl->tpl_vars['trans']->value), 0);?>

            <?php } ?>
        <?php }?>
    </ul>
</fieldset>


<form id="pifa-form-field-dialog" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['dialogTitle'];?>
"></form>

<?php }?>

<!-- /form_assistant/templates/template.right_bottom_fields.tpl -->
<?php }} ?>
