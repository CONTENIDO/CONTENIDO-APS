<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-17 11:59:17
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_download_list\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3104255080905334323-77256074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95c86d98dba25379b3c2bafa03b04f12f042efb6' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_download_list\\template\\get.tpl',
      1 => 1426515048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3104255080905334323-77256074',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'label' => 0,
    'filelist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5508090538b530_66680788',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5508090538b530_66680788')) {function content_5508090538b530_66680788($_smarty_tpl) {?><!-- content_download_list -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['filelist']->value;?>


<!-- /content_download_list -->
<?php }} ?>
