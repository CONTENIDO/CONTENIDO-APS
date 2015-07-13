<h2>{$LABEL_CONFIGURATION}</h2>

<form name="soap_access_data" action="{$form_action}" method="POST">
	<h3 style="color:red;margin:10px 0;">{$ERROR_MESSAGE}</h3>
	<h3 style="color:green;margin:10px 0;">{$SUCCESS_MESSAGE}</h3>
	<div class="oxidcms">
		<strong>{$LABEL_SHOP_USERNAME}:</strong>
		<input type="text" value="{$oxidcms_uname}" name="soap_username" />	
	</div>
	<div class="oxidcms">
		<strong>{$LABEL_SHOP_PASSWORD}:</strong>
		<input type="password" value="{$oxidcms_pw}" name="soap_password" />	
	</div>
	<div class="oxidcms">
		<strong>{$LABEL_SHOP_ID}:</strong>
		<input type="text" value="{$oxidcms_shopid}" name="soap_shopid" />	
	</div>
	<div class="oxidcms">
		<strong>{$LABEL_LANGUAGE_ID}:</strong>
		<input type="text" value="{$oxidcms_langid}" name="soap_langid" />	
	</div>
	<div id="uri_submit">
		<input type="image"  src="{$submit_btn}" />
	</div>
</form>


