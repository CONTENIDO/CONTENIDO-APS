<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 10:42:28
         compiled from "C:\projects\workspace\conclaus-git\contenido\contenido\plugins\form_assistant\templates\template.ajax_field_row.tpl" */ ?>
<?php /*%%SmartyHeaderCode:217205555b1742f02c0-27747314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a28a71b6e658c4d58e02aebc11ae6b4e381d9c8d' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\contenido\\plugins\\form_assistant\\templates\\template.ajax_field_row.tpl',
      1 => 1409900630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '217205555b1742f02c0-27747314',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'field' => 0,
    'trans' => 0,
    'editField' => 0,
    'deleteField' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555b174403bf2_88200109',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555b174403bf2_88200109')) {function content_5555b174403bf2_88200109($_smarty_tpl) {?><!-- form_assistant/templates/template.ajax_field_row.tpl -->

<li id= "<?php echo $_smarty_tpl->tpl_vars['field']->value->get('idfield');?>
" title="idfield <?php echo $_smarty_tpl->tpl_vars['field']->value->get('idfield');?>
">
    <div class="descr-icon pifa-icon pifa-icon-<?php echo $_smarty_tpl->tpl_vars['field']->value->get('field_type');?>
"></div>
    <div class="textMiddle">
        <div class="li-label-name">
            <?php if (0==$_smarty_tpl->tpl_vars['field']->value->get('display_label')) {?><i><?php }?>
            <?php echo $_smarty_tpl->tpl_vars['field']->value->get('label');?>

            <?php if (0==$_smarty_tpl->tpl_vars['field']->value->get('display_label')) {?></i><?php }?>
        </div>
        <div class="li-column-name">
            <?php echo $_smarty_tpl->tpl_vars['field']->value->get('column_name');?>

        </div>
    </div>
    <div class="edit">
        <?php if (1==$_smarty_tpl->tpl_vars['field']->value->get('obligatory')) {?>
        
        <img alt="<?php echo $_smarty_tpl->tpl_vars['trans']->value['obligatory'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['obligatory'];?>
" src="images/reminder/prio_high.gif" />
        <?php }?>
        <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['editField']->value))) {?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['editField']->value;?>
&amp;idfield=<?php echo $_smarty_tpl->tpl_vars['field']->value->get('idfield');?>
" class="pifa-icon-edit-field" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
">
            <img alt="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" src="images/editieren.gif" />
        </a>
        <?php } else { ?>
        <img alt="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" src="images/editieren_off.gif" />
        <?php }?>
        <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['deleteField']->value))) {?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['deleteField']->value;?>
&amp;idfield=<?php echo $_smarty_tpl->tpl_vars['field']->value->get('idfield');?>
" class="pifa-icon-delete-field " title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['delete'];?>
">
            <img alt="<?php echo $_smarty_tpl->tpl_vars['trans']->value['delete'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['delete'];?>
" src="images/delete.gif" />
        </a>
        <?php } else { ?>
        <img alt="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['trans']->value['edit'];?>
" src="images/delete_inact.gif" />
        <?php }?>
    </div>
</li>

<!-- /form_assistant/templates/template.ajax_field_row.tpl -->
<?php }} ?>
