<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:08
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_bottom\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2610550808ff844740-39410506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '586d13b4bac5fc61b823d67da1ba7e78d2fe7247' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_bottom\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2610550808ff844740-39410506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550808ff851756_92967254',
  'variables' => 
  array (
    'articles' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550808ff851756_92967254')) {function content_550808ff851756_92967254($_smarty_tpl) {?><ul class="navigation">
<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
    <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</a></li>
<?php } ?>
</ul>
<?php }} ?>
