
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"<?php if(isset($addbg)) { ?> class="addbg"<?php } ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>后台管理</title>
<link href="/Admin/statics/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/Admin/statics/css/zh-cn-system.css" rel="stylesheet" type="text/css" />
<link href="/Admin/statics/css/table_form.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/Admin/statics/css/style/styles1.css" title="styles1" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/Admin/statics/css/style/zh-cn-styles2.css" title="styles2" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/Admin/statics/css/style/zh-cn-styles3.css" title="styles3" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/Admin/statics/css/style/zh-cn-styles4.css" title="styles4" media="screen" />
<script>
           var GV = {
    DIMAUB: "/",
    JS_ROOT: "/Public/js/",
    TOKEN: ""
};
    </script>
    <script language="javascript" type="text/javascript" src="/Admin/statics/js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="/Admin/statics/js/common.js"></script>
<script language="javascript" type="text/javascript" src="/Admin/statics/js/admin_common.js"></script>
<script language="javascript" type="text/javascript" src="/Admin/statics/js/styleswitch.js"></script>
<script language="javascript" type="text/javascript" src="/Admin/statics/js/formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="/Admin/statics/js/formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
	window.focus();
	var pc_hash = '123456>';
	<?php if(!isset($show_pc_hash)) { ?>
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
<?php } ?>
        
        
        /*   function global_ajax_form(formid){
        
             Wind.use('', '', '', function () {
	            var form = $('#'+formid);
	        //表单验证开始
	        form.validate({
				//是否在获取焦点时验证
				onfocusout:false,
				//是否在敲击键盘时验证
				onkeyup:false,
				//当鼠标掉级时验证
				onclick: false,
	            //验证错误
	            showErrors: function (errorMap, errorArr) {
					//errorMap {'name':'错误信息'}
					//errorArr [{'message':'错误信息',element:({})}]
					try{
						$(errorArr[0].element).focus();
						art.dialog({
							id:'error',
							icon: 'error',
							lock: true,
							fixed: true,
							background:"#CCCCCC",
							opacity:0,
							content: errorArr[0].message,
							cancelVal: '确定',
							cancel: function(){
								$(errorArr[0].element).focus();
							}
						});
					}catch(err){
					}
	            },
	            //验证规则
	            rules: {},
	            //验证未通过提示消息
	            messages:{},
	            //给未通过验证的元素加效果,闪烁等
	            highlight: false,
	            //是否在获取焦点时验证
	            onfocusout: false,
	            //验证通过，提交表单
	            submitHandler: function (forms) {
				//alert('fdgfg');
	                $(forms).ajaxSubmit({
	                    url: form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
	                    dataType: 'json',
	                    success: function (data, statusText, xhr, $form) {
							
							var data = $.parseJSON(data);
							if(data['status']){
								var win = art.dialog.open.origin;//来源页面

                                win.location.reload();
						
						        art.dialog.close();
								
								}
                            else{
                            
                             alert(data['msg']);
                            
                            }
					
						 
	                    }
	                });
	            }
	        });
	    });

        
        
        
        
        }*/
</script>
</head>
<body>
<?php if(!isset($_GET['show_header'])) { ?>
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    <?php if(isset($big_menu)) { echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';} else {$big_menu = '';} ?>
    <?php
    $name = Yii::app()->controller->id;  // controller

    $index = $this->getAction()->getId(); // action
   // vaR_dump($index);vaR_dump($_GET['menuid']);vaR_dump($big_menu);die;
    $menu =  Admin::submenu($_GET['menuid'],$big_menu,$index);
    echo $menu;
    ?>
    </div>
</div>
<?php } ?>
<style type="text/css">
	html{_overflow-y:scroll}
</style>