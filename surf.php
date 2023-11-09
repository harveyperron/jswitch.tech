<img id=surfer src='https://www.iconshock.com/image/RealVista/Sports/sky_surfing'></img>
<script>
var surf=document.getElementById('surfer');
var surfTop=-35;
var surfLeft=Math.floor(Math.random()*100);
var direction=Math.floor(Math.random()*2);
surf.style.left=surfLeft+'%';
var superLeft=0;
var t=0;
setInterval(function(){
	if(direction){
		surf.style.transform='rotateY(180deg)';
		surfLeft+=superLeft;
	}
	else{
		surf.style.transform='rotateY(0deg)';
		surfLeft-=superLeft;
	}
	if(surfLeft>100)surfLeft=0;
	if(surfLeft<0)surfLeft=100;
	if(surf.src=='https://www.iconshock.com/image/RealVista/Sports/sky_surfing'){
		surfTop+=1;
		superLeft=1;
		if(Math.floor(Math.random()*200)==0){
			surf.src='https://pngimg.com/d/parachute_PNG19419.png';
		}
	}else{
		surfTop+=.1;
		rotation=Math.sin(t)*30;
		t+=.01;
		superLeft=Math.sin(t)*0.2*(-1);
		surf.style.transform='rotateZ('+rotation+'deg)';
	}
	if(surfTop>=120){
		surfTop=Math.floor(Math.random()*-200);
		surfLeft=Math.floor(Math.random()*100);
		direction=Math.floor(Math.random()*2);
		surf.src='https://www.iconshock.com/image/RealVista/Sports/sky_surfing';
	}
	surf.style.top=surfTop+'%';
	surf.style.left=surfLeft+'%';
},10);
</script>
<style>
#surfer{
	position:absolute;
}
</style>
