<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:08
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_searchform_top\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22130550808fde03dc0-38770434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b14088b053ff130ac209d6de6f2fa47c669ebd7' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_searchform_top\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22130550808fde03dc0-38770434',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550808fde28077_52886248',
  'variables' => 
  array (
    'action' => 0,
    'method' => 0,
    'idart' => 0,
    'idlang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550808fde28077_52886248')) {function content_550808fde28077_52886248($_smarty_tpl) {?><!-- navigation_searchform_top/template/get.tpl -->

<?php if (0==strlen(trim($_smarty_tpl->tpl_vars['action']->value))) {?>
    <!--
        In order for the search form to be shown
        you have to define a search result page.
    -->
<?php } else { ?>
    <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['method']->value, ENT_QUOTES, 'UTF-8', true);?>
" id="navigation_searchform_top">
    <?php if ($_smarty_tpl->tpl_vars['idart']->value) {?><input type="hidden" name="idart" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['idart']->value, ENT_QUOTES, 'UTF-8', true);?>
" /><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['idlang']->value) {?><input type="hidden" name="idlang" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['idlang']->value, ENT_QUOTES, 'UTF-8', true);?>
" /><?php }?>
        <input type="text" id="search_term" name="search_term" />
    </form>
<?php }?>

<!-- /navigation_searchform_top/template/get.tpl --><?php }} ?>
