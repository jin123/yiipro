<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理平台</title>
<link href="/demos/blog/Admin/statics/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/demos/blog/Admin/statics/css/zh-cn-system.css" rel="stylesheet" type="text/css" />
<link href="/demos/blog/Admin/statics/css/dialog.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/demos/blog/Admin/statics/css/style/styles1.css" title="styles1" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/demos/blog/Admin/statics/css/style/zh-cn-styles2.css" title="styles2" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/demos/blog/Admin/statics/css/style/zh-cn-styles3.css" title="styles3" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="/demos/blog/Admin/statics/css/style/zh-cn-styles4.css" title="styles4" media="screen" />
<script language="javascript" type="text/javascript" src="/demos/blog/Admin/statics/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="/demos/blog/Admin/statics/js/styleswitch.js"></script>
<script language="javascript" type="text/javascript" src="/demos/blog/Admin/statics/js/dialog.js"></script>
<script language="javascript" type="text/javascript" src="/demos/blog/Admin/statics/js/hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="/demos/blog/Admin/statics/js/jquery.sgallery.js"></script>
<script type="text/javascript">
var pc_hash = 'IYnVLx';
</script>
<style type="text/css">
.objbody{overflow:hidden}

.btns{background-color:#666;}
.btns{position: absolute; top:116px; right:30px; z-index:1000; opacity:0.6;}
.btns2{background-color:rgba(0,0,0,0.5); color:#fff; padding:2px; border-radius:3px; box-shadow:0px 0px 2px #333; padding:0px 6px; border:1px solid #ddd;}
.btns:hover{opacity:1;}
.btns h6{padding:4px; border-bottom:1px solid #666; text-shadow: 0px 0px 2px #000;}
.btns .pd4{ padding-top:4px; border-top:1px solid #999;}
.pd4 li{border-radius:0px 6spx 0px 6px; margin-top:2px; margin-bottom:3px; padding:2px 0px;}
.btns .pd4 li span{padding:0px 6px;}
.pd{padding:4px;}
.ac{background-color:#333; color:#fff;}
.hvs{background-color:#555; cursor: pointer;}
.bg_btn{background: url(/demos/blog/Admin/statics/images/admin_img/icon2.jpg) no-repeat; width:32px; height:32px;}
</style>
</head>
<body scroll="no" class="objbody">
<div class="header">
	<div class="logo lf"><a href="<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank"><span class="invisible">内容管理系统</span></a></div>
    <div class="col-auto">
    	<div class="log white cut_line">您好！admin  [超级管理员]
    	</div>
        <ul class="nav white" id="top_menu">
        <?php
        $array = Admin::admin_menu(0);
       foreach($array as $_value) {
        	if($_value['id']==10) {
        		echo '<li id="_M'.$_value['id'].'" class="on top_menu"><a href="javascript:_M('.$_value['id'].',\'/demos/blog/index.php?r='.$_value['m'].'/'.$_value['c'].'/'.$_value['a'].'\')" hidefocus="true" style="outline:none;">'.$_value['name'].'</a></li>';
        		
        	} else {
        		echo '<li id="_M'.$_value['id'].'" class="top_menu"><a href="javascript:_M('.$_value['id'].',\'?m='.$_value['m'].'&c='.$_value['c'].'&a='.$_value['a'].'\')"  hidefocus="true" style="outline:none;">'.$_value['name'].'</a></li>';
        	}      	
        }
        ?>
            
        </ul>
    </div>
</div>
<div id="content">
	<div class="col-left left_menu">
    	<div id="Scroll"><div id="leftMain"></div></div>
        <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium;" hideFocus="hidefocus" class="open" title="spread_or_closed"><span class="hidden">spread_or_closed</span></a>
    </div>
	<div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
	<div class="content">
        	<iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
            </div>
        </div>
    <div class="col-auto mr8">
    <div class="crumbs">
    当前位置:<span id="current_pos"></span></div>
    	<div class="col-1">
        	<div class="content" style="position:relative; overflow:hidden">
                <iframe name="right" id="rightMain" src="/demos/blog/index.php?r=Admin/Default/public_main" frameborder="false" scrolling="auto" style="border:none; margin-bottom:30px" width="100%" height="auto" allowtransparency="true"></iframe>
                <div class="fav-nav">
					<div id="panellist">
			
					</div>
					<div id="paneladd"></div>
					<input type="hidden" id="menuid" value="">
					<input type="hidden" id="bigid" value="" />
                    <div id="help" class="fav-help"></div>
				</div>
        	</div>
        </div>
    </div>
</div>
<div class="tab-web-panel hidden" style="position:absolute; z-index:999; background:#fff">
<ul>

</ul>
</div>
<div class="scroll"><a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a><a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a></div>

<script type="text/javascript"> 
if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
  var result = [],ri = 0;
  for (var i = 0,n = this.length; i < n; i++){
	if(i in this){
	  result[ri++]  = fn.call(scope ,this[i],i,this);
	}
  }
return result;
};

var getWindowSize = function(){
return ["Height","Width"].map(function(name){
  return window["inner"+name] ||
	document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { // for IE6 IE7
	  document.body.onresize = resize;
	} else { 
	  window.onresize = resize;
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	//��╋拷锟斤拷锟芥��锟界��锟界��锟芥��锟�
	var str=getWindowSize();
	var strs= new Array(); //��癸拷娑�锟芥��锟斤拷锟芥��锟斤拷
	strs=str.toString().split(","); //���锟界��锟斤拷锟斤拷锟斤拷锟�
	var heights = strs[0]-150,Body = $('body');$('#rightMain').height(heights);   
	//iframe.height = strs[0]-46;
	if(strs[1]<980){
		$('.header').css('width',980+'px');
		$('#content').css('width',980+'px');
		Body.attr('scroll','');
		Body.removeClass('objbody');
	}else{
		$('.header').css('width','auto');
		$('#content').css('width','auto');
		Body.attr('scroll','no');
		Body.addClass('objbody');
	}
	
	var openClose = $("#rightMain").height()+39;
	$('#center_frame').height(openClose+9);
	$("#openClose").height(openClose+30);	
	$("#Scroll").height(openClose-20);
	windowW();
}
wSize();
function windowW(){
	if($('#Scroll').height()<$("#leftMain").height()){
		$(".scroll").show();
	}else{
		$(".scroll").hide();
	}
}
windowW();
$(document).ready(function(){
	var offset = $(".tab_web").offset();
	var tab_web_panel = $(".tab-web-panel");
	$(".tab_web").mouseover(function(){
			tab_web_panel.css({ "left": +$(this).offset().left+4, "top": +offset.top+$('.tab_web').height()});
			tab_web_panel.show();
			if(tab_web_panel.height() > 200){
				tab_web_panel.children("ul").addClass("tab-scroll");
			}
		});
	$(".tab_web span").mouseout(function(){hidden_site_list_1()});
	$(".tab-web-panel").mouseover(function(){clearh();$('.tab_web a').addClass('on')}).mouseout(function(){hidden_site_list_1();$('.tab_web a').removeClass('on')});
	//默认载入左侧菜单
	//$("#leftMain").load("?m=admin&c=index&a=public_menu_left&menuid=10");
    $("#leftMain").load("/demos/blog/index.php?r=Admin/Default/public_menu_left&menuid=10");
	$("#btnx").removeClass("btns2");
	$("#Site_model,#btnx h6").css("display","none");
	$("#btnx").hover(function(){$("#Site_model,#btnx h6").css("display","block");$(this).addClass("btns2");$(".bg_btn").hide();},function(){$("#Site_model,#btnx h6").css("display","none");$(this).removeClass("btns2");$(".bg_btn").show();});
	$("#Site_model li").hover(function(){$(this).toggleClass("hvs");},function(){$(this).toggleClass("hvs");});
	$("#Site_model li").click(function(){$("#Site_model li").removeClass("ac"); $(this).addClass("ac");});
});
function site_select(id,name, domain, siteid) {
	$(".tab_web span").html(name);
	$.get("?m=admin&c=index&a=public_set_siteid&siteid="+id,function(data){
		if (data==1){
				window.top.right.location.reload();
				window.top.center_frame.location.reload();
				$.get("?m=admin&c=index&a=public_menu_left&menuid=0&parentid="+$("#bigid").val(), function(data){$('.top_menu').remove();$('#top_menu').prepend(data)});
			}
		});
	$('#site_homepage').attr('href', domain);
	$('#site_search').attr('href', 'index.php?m=search&siteid='+siteid);
}
//锟斤拷锟斤拷锟斤拷缁�锟斤拷锟介��锟斤拷锟斤拷锟斤拷锟斤拷
var s = 0;
var h;
function hidden_site_list() {
	s++;
	if(s>=3) {
		$('.tab-web-panel').hide();
		clearInterval(h);
		s = 0;
	}
}
function clearh(){
	if(h)clearInterval(h);
}
function hidden_site_list_1() {
	h = setInterval("hidden_site_list()", 1);
}

//瀹革拷娓���锟斤拷锟斤拷锟�
$("#openClose").click(function(){
	if($(this).data('clicknum')==1) {
		$("html").removeClass("on");
		$(".left_menu").removeClass("left_menu_on");
		$(this).removeClass("close");
		$(this).data('clicknum', 0);
		$(".scroll").show();
	} else {
		$(".left_menu").addClass("left_menu_on");
		$(this).addClass("close");
		$("html").addClass("on");
		$(this).data('clicknum', 1);
		$(".scroll").hide();
	}
	return false;
});

function _M(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#bigid").val(menuid);
	$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');
	if(menuid!=8) {
		$("#leftMain").load("/demos/blog/index.php?r=Admin/Default/public_menu_left&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	} else {
		$("#leftMain").load("/demos/blog/index.php?r=Admin/Default/public_menu_left&menuid="+menuid, {limit: 25}, function(){
		   windowW();
		 });
	}
	//$("#rightMain").attr('src', targetUrl);
	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");
	$.get("/demos/blog/index.php?r=Admin/Default/public_current_pos&menuid="+menuid, function(data){
		$("#current_pos").html(data);
	});
	//瑜帮拷锟斤拷��帮拷濠����锟斤拷���锟斤拷锟斤拷锟斤拷锟斤拷���锟斤拷锟斤拷锟斤拷锟芥��锟斤拷锟藉�革拷锟藉��锟斤拷锟斤拷
	$('#display_center_id').css('display','none');
	//锟斤拷��с��瀹革拷娓���锟斤拷锟斤拷锟介��锟借ぐ锟斤拷锟界�帮拷濠����锟斤拷���锟借�癸拷锟界��锟藉��锟藉�革拷娓�锟�
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data('clicknum', 0);
	$("#current_pos").data('clicknum', 1);
}
function _MP(menuid,targetUrl) {
	$("#menuid").val(menuid);
	$("#paneladd").html('<a class="panel-add" href="javascript:add_panel();"><em>添加</em></a>');

	$("#rightMain").attr('src', targetUrl+'&menuid='+menuid+'&pc_hash='+pc_hash);
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
	$.get("/demos/blog/index.php?r=Admin/Default/public_current_pos&menuid="+menuid, function(data){
		//$("#current_pos").html(data+'<span id="current_pos_attr"></span>');
	});
	$("#current_pos").data('clicknum', 1);
	show_help(targetUrl);
}

function show_help(targetUrl) {
	$("#help").slideUp("slow");
	var str = '';
	$.getJSON("http://v9.help.phpcms.cn/api.php?jsoncallback=?",{op:'help',targetUrl: targetUrl},
	function(data){
		if(data!=null) {
			$("#help").slideDown("slow");
			$.each(data, function(i,item){
				str += '<a href="'+item.url+'" target="_blank">'+item.title+'</a>';
			});
			
			str += '<a class="panel-delete" href="javascript:;" onclick="$(\'#help\').slideUp(\'slow\')"></a>';
			$('#help').html(str);
		}
	});
	$("#help").data('time', 1);
}
setInterval("hidden_help()", 30000);
function hidden_help() {
	var htime = $("#help").data('time')+1;
	$("#help").data('time', htime);
	if(htime>2) $("#help").slideUp("slow");
}
function add_panel() {
	var menuid = $("#menuid").val();
	$.ajax({
		type: "POST",
		url: "?m=admin&c=index&a=public_ajax_add_panel",
		data: "menuid=" + menuid,
		success: function(data){
			if(data) {
				$("#panellist").html(data);
			}
		}
	});
}
function delete_panel(menuid, id) {
	$.ajax({
		type: "POST",
		url: "?m=admin&c=index&a=public_ajax_delete_panel",
		data: "menuid=" + menuid,
		success: function(data){
			$("#panellist").html(data);
		}
	});
}

function paneladdclass(id) {
	$("#panellist span a[class='on']").removeClass();
	$(id).addClass('on')
}
setInterval("session_life()", 160000);
function session_life() {
	$.get("?m=admin&c=index&a=public_session_life");
}
function lock_screen() {
	$.get("?m=admin&c=index&a=public_lock_screen");
	$('#dvLockScreen').css('display','');
}
function check_screenlock() {
	var lock_password = $('#lock_password').val();
	if(lock_password=='') {
		$('#lock_tips').html('<font color="red"><密码不能为空</font>');
		return false;
	}
	$.get("?m=admin&c=index&a=public_login_screenlock", { lock_password: lock_password},function(data){
		if(data==1) {
			$('#dvLockScreen').css('display','none');
			$('#lock_password').val('');
			$('#lock_tips').html('锁屏状态，请输入密码解锁');
		} else if(data==3) {
			$('#lock_tips').html('<font color="red">密码重试次数太多</font>');
		} else {
			strings = data.split('|');
			$('#lock_tips').html('<font color="red">密码错误，您还有'+strings[1]+'次尝试机会！</font>');
		}
	});
}
$(document).bind('keydown', 'return', function(evt){check_screenlock();return false;});

(function(){
    var addEvent = (function(){
             if (window.addEventListener) {
                return function(el, sType, fn, capture) {
                    el.addEventListener(sType, fn, (capture));
                };
            } else if (window.attachEvent) {
                return function(el, sType, fn, capture) {
                    el.attachEvent("on" + sType, fn);
                };
            } else {
                return function(){};
            }
        })(),
    Scroll = document.getElementById('Scroll');
    // IE6/IE7/IE8/IE10/IE11/Opera 10+/Safari5+
    addEvent(Scroll, 'mousewheel', function(event){
        event = window.event || event ;  
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);

    // Firefox 3.5+
    addEvent(Scroll, 'DOMMouseScroll',  function(event){
        event = window.event || event ;
		if(event.wheelDelta <= 0 || event.detail > 0) {
				Scroll.scrollTop = Scroll.scrollTop + 29;
			} else {
				Scroll.scrollTop = Scroll.scrollTop - 29;
		}
    }, false);
	
})();
function menuScroll(num){
	var Scroll = document.getElementById('Scroll');
	if(num==1){
		Scroll.scrollTop = Scroll.scrollTop - 60;
	}else{
		Scroll.scrollTop = Scroll.scrollTop + 60;
	}
}
function _Site_M(project) {
	var id = '';
	$('#top_menu li').each(function (){
		var S_class = $(this).attr('class');
		if ($(this).attr('id')){
			$(this).hide();
		}
		if (S_class=='on top_menu' || S_class=='top_menu on'){
			id = $(this).attr('id');
		}
	});
	$('#'+id).show();
	id = id.substring(2, id.length);
	if (!project){
		project = 0;
	}
	$.ajaxSettings.async = false; 
	$.getJSON('index.php', {m:'admin', c:'index', a:'public_set_model', 'site_model':project, 'time':Math.random()}, function (data){
		$.each(data, function(i, n){
			$('#_M'+n).show();
		})
	})
	$("#leftMain").load("?m=admin&c=index&a=public_menu_left&menuid="+id+'&time='+Math.random());
}


</script>
</body>
</html>