<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 12:07:25
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_sitemap_html\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77475555c55d2dd329-29025807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80f2693deed04d9e7802cdf2ad06ddf96f936be4' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_sitemap_html\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77475555c55d2dd329-29025807',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isBackendEditMode' => 0,
    'trans' => 0,
    'category' => 0,
    'level' => 0,
    'article' => 0,
    'error' => 0,
    'tree' => 0,
    'first' => 0,
    'wrapper' => 0,
    'url' => 0,
    'name' => 0,
    'path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555c55d34dea5_96724386',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555c55d34dea5_96724386')) {function content_5555c55d34dea5_96724386($_smarty_tpl) {?><!-- content_sitemap_html -->

<?php if (true==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>
    <label class="content_type_label"><?php echo $_smarty_tpl->tpl_vars['trans']->value['headline'];?>
</label>
    <div class="sitemapdiv">
        <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['categoryLabel'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <label><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['categoryHintLabel'], ENT_QUOTES, 'UTF-8', true);?>
</label>
        <div><?php echo $_smarty_tpl->tpl_vars['category']->value;?>
</div>
    </div>
    <div class="sitemapdiv">
        <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['levelLabel'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <label><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['levelHintLabel'], ENT_QUOTES, 'UTF-8', true);?>
</label>
        <div><?php echo $_smarty_tpl->tpl_vars['level']->value;?>
</div>
    </div>
    <div class="sitemapdiv">
        <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['articleLabel'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <label><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['articleHintLabel'], ENT_QUOTES, 'UTF-8', true);?>
</label>
        <div><?php echo $_smarty_tpl->tpl_vars['article']->value;?>
</div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['error']->value) {?><p class="error"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['error']->value, ENT_QUOTES, 'UTF-8', true);?>
</p><?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['tree']->value) {?>
<ul<?php if ($_smarty_tpl->tpl_vars['first']->value==false) {?> class="sitemap"<?php }?>>
    <?php $_smarty_tpl->tpl_vars['first'] = new Smarty_variable(true, null, 0);?>
    
    <?php  $_smarty_tpl->tpl_vars['wrapper'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapper']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tree']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapper']->key => $_smarty_tpl->tpl_vars['wrapper']->value) {
$_smarty_tpl->tpl_vars['wrapper']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["idcat"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['idcat'], null, 0);?>
        <?php $_smarty_tpl->tpl_vars["url"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['item']->getLink(), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable($_smarty_tpl->tpl_vars['wrapper']->value['item']->get('name'), null, 0);?>
        <li>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>
            <?php echo $_smarty_tpl->getSubTemplate ("content_sitemap_html/template/get.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tree'=>$_smarty_tpl->tpl_vars['wrapper']->value['subcats'],'path'=>$_smarty_tpl->tpl_vars['path']->value,'ulId'=>''), 0);?>

        
        <?php if (0<count($_smarty_tpl->tpl_vars['wrapper']->value['articles'])) {?>
        	<ul>
	            <?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wrapper']->value['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
	            <li>
	                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->getLink(), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->get('title'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->get('title'), ENT_QUOTES, 'UTF-8', true);?>
</a>
	            </li>
	            <?php } ?>
            </ul>
        <?php }?>
        </li>
     <?php } ?>
</ul>
<?php }?>

<!-- /content_sitemap_html -->
<?php }} ?>
