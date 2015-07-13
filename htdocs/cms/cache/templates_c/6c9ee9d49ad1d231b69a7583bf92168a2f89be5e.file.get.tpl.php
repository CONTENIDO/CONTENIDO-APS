<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:19
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_date\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:236125508090408f7e8-67633389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c9ee9d49ad1d231b69a7583bf92168a2f89be5e' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_date\\template\\get.tpl',
      1 => 1431681189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236125508090408f7e8-67633389',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5508090409ace8_87061352',
  'variables' => 
  array (
    'label' => 0,
    'date' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5508090409ace8_87061352')) {function content_5508090409ace8_87061352($_smarty_tpl) {?><!-- content_date -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['date']->value;?>


<!-- /content_date -->
<?php }} ?>
