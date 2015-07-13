<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 10:04:30
         compiled from "C:\projects\workspace\conclaus-git\contenido\contenido\plugins\form_assistant\templates\template.right_bottom_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178795555a88e61d6d3-13917050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '880d0ef4f2a6b78719744b8ed7cac1e40948a42d' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\contenido\\plugins\\form_assistant\\templates\\template.right_bottom_form.tpl',
      1 => 1409900630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178795555a88e61d6d3-13917050',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formAction' => 0,
    'idform' => 0,
    'trans' => 0,
    'nameValue' => 0,
    'dataTableValue' => 0,
    'methodValue' => 0,
    'hasWithTimestamp' => 0,
    'withTimestampValue' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555a88e6d6687_72121678',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555a88e6d6687_72121678')) {function content_5555a88e6d6687_72121678($_smarty_tpl) {?><!-- form_assistant/templates/template.right_bottom_form.tpl -->


<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>
<form id="pifa-form" action="<?php echo $_smarty_tpl->tpl_vars['formAction']->value;?>
" method="post">
<?php } else { ?>
<form id="pifa-form">
<?php }?>

    <input type="hidden" name="idform" value="<?php echo $_smarty_tpl->tpl_vars['idform']->value;?>
">

    <fieldset>

        <legend><?php echo $_smarty_tpl->tpl_vars['trans']->value['legend'];?>
</legend>

        <div class="field-type">
            <label for="name"><?php echo $_smarty_tpl->tpl_vars['trans']->value['name'];?>
</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['nameValue']->value, ENT_QUOTES, 'UTF-8', true);?>
"
                <?php if (0==strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>disabled="disabled"<?php }?> />
        </div>

        <div class="field-type">
            <label for="data_table"><?php echo $_smarty_tpl->tpl_vars['trans']->value['dataTable'];?>
</label>
            <input type="text" id="data_table" name="data_table" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dataTableValue']->value, ENT_QUOTES, 'UTF-8', true);?>
" maxlength="64"
                <?php if (0==strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>disabled="disabled"<?php }?> />
        </div>

        <div class="field-type">
            <label for="request_method"><?php echo $_smarty_tpl->tpl_vars['trans']->value['method'];?>
</label>
            <select id="method" name="method" <?php if (0==strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>disabled="disabled"<?php }?>>
                <option value=""><?php echo $_smarty_tpl->tpl_vars['trans']->value['pleaseChoose'];?>
</option>
                <option value="GET"<?php if ("GET"==strtoupper($_smarty_tpl->tpl_vars['methodValue']->value)) {?> selected="selected"<?php }?>>GET</option>
                <option value="POST"<?php if ("POST"==strtoupper($_smarty_tpl->tpl_vars['methodValue']->value)) {?> selected="selected"<?php }?>>POST</option>
            </select>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['hasWithTimestamp']->value) {?>
        <div class="field-type">
            <label for="with_timestamp"><?php echo $_smarty_tpl->tpl_vars['trans']->value['withTimestamp'];?>
</label>
            <input type="checkbox" id="with_timestamp" name="with_timestamp"
                <?php if ($_smarty_tpl->tpl_vars['withTimestampValue']->value) {?>checked="checked"<?php }?>
                <?php if (0==strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>disabled="disabled"<?php }?>/>
        </div>
        <?php }?>

        <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['formAction']->value))) {?>
        <input type="image" id="image-new-form" src="images/but_ok.gif" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['saveForm'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['saveForm'], ENT_QUOTES, 'UTF-8', true);?>
" />
        <?php } else { ?>
        <img id="image-new-form" src="images/but_ok_off.gif" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['saveForm'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['saveForm'], ENT_QUOTES, 'UTF-8', true);?>
" />
        <?php }?>

    </fieldset>

</form>

<!-- /form_assistant/templates/template.right_bottom_form.tpl -->
<?php }} ?>
