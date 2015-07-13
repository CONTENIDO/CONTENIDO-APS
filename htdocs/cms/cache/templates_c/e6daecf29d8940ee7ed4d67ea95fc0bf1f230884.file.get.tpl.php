<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:18
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_breadcrumb\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1548055080903d72227-76761291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6daecf29d8940ee7ed4d67ea95fc0bf1f230884' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_breadcrumb\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1548055080903d72227-76761291',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55080903daec57_84425780',
  'variables' => 
  array (
    'breadcrumb' => 0,
    'label_breadcrumb' => 0,
    'i' => 0,
    'category' => 0,
    'headline' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55080903daec57_84425780')) {function content_55080903daec57_84425780($_smarty_tpl) {?><!-- navigation_breadcrumb/template/get.tpl -->

<?php if (count($_smarty_tpl->tpl_vars['breadcrumb']->value)>0) {?>
<ul>
    <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label_breadcrumb']->value, ENT_QUOTES, 'UTF-8', true);?>
:</li>
    <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['breadcrumb']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['category']->key;
?>
        <?php if ($_smarty_tpl->tpl_vars['i']->value==0) {?>
        <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->getLink(), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->get('name'), ENT_QUOTES, 'UTF-8', true);?>
</a></li>
        <?php } else { ?>
        <li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->getLink(), ENT_QUOTES, 'UTF-8', true);?>
">- <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->get('name'), ENT_QUOTES, 'UTF-8', true);?>
</a></li>
        <?php }?>
    <?php } ?>
    <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['headline']->value))) {?>
        <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['headline']->value, ENT_QUOTES, 'UTF-8', true);?>
</li>
    <?php }?>
</ul>
<?php }?>

<!-- /navigation_breadcrumb/template/get.tpl -->
<?php }} ?>
