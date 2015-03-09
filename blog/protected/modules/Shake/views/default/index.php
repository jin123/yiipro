<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name=​"apple-touch-fullscreen" content=​"yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1 maximum-scale=1">
  <script src="/Public/js/jquery.js"></script>
	<style type="text/css">
		body{margin:0;padding:0; background:#101010;text-align:center}
		#dd { width:240px; height:60px; margin:0 auto; margin-top:200px}
		.page { background:url(/Public/Shake/images/b.jpg) no-repeat center top}
		#result { font-size:70px; color:#fff; margin-top:170px;}
		
	</style>
</head>
<body>
<div class="page">
 <div id = "num2" style="display:none;">0</div>
 <div id = "num" style = "width:300px; text-align:center; color:#101010; margin:0px auto;  font-size:70px; padding-top:40px;">0</div>
 <div id="result">准备....</div>
 <!--<input type="button" id="dd" value="点击开始摇一摇">-->
 <audio src="/Public/Shake/images/ready.mp3" id="music"></audio>
 <audio src="/Public/Shake/images/start.mp3" id="kk"></audio>
 <audio src="/Public/Shake/images/shake.mp3" id="shake"></audio>
</div>
<script type="text/javascript" >
$(function(){
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
    WeixinJSBridge.call('hideToolbar');
  });	
	var div = document.getElementById("num");
	var div2 = document.getElementById("num2");
	var xray;
	var flag=true;
	var re=0;
	var stype=true;
	var flagr=true;
	var flagl=true;
	var ctime=10*1000;
	var startondevice=true;
	var output="摇吧！";
	var last="<{$strength}>";
	var strength;
	var start_time="<{$shakeInfo.start_time}>";
	//var endtime=start_time+ctime;
	var  startime_num= parseFloat(start_time);
	var  ctime_num= parseFloat(ctime);
	var endtime = startime_num + ctime_num;
	//var nTime=<{$nTime}>*1000;
	var duration="<{$shakeInfo.duration}>";
	var count="0";
	var blog=true;
	//if (start_time){duration=start_time*1000+duration-nTime;}
	//div.innerHTML={$strength};
	//div2.innerHTML=parseInt(parseInt(div.innerHTML)*2);
	var blognum=true
	//alert(blognum);
	function ondevice(){
		//deviceOrientation/deviceMotion
		if (window.DeviceMotionEvent){
			 window.ondevicemotion = function(e){
			 e = e || window.event;
			 xray = e.accelerationIncludingGravity.x>>0;
			 if(stype==true && xray!=0){setType()}    
				if(consider()){
				//alert(start_time);
				if(blognum==false){
					//clearInterval(ho);
					//$('#result').html("123");
				}else{
					if(blog==true){
					 div2.innerHTML=parseInt(div2.innerHTML)+1;
					 div.innerHTML=parseInt(parseInt(div2.innerHTML)/2);
					 //if(parseInt(div.innerHTML)==100){blognum=false;}
						//strength=parseInt(parseInt($('#num').html())-last);
					  strength=parseInt(parseInt($('#num').html())-last);
						if (strength != 0){
							//alert(strength);
							
								$.ajax({ 
									type: "post", 
									url : "/index.php?r=Shake/Default/addStrength",
									dataType:'json', 
									data: 'strength='+strength+'&wechater=<{$wecha_id}>&shakeid=<{$shakeid}>',
									success: function(data){
										if (data.success == 1){				
											last=parseInt(last + strength);
										}else{
											blog=false;
											clearTimeout(ho);
											$('#result').html("活动结束");
											//document.getElementById("kk").play();
										}
									}
								});

						}
					}else{
						//$('#result').html("活动结束");
						//alert("活动结束，您不能再摇了");
					}
				}
				} 
			 }
		}else{
			//window.location.href="http://alivvtest3.gotoip3.com/shake/index.php/Home/Shake/entry.html?shakeid=1";
		}
		
	}
	function setType(){
		if(xray>0){re=1;}
		if(xray<0){re=2;}
		stype=false;
		//alert("settype");
	}
  function consider(){
		if(re==1){
			if(xray>0 && flag==true){ flag=false; return true;}
			if(xray<0 && flag==false){ flag=true; return true;}
		}
		if(re==2){
			if(xray<0 && flag==true){ flag=false; return true;}
			if(xray>0 && flag==false){ flag=true; return true;}
		}
	}
	

	function login(){  
		var shakeid="<{$shakeid}>";
		$.ajax({ 
			type: "post", 
			url : "/index.php?r=Shake/Default/isStart",
			dataType:'json', 
			data: 'shakeid=<{$shakeid}>',
			success: function(data){
				var kk=data.start;
				var detime=data.duration;
				//alert(duration);alert(detime);
				if(kk==1){
					$('#num').html(0);
					$('#result').html("等待开始");
				}else if(kk==2){
					clearTimeout(hoko);
					ho=setTimeout(function(){
						if(blog==true){
						if(startondevice==true){ondevice(); startondevice=false; }
						$('#result').html(output); 	
						document.getElementById("shake").play();
						}else{
							$('#result').html("活动结束!");
						}
					},1000);
				}else if(kk==3){
					
					clearTimeout(hoko);
					$('#result').html("活动结束");
				}
			}
		});
		hoko = setTimeout(login,1000);
		
	}
	document.getElementById("music").play();
	login();	
	
});
</script>
</body>
</html>

