<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:19
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_text\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:267365508090405d107-08124946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9afe5108c599014394f4b0da2d409b3a3cdeedbf' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_text\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267365508090405d107-08124946',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55080904068877_54508038',
  'variables' => 
  array (
    'label' => 0,
    'text' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55080904068877_54508038')) {function content_55080904068877_54508038($_smarty_tpl) {?><!-- content_text -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['text']->value;?>


<!-- /content_text -->
<?php }} ?>
