<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-17 11:59:24
         compiled from "C:\projects\workspace\conclaus-git\contenido\cms\data\modules\script_fb_sdk\template\jQuery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245945508090cf07058-45189148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8fec4991144ba4bf48b6ca4cf4c07a40368fdbd' => 
    array (
      0 => 'C:\\projects\\workspace\\conclaus-git\\contenido\\cms\\data\\modules\\script_fb_sdk\\template\\jQuery.tpl',
      1 => 1426515049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245945508090cf07058-45189148',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'locale' => 0,
    'channelUrl' => 0,
    'cookie' => 0,
    'kidDirectedSite' => 0,
    'status' => 0,
    'appId' => 0,
    'xfbml' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5508090d05e032_66332195',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5508090d05e032_66332195')) {function content_5508090d05e032_66332195($_smarty_tpl) {?><!-- script_fb_sdk/template/jQuery.tpl -->


<div id="fb-root"></div>

<?php echo '<script'; ?>
 type="text/javascript">

$(document).ready(function() {
    $.ajaxSetup({
        cache: true
    });
    $.getScript('//connect.facebook.net/<?php echo strtr($_smarty_tpl->tpl_vars['locale']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
/all.js', function() {
        FB.init({
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['channelUrl']->value))) {?>
            channelUrl : '<?php echo strtr($_smarty_tpl->tpl_vars['channelUrl']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
<?php }?>
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['cookie']->value))) {?>
            cookie : <?php echo strtr($_smarty_tpl->tpl_vars['cookie']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
,
<?php }?>
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['kidDirectedSite']->value))) {?>
            kidDirectedSite : <?php echo strtr($_smarty_tpl->tpl_vars['kidDirectedSite']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
,
<?php }?>
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['status']->value))) {?>
            status : <?php echo strtr($_smarty_tpl->tpl_vars['status']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
,
<?php }?>
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['appId']->value))) {?>
            appId : '<?php echo strtr($_smarty_tpl->tpl_vars['appId']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'
<?php }?>
<?php if (0<strlen(trim($_smarty_tpl->tpl_vars['xfbml']->value))) {?>
            xfbml : <?php echo strtr($_smarty_tpl->tpl_vars['xfbml']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>

<?php } else { ?>
            xfbml : false
<?php }?>
        });
        //$('#loginbutton, #feedbutton').removeAttr('disabled');
        //FB.getLoginStatus(updateStatusCallback);
    });
});

<?php echo '</script'; ?>
>

<!-- /script_fb_sdk/template/jQuery.tpl -->
<?php }} ?>
