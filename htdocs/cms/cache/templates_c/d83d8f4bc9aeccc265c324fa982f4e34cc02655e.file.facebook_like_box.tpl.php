<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-17 11:59:24
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_socialmedia_facebook\template\facebook_like_box.tpl" */ ?>
<?php /*%%SmartyHeaderCode:223455508090cb5b428-25679619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd83d8f4bc9aeccc265c324fa982f4e34cc02655e' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_socialmedia_facebook\\template\\facebook_like_box.tpl',
      1 => 1426515048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223455508090cb5b428-25679619',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LOCALE' => 0,
    'URL' => 0,
    'WIDTH' => 0,
    'SHOW_FACES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5508090cbe7555_70344461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5508090cbe7555_70344461')) {function content_5508090cbe7555_70344461($_smarty_tpl) {?><div id="fb-root"></div><?php echo '<script'; ?>
 src="http://connect.facebook.net/<?php echo $_smarty_tpl->tpl_vars['LOCALE']->value;?>
/all.js#xfbml=1"><?php echo '</script'; ?>
><fb:like-box href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['URL']->value, ENT_QUOTES, 'UTF-8', true);?>
" width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['WIDTH']->value, ENT_QUOTES, 'UTF-8', true);?>
" show_faces="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SHOW_FACES']->value, ENT_QUOTES, 'UTF-8', true);?>
" border_color="" locale="en_US" stream="false" header="false"></fb:like-box><?php }} ?>
