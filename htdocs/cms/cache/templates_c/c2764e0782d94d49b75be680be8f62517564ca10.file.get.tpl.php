<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:18
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_header_second\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1201355080903f0b509-49391841%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2764e0782d94d49b75be680be8f62517564ca10' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_header_second\\template\\get.tpl',
      1 => 1431681189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1201355080903f0b509-49391841',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55080903f1ea94_88833783',
  'variables' => 
  array (
    'label' => 0,
    'header' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55080903f1ea94_88833783')) {function content_55080903f1ea94_88833783($_smarty_tpl) {?><!-- content_header_second -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['header']->value)) {?>
    <h2><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</h2>
<?php }?>

<!-- /content_header_second -->
<?php }} ?>
