<style type="text/css">
.oxidcms_product {
	background-color: #F4F4F4;
	width: 210px;
	height: auto;
	padding: 13px 0;
}

.button.red {
	margin: 0px 1px 0px 40px;
	height: 21px;
	line-height: 20px !important;
}
.prodtitle {
	margin: 3px 10px 4px 8px;
	font-size: 12px;
	font-weight: bold;
	color: #797979 !important;
}

.oxidcms_product p {
	color: #ADB763;
	margin: 3px 10px 4px 8px;
	font-weight: bold;
}
.prodthumb {
	margin: 1px 19px;
}

.prodthumb img{
	width: 170px;
}

.stock {
	padding: 5px 10px;
}

.stockFlag {
    background: url({$pluginPath}img/stockstatus.png) no-repeat 0px -44px;
	padding-left: 13px;
	font-size: 10px;
}

.lowStock {
    background-position: 0px 4px;
}

.notOnStock {
    background-position: 0px -20px;
}

</style>

{if $available}
<div class="oxidcms_product" style="{$styles}">
	<div class="prodthumb">
		<a href="{$link}" target="_blank">
			<img src="{$thumb}" alt="{$title|escape}" title="{$title|escape}" />
		</a>
	</div>
	<div class="proddata">
		<p class="prodtitle">{$title}</p>
		<p>{$price} {$currency->sign} pro Stück</p>
		<div class="stock">
			{$stockstatus}
		</div>
		{if $buyable == 1}
			<a target="_blank" class="button red" href="{$tobasketlink}">Jetzt bestellen &raquo;</a>
		{else}
			<a target="_blank" class="button red" href="{$link}">Mehr infos &raquo;</a>
		{/if}
	</div>	
</div>
{else}
<div class="oxidcms_product" style="{$styles}">
	<div class="prodthumb">
		<img src="{$thumb}" alt="{$title|escape}" title="{$title|escape}" />
	</div>
	<div class="proddata">
		<p class="prodtitle">{$title}</p>
		<p>{$price} {$currency->sign} pro Stück</p>
		<div class="stock">
			{$stockstatus}
		</div>
	</div>	
</div>
{/if}