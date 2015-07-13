<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 10:42:22
         compiled from "C:\projects\workspace\conclaus-git\contenido\contenido\plugins\form_assistant\templates\template.ajax_field_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117015555b16edc78a9-42091474%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5247f26359d58644aab3388add526e0d32771de' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\contenido\\plugins\\form_assistant\\templates\\template.ajax_field_form.tpl',
      1 => 1424330586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117015555b16edc78a9-42091474',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'contenido' => 0,
    'action' => 0,
    'idform' => 0,
    'field' => 0,
    'trans' => 0,
    'options' => 0,
    'partialOptionRow' => 0,
    'option' => 0,
    'hrefAddOption' => 0,
    'optionClasses' => 0,
    'optionClass' => 0,
    'cssClasses' => 0,
    'cssClass' => 0,
    'myClasses' => 0,
    'thisClass' => 0,
    'selected' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555b16f0ab5e5_57499815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555b16f0ab5e5_57499815')) {function content_5555b16f0ab5e5_57499815($_smarty_tpl) {?><!-- form_assistant/templates/template.ajax_field_form.tpl -->

<input type="hidden" id="area" name="area" value="form_ajax" />
<input type="hidden" id="frame" name="frame" value="4" />

<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['contenido']->value))) {?>
<input type="hidden" id="contenido" name="contenido" value="<?php echo $_smarty_tpl->tpl_vars['contenido']->value;?>
" />
<?php }?>

<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['action']->value))) {?>
<input type="hidden" id="action" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
<?php }?>

<input type="hidden" id="idform" name="idform" value="<?php echo $_smarty_tpl->tpl_vars['idform']->value;?>
" />
<input type="hidden" id="idfield" name="idfield" value="<?php echo $_smarty_tpl->tpl_vars['field']->value->get('idfield');?>
" />
<input type="hidden" id="field_type" name="field_type" value="<?php echo $_smarty_tpl->tpl_vars['field']->value->get('field_type');?>
" />
<input type="hidden" id="field_rank" name="field_rank" value="<?php echo $_smarty_tpl->tpl_vars['field']->value->get('field_rank');?>
" />

<p class="pseudo-legend"><?php echo $_smarty_tpl->tpl_vars['trans']->value['general'];?>
</p>

<div class="pseudo-fieldset">

    
    
    <div class="field-type-dialog">
        <label><?php echo $_smarty_tpl->tpl_vars['trans']->value['fieldType'];?>
</label>
        <span id="field-type-text"><?php echo $_smarty_tpl->tpl_vars['field']->value->getMyFieldTypeName();?>
</span>
    </div>
    

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('label')) {?>
    <div class="label">
        <label for="label"><?php echo $_smarty_tpl->tpl_vars['trans']->value['label'];?>
</label>
        <input type="text" id="label" name="label" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('label'), ENT_QUOTES, 'UTF-8', true);?>
" maxlength="1023" />
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('label')) {?>
    <div class="display_label">
        <label for="display_label"><?php echo $_smarty_tpl->tpl_vars['trans']->value['displayLabel'];?>
</label>
        <input type="checkbox" id="display_label" name="display_label" <?php if (1==$_smarty_tpl->tpl_vars['field']->value->get('display_label')) {?> checked="checked"<?php }?>/>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('uri')) {?>
    <div class="uri">
        <label for="uri"><?php echo $_smarty_tpl->tpl_vars['trans']->value['uri'];?>
</label>
        <input type="text" id="uri" name="uri" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('uri'), ENT_QUOTES, 'UTF-8', true);?>
" maxlength="1023" />
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('obligatory')) {?>
    <div class="req-input">
        <label for="obligatory"><?php echo $_smarty_tpl->tpl_vars['trans']->value['obligatory'];?>
</label>
        <input type="checkbox" name="obligatory" id="obligatory" <?php if (1==$_smarty_tpl->tpl_vars['field']->value->get('obligatory')) {?> checked="checked"<?php }?>/>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('default_value')) {?>
    <div class="default_value">
        <label for="default_value"><?php echo $_smarty_tpl->tpl_vars['trans']->value['defaultValue'];?>
</label>
        <input type="text" id="default_value" name="default_value" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('default_value'), ENT_QUOTES, 'UTF-8', true);?>
" maxlength="1023" />
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('rule')) {?>
    <div class="rule">
        <label for="rule"><?php echo $_smarty_tpl->tpl_vars['trans']->value['rule'];?>
</label>
        <input type="text" id="rule" name="rule" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('rule'), ENT_QUOTES, 'UTF-8', true);?>
" maxlength="1023" />
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('error_message')) {?>
    <div class="error_message">
        <label for="error_message"><?php echo $_smarty_tpl->tpl_vars['trans']->value['errorMessage'];?>
</label>
        <textarea id="error_message" name="error_message" rows="5" cols="30"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('error_message'), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['field']->value->showField('help_text')) {?>
    <div class="help_text">
        <label for="help_text"><?php echo $_smarty_tpl->tpl_vars['trans']->value['helpText'];?>
</label>
        <!--textarea id="help_text" name="help_text"><?php echo $_smarty_tpl->tpl_vars['field']->value->get('help_text');?>
</textarea-->
        <textarea id="help_text" name="help_text" rows="5" cols="30"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value->get('help_text'), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
    </div>
    <?php }?>

</div>

<?php if ($_smarty_tpl->tpl_vars['field']->value->showField('column_name')) {?>
<p class="pseudo-legend"><?php echo $_smarty_tpl->tpl_vars['trans']->value['database'];?>
</p>

<div class="pseudo-fieldset">
    <label for="column_name"><?php echo $_smarty_tpl->tpl_vars['trans']->value['columnName'];?>
</label>
    <input type="text" id="column_name" name="column_name" value="<?php echo $_smarty_tpl->tpl_vars['field']->value->get('column_name');?>
" maxlength="64" />
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['field']->value->showField('option_labels')||$_smarty_tpl->tpl_vars['field']->value->showField('option_values')) {?>
<p class="pseudo-legend"><?php echo $_smarty_tpl->tpl_vars['trans']->value['options'];?>
</p>

<div class="pseudo-fieldset">

    <div id="options-list">
    <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value->getOptions(), null, 0);?>

    <?php if (null!=$_smarty_tpl->tpl_vars['options']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['option']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['option']['iteration']++;
?>
            <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['partialOptionRow']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>$_smarty_tpl->tpl_vars['option']->value,'i'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['option']['iteration'],'trans'=>$_smarty_tpl->tpl_vars['trans']->value), 0);?>

        <?php } ?>
    <?php }?>
    </div>

    
    <?php if (0<strlen(trim($_smarty_tpl->tpl_vars['hrefAddOption']->value))) {?>
    <div id="add-options-div">
        <a id="icon-add-option" href="<?php echo $_smarty_tpl->tpl_vars['hrefAddOption']->value;?>
">
            <img src="images/but_art_new.gif" />
            <span id="txt-add-options"><?php echo $_smarty_tpl->tpl_vars['trans']->value['addOption'];?>
</span>
        </a>
    </div>
    <?php }?>

    <?php if (null!=$_smarty_tpl->tpl_vars['optionClasses']->value) {?>
    <label for="option_class"><?php echo $_smarty_tpl->tpl_vars['trans']->value['externalOptionsDatasource'];?>
</label>
    <select id="option_class" name="option_class">
        <?php  $_smarty_tpl->tpl_vars['optionClass'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['optionClass']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['optionClasses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['optionClass']->key => $_smarty_tpl->tpl_vars['optionClass']->value) {
$_smarty_tpl->tpl_vars['optionClass']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['optionClass']->value['value'];?>
"<?php if ($_smarty_tpl->tpl_vars['optionClass']->value['value']==$_smarty_tpl->tpl_vars['field']->value->get('option_class')) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['optionClass']->value['label'];?>
</option>
        <?php } ?>
    </select>
    <?php }?>

</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['field']->value->showField('css_class')) {?>
<p class="pseudo-legend"><?php echo $_smarty_tpl->tpl_vars['trans']->value['styling'];?>
</p>

<div class="pseudo-fieldset">
    <label for="css_class"><?php echo $_smarty_tpl->tpl_vars['trans']->value['cssClass'];?>
</label>
    <?php $_smarty_tpl->tpl_vars["myClasses"] = new Smarty_variable((",").($_smarty_tpl->tpl_vars['field']->value->get('css_class')).(","), null, 0);?>
    <select id="css_class" name="css_class[]" multiple="multiple" size="5">
        <?php  $_smarty_tpl->tpl_vars['cssClass'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cssClass']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cssClasses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cssClass']->key => $_smarty_tpl->tpl_vars['cssClass']->value) {
$_smarty_tpl->tpl_vars['cssClass']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["thisClass"] = new Smarty_variable((",").($_smarty_tpl->tpl_vars['cssClass']->value).(","), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["selected"] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['myClasses']->value,$_smarty_tpl->tpl_vars['thisClass']->value), null, 0);?>
        <option<?php if (false!==$_smarty_tpl->tpl_vars['selected']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cssClass']->value;?>
</option>
        <?php } ?>
    </select>
</div>
<?php }?>



<!-- /form_assistant/templates/template.ajax_field_form.tpl -->
<?php }} ?>
