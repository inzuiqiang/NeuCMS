<?php
use common\YUrl;
use services\NavbarService;
require_once (APP_VIEW_PATH . DIRECTORY_SEPARATOR . 'common/header.php');
?>

<style type="text/css">
html {
	_overflow-y: scroll
}
</style>

<div class="common-form">
	<form name="myform" id="myform"
		action="<?php echo YUrl::createBackendUrl('', 'Page', 'navbarAdd'); ?>" method="post">
		<table width="100%" class="table_form contentWrap">
			<tr>
				<th width="120">上级菜单：</th>
				<td>
					<select id="parent_id" name="parent_id">
						<option value="0">作为一级菜单</option>
        				<?php foreach ($list as $nav) { ?>
        				<option value="<?=$nav['id']?>" <?php if ($nav['id'] == $parentid) echo 'selected'; ?>><?=$nav['name']?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>名称：</th>
				<td><input type="text" name="name" id="name" class="input-text"></td>
			</tr>
			<tr>
				<th>类型：</th>
				<td><select id="type" name="type">
					<option value="-1">非链接</option>
					<option value="<?=NavbarService::NAV_NEWS?>">文章</option>
					<option value="<?=NavbarService::NAV_NEWS_LIST?>">文章列表</option>
					<option value="<?=NavbarService::NAV_ATLAS?>">图集</option>
					<option value="<?=NavbarService::NAV_ATLAS_LIST?>">图集列表</option>
					<option value="<?=NavbarService::NAV_PAGE?>">页面</option>
					<option value="<?=NavbarService::NAV_URL?>">外部链接</option>
        		</select></td>
			</tr>
			<tr>
				<th id="content_name"></th>
				<td><input type="text" name="content" style="width: 250px;" class="input-text" /></td>
			</tr>
			<tr>
				<td width="100%" align="center" colspan="2"><input id="form_submit"
					type="button" name="dosubmit" class="btn_submit" value=" 提交 " /></td>
			</tr>
		</table>

	</form>

	<script type="text/javascript">
<!--

$(document).ready(function(){
	$('#form_submit').click(function(){
	    $.ajax({
	    	type: 'post',
            url: $('form').eq(0).attr('action'),
            dataType: 'json',
            data: $('form').eq(0).serialize(),
            success: function(data) {
                if (data.errcode == 0) {
                	top.dialog.getCurrent().close({"refresh" : 1});
                } else {
                	dialogTips(data.errmsg, 3);
                }
            }
	    });
	});
	$('#type').bind('change', function() {
		var active = $(this).find('option:selected');
		if (active.val() == -1) {
			$('#content_name').parent().hide();
		} else {
			$('#content_name').parent().show();
			if (active.val() == '<?=NavbarService::NAV_URL?>') {
				$('#content_name').html('链接地址：');
			} else {
				$('#content_name').html(active.html() + 'ID：');
			}
		}
	});
	$('#type').trigger('change');
});

//-->
</script>

	</body>
	</html>