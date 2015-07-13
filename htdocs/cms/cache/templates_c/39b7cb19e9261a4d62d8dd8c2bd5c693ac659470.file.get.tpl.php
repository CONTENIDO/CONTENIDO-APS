<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:18
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_header_first\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77655080903ecb413-54072330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39b7cb19e9261a4d62d8dd8c2bd5c693ac659470' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_header_first\\template\\get.tpl',
      1 => 1431681189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77655080903ecb413-54072330',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55080903edd534_32607911',
  'variables' => 
  array (
    'label' => 0,
    'header' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55080903edd534_32607911')) {function content_55080903edd534_32607911($_smarty_tpl) {?><!-- content_header_first -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['header']->value)) {?>
    <h1><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</h1>
<?php }?>

<!-- /content_header_first -->
<?php }} ?>
