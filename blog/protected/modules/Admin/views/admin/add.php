<?php $show_validator = true;?>
<?php  $this->renderPartial('/default/header');?>

<script type="text/javascript">
	window.focus();
	var pc_hash = 'OS6NGf';
			window.onload = function(){
		var html_a = document.getElementsByTagName('a');
		var num = html_a.length;
		for(var i=0;i<num;i++) {
			var href = html_a[i].href;
			if(href && href.indexOf('javascript:') == -1) {
				if(href.indexOf('?') != -1) {
					html_a[i].href = href+'&pc_hash='+pc_hash;
				} else {
					html_a[i].href = href+'?pc_hash='+pc_hash;
				}
			}
		}

		var html_form = document.forms;
		var num = html_form.length;
		for(var i=0;i<num;i++) {
			var newNode = document.createElement("input");
			newNode.name = 'pc_hash';
			newNode.type = 'hidden';
			newNode.value = pc_hash;
			html_form[i].appendChild(newNode);
		}
	}
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?r=Admin/Admin/add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td width="80">用户名</td> 
<td><input value="<?php echo $info['username'];?>" type="text" name="info[username]"  class="input-text" id="username"></input></td>
</tr>
<tr>
<input name="userid" type="hidden" value="<?php echo $info['userid'];?>">
<td>密码</td> 
<td><input value="<?php echo $info['password'];?>" type="password" name="info[password]" class="input-text" id="password" value=""></input></td>
</tr>
<tr>
<td>确认密码</td> 
<td><input value="<?php echo $info['password'];?>" type="password" name="info[pwdconfirm]" class="input-text" id="pwdconfirm" value=""></input></td>
</tr>
<tr>
<td>E-mail</td>
<td>
<input value="<?php echo $info['email'];?>" type="text" name="info[email]" value="" class="input-text" id="email" size="30"></input>
</td>
</tr>
<tr>
<td>真实姓名</td>
<td>
<input value="<?php echo $info['realname'];?>" type="text" name="info[realname]" value="" class="input-text" id="realname"></input>
</td>
</tr>
<tr>
<td>所属角色</td>
<td>
<select name="info[roleid]">
<?php foreach($role as $v){?>
<option <?php if($v->roleid==$info['roleid']){?>selected="selected"<?php } ?> value="<?php echo $v->roleid; ?>" ><?php echo $v->rolename; ?></option>
<?php } ?>
</select>
</td>
</tr>
</table>
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="提交" class="button">
</form>
</div>
</div>
</body>
</html>

