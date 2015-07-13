<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:08
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\navigation_main\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22593550808fdf2d5a5-67710203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cf6b9ef38ed8558251146d4fb12e046ee80c76d' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\navigation_main\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22593550808fdf2d5a5-67710203',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_550808fe0c3115_56655197',
  'variables' => 
  array (
    'ulId' => 0,
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
<?php if ($_valid && !is_callable('content_550808fe0c3115_56655197')) {function content_550808fe0c3115_56655197($_smarty_tpl) {?><?php if (0<strlen($_smarty_tpl->tpl_vars['ulId']->value)) {?><!-- navigation_main/template/get.tpl --><?php }?>

<ul class="<?php echo $_smarty_tpl->tpl_vars['ulId']->value;?>
">

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
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["aClass"] = new Smarty_variable('', null, 0);?>
        <?php }?>
        <li>
            <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['aClass']->value, ENT_QUOTES, 'UTF-8', true);?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>
        <?php if (in_array($_smarty_tpl->tpl_vars['idcat']->value,$_smarty_tpl->tpl_vars['path']->value)) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("navigation_main/template/get.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tree'=>$_smarty_tpl->tpl_vars['wrapper']->value['subcats'],'path'=>$_smarty_tpl->tpl_vars['path']->value,'ulId'=>''), 0);?>

        <?php }?>
        </li>
     <?php } ?>
</ul>

<?php if (0<strlen($_smarty_tpl->tpl_vars['ulId']->value)) {?><!-- /navigation_main/template/get.tpl --><?php }?><?php }} ?>
