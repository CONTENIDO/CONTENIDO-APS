<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 11:14:19
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\content_map_google\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:270265555a89e2757e8-88174989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3454e8b2616114c9ad0232e17652c8b82b5f68fb' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\content_map_google\\template\\get.tpl',
      1 => 1431681190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '270265555a89e2757e8-88174989',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555a89e33af12_49525818',
  'variables' => 
  array (
    'isBackendEditMode' => 0,
    'trans' => 0,
    'header' => 0,
    'address' => 0,
    'lat' => 0,
    'lng' => 0,
    'markerTitle' => 0,
    'way' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555a89e33af12_49525818')) {function content_5555a89e33af12_49525818($_smarty_tpl) {?><!-- content_map_google -->

<?php if (true==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['header'], ENT_QUOTES, 'UTF-8', true);?>
</label>
<?php }?>
<div><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</div>



<?php if (false==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>
    <?php echo '<script'; ?>
 src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"><?php echo '</script'; ?>
>
    <div id="googleMap"></div>
<?php }?>

<?php if (true==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>
    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['address'], ENT_QUOTES, 'UTF-8', true);?>
</label>
    <div><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</div>
<?php } else { ?>
    <div id="address"><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</div>
<?php }?>


<?php if (true==$_smarty_tpl->tpl_vars['isBackendEditMode']->value) {?>

    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['latitude'], ENT_QUOTES, 'UTF-8', true);?>
</label>
    <div><?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
</div>

    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['longitude'], ENT_QUOTES, 'UTF-8', true);?>
</label>
    <div><?php echo $_smarty_tpl->tpl_vars['lng']->value;?>
</div>

    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['markerTitle'], ENT_QUOTES, 'UTF-8', true);?>
</label>
    <div><?php echo $_smarty_tpl->tpl_vars['markerTitle']->value;?>
</div>

    <label class="content_type_label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['wayDescription'], ENT_QUOTES, 'UTF-8', true);?>
</label>
    <div><?php echo $_smarty_tpl->tpl_vars['way']->value;?>
</div>

<?php } else { ?>

    <div id="clearFloat">
        <input type="hidden" id="lat" value="<?php echo $_smarty_tpl->tpl_vars['lat']->value;?>
" />
        <input type="hidden" id="lon" value="<?php echo $_smarty_tpl->tpl_vars['lng']->value;?>
" />
        <input type="hidden" id="markerTitle" value="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['markerTitle']->value);?>
" />
    </div>

    <input type="button" id="btndialog" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['wayDescription'], ENT_QUOTES, 'UTF-8', true);?>
"  class="button red"/>

    <div id="myDialog" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['way'];?>
">
        <div id="dialogContent"><?php echo $_smarty_tpl->tpl_vars['way']->value;?>
</div>
    </div>

<?php }?>

<!-- /content_map_google -->
<?php }} ?>
