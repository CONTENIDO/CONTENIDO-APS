<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:18
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_image\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1982755080904007cd9-39954918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04cc47d881650d943218a46adc165cc7254acf12' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_image\\template\\get.tpl',
      1 => 1431681189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1982755080904007cd9-39954918',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55080904025547_55511044',
  'variables' => 
  array (
    'label' => 0,
    'editor' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55080904025547_55511044')) {function content_55080904025547_55511044($_smarty_tpl) {?><!-- content_image -->

<?php if (0<strlen($_smarty_tpl->tpl_vars['label']->value)) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['editor']->value;?>


<?php if (null!=$_smarty_tpl->tpl_vars['image']->value) {?>
    <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->src, ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->alt, ENT_QUOTES, 'UTF-8', true);?>
" width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->width, ENT_QUOTES, 'UTF-8', true);?>
" height="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->height, ENT_QUOTES, 'UTF-8', true);?>
" />
<?php }?>

<!-- /content_image -->
<?php }} ?>
