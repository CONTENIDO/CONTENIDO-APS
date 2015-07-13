<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 12:06:40
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_teaser_config\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14056550809079a4597-71229189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5130abc85233d13c49db4e816f04e0908dfac31' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_teaser_config\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14056550809079a4597-71229189',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550809079f67f4_48738162',
  'variables' => 
  array (
    'isBackendEditMode' => 0,
    'label' => 0,
    'editor' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550809079f67f4_48738162')) {function content_550809079f67f4_48738162($_smarty_tpl) {?><?php if (true==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>
<!-- content_teaser_config -->

    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>

    <?php echo $_smarty_tpl->tpl_vars['editor']->value;?>


    <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['image']->value))) {?>
    <br /><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" alt=""/>
    <?php }?>

<!-- /content_teaser_config -->
<?php }?>
<?php }} ?>
