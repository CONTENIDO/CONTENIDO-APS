<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-17 11:59:24
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_fb_embeddedpost\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258515508090cc552f1-66978160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26b72f4a74e4d2312be5a120a4f95953cf046950' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_fb_embeddedpost\\template\\get.tpl',
      1 => 1426515048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258515508090cc552f1-66978160',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'label' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5508090cc64767_35598099',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5508090cc64767_35598099')) {function content_5508090cc64767_35598099($_smarty_tpl) {?><!-- content_fb_embeddedpost/template/get.tpl -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>


<!-- /content_fb_embeddedpost/template/get.tpl -->
<?php }} ?>
