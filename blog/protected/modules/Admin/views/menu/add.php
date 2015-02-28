<?php  $this->renderPartial('/default/header');?>
<?php if(!isset($show_header)) { ?>
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    <?php if(isset($big_menu)) { echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';} else {$big_menu = '';} ?>
    <?php echo admin::submenu($_GET['menuid'],$big_menu); ?>
    </div>
</div>
<?php } ?>
<style type="text/css">
	html{_overflow-y:scroll}
</style>


<div class="common-form">
<form name="myform" id="myform" action="?r=Admin/Menu/add&menuid=<?php echo $_GET['menuid'];?>&id=<?php echo $_GET['id'];?>" method="post">

<input type="hidden" vaule="<?php echo $info['id'];?>" name="id">
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="200">上级菜单：</th>
        <td>
        <select name="info[parentid]" >
        <?php echo $tree;?>
        </select>
        </td>
      </tr>
      <tr>
        <th>对应的中文语言名称：</th>
        <td><input value="<?php echo $info['name']; ?>" type="text" name="info[name]" id="name" class="input-text" ></td>
      </tr>
	<tr>
        <th>模块名：</th>
        <td><input value="<?php echo $info['m']; ?>" type="text" name="info[m]" id="m" class="input-text" ></td>
      </tr>
	<tr>
        <th>文件名：</th>
        <td><input value="<?php echo $info['c']; ?>" type="text" name="info[c]" id="c" class="input-text" ></td>
      </tr>
	<tr>
        <th>方法名：</th>
        <td><input value="<?php echo $info['a']; ?>" type="text" name="info[a]" id="a" class="input-text" > <span id="a_tip"></span>通过AJAX 传递的方法，请使用 ajax_开头，方法为修改或删除操作时，请对应写成，ajax_edit_myaction/ajax_delete_myaction</td>
      </tr>
	<tr>
        <th>附加参数：</th>
        <td><input value="<?php echo $info['data']; ?>" type="text" name="info[data]" class="input-text" ></td>
      </tr>
	<tr>
	
        <th>是否显示菜单：</th>
        <td><input <?php if($info['display']){?> checked <?php } ?>  type="radio" name="info[display]" value="1" > 是<input <?php if(!$info['display']){?> checked <?php } ?> type="radio" name="info[display]" value="0"> 否</td>
      </tr>
	  <tr>
        <th>在此模式中显示：</th>
        <td><input type="checkbox" name="info[project1]" value="1"> 经典模式</td>
      </tr>
</table>
<!--table_form_off-->
</div>
<div class="bk15"></div>
	<div class="btn"><input type="submit" id="dosubmit" class="button" name="dosubmit" value="提交"/></div>
</div>
</body>

</html>