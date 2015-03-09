<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=2.0"/>
<meta name="MobileOptimized" content="240"/>
<title>康师傅泡椒系列的微博</title>
 
<script type="text/javascript">
       var SHAKE_THRESHOLD = 3000;    
    var last_update = 0;    
    var x=y=z=last_x=last_y=last_z=0;   
	var  media; 
	
	function init(){
	last_update=new Date().getTime();
	media= document.getElementById("musicBox");
	if (window.DeviceMotionEvent) { 
	window.addEventListener('devicemotion',deviceMotionHandler, false);  
	} else{
		
	alert('not support mobile event');
	}
	}

    function deviceMotionHandler(eventData) {    
	
    var acceleration =eventData.accelerationIncludingGravity;  
	 
    var curTime = new Date().getTime(); 
    if ((curTime - last_update)> 100) {  
		var diffTime = curTime -last_update;    
		last_update = curTime;        
		x = acceleration.x; 
		y = acceleration.y;   
		z = acceleration.z;   
		var speed = Math.abs(x +y + z - last_x - last_y - last_z) / diffTime * 10000;   
		//alert(speed > SHAKE_THRESHOLD);
		if (speed > SHAKE_THRESHOLD) {    
			media.play();
		}    
		last_x = x;    
		last_y = y;    
		last_z = z;    
		}    
     
    }  

</script>


</head> 
 
<body onload="init()"> 
html5手机摇一摇功能，摇一摇试试看
 <audio src="/Public/Shake/Shake.mp3"  id="musicBox" preload="metadata"  controls
		autoplay="false"
     >
   </audio> 
</body> 
 
</html>