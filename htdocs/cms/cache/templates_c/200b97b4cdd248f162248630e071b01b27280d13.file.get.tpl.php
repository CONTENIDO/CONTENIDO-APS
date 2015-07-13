<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:08
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_social_media\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23991550808ff90f320-94355855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '200b97b4cdd248f162248630e071b01b27280d13' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_social_media\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23991550808ff90f320-94355855',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550808ff9c2ab3_76721964',
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550808ff9c2ab3_76721964')) {function content_550808ff9c2ab3_76721964($_smarty_tpl) {?><!-- navigation_social_media -->

<ul class="social_media">
<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['rss'])) {?>
    <li class="rss"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['rss'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['facebook'])) {?>
    <li class="facebook"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['facebook'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['googleplus'])) {?>
    <li class="google"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['googleplus'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['twitter'])) {?>
    <li class="twitter"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['twitter'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['youtube'])) {?>
    <li class="youtube"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['youtube'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>

<?php if (0<strlen($_smarty_tpl->tpl_vars['url']->value['xing'])) {?>
    <li class="xing"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value['xing'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank"></a></li>
<?php }?>
</ul>

<!-- /navigation_social_media -->
<?php }} ?>
