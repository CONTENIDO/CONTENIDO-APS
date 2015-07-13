<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:57
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\templates\cms_pifaform_default_mail_system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34975555b9115c78e8-50113374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae3c8518a2cd2826ac53713ac11c46df58a9f75f' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\templates\\cms_pifaform_default_mail_system.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34975555b9115c78e8-50113374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'values' => 0,
    'key' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555b911608454_78115749',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555b911608454_78115749')) {function content_5555b911608454_78115749($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['key']->_loop = false;
 $_from = array_keys($_smarty_tpl->tpl_vars['values']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['key']->key => $_smarty_tpl->tpl_vars['key']->value) {
$_smarty_tpl->tpl_vars['key']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
            <?php if (is_array($_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['key']->value])) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['key']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
echo $_smarty_tpl->tpl_vars['item']->value;?>
 <?php }
} else {
echo $_smarty_tpl->tpl_vars['values']->value[$_smarty_tpl->tpl_vars['key']->value];
}?>

<?php } ?>
<?php }} ?>
