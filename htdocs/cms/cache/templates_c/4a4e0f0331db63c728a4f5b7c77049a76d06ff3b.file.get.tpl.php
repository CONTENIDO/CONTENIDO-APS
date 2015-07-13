<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:07
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_top\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5194550808fdd27d59-81635813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a4e0f0331db63c728a4f5b7c77049a76d06ff3b' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_top\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5194550808fdd27d59-81635813',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550808fdd72709_23033203',
  'variables' => 
  array (
    'tree' => 0,
    'wrapper' => 0,
    'idcat' => 0,
    'path' => 0,
    'aClass' => 0,
    'url' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550808fdd72709_23033203')) {function content_550808fdd72709_23033203($_smarty_tpl) {?><!-- navigation_top/template/get.tpl -->

<ul>
    <?php  $_smarty_tpl->tpl_vars['wrapper'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapper']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tree']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapper']->key => $_smarty_tpl->tpl_vars['wrapper']->value) {
$_smarty_tpl->tpl_vars['wrapper']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["idcat"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['idcat'], null, 0);?>
        <?php $_smarty_tpl->tpl_vars["url"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['item']->getLink(), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['item']->get('name'), null, 0);?>
        <?php if (in_array($_smarty_tpl->tpl_vars['idcat']->value,$_smarty_tpl->tpl_vars['path']->value)) {?>
            <?php $_smarty_tpl->tpl_vars["aClass"] = new Smarty_variable('active', null, 0);?>
        <?php }?>
        <li>
            <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['aClass']->value, ENT_QUOTES, 'UTF-8', true);?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>
        <?php if (in_array($_smarty_tpl->tpl_vars['idcat']->value,$_smarty_tpl->tpl_vars['path']->value)) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("navigation_top/template/get.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tree'=>$_smarty_tpl->tpl_vars['wrapper']->value['subcats'],'path'=>$_smarty_tpl->tpl_vars['path']->value), 0);?>

        <?php }?>
        </li>
     <?php } ?>
</ul>

<!-- /navigation_top/template/get.tpl --><?php }} ?>
