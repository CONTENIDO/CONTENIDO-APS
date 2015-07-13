<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-15 10:04:39
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\script_cookie_directive\template\get.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130145555a8970aef47-52403628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a7f75d9bb756bb2e5ee1e40555b052186f7a16e' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\script_cookie_directive\\template\\get.tpl',
      1 => 1431675088,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130145555a8970aef47-52403628',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'trans' => 0,
    'pageUrlDeny' => 0,
    'pageUrlAccept' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5555a8970d4495_31430585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5555a8970d4495_31430585')) {function content_5555a8970d4495_31430585($_smarty_tpl) {?><!-- script_cookie_directive/template/get.tpl -->

<div id="cookie_note">

    <h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
    <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['infoText'], ENT_QUOTES, 'UTF-8', true);?>
</p>
    <input type="hidden" id="accept" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['accept'], ENT_QUOTES, 'UTF-8', true);?>
" />
    <input type="hidden" id="decline" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trans']->value['decline'], ENT_QUOTES, 'UTF-8', true);?>
" />
    <input type="hidden" id="page_url_deny" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pageUrlDeny']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
    <input type="hidden" id="page_url_accept" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pageUrlAccept']->value, ENT_QUOTES, 'UTF-8', true);?>
" />

</div>

<!-- /script_cookie_directive/template/get.tpl --><?php }} ?>
