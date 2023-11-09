<div style='margin:0;width:100%;padding:0;overflow:visible;' id=welcome class='texte'>
<img src='jswitch_walking.gif' id=animation></img>
</div>
<script>
function docReady(fn){if(document.readyState==="complete"||document.readyState==="interactive"){setTimeout(fn,1);}else{document.addEventListener("DOMContentLoaded",fn);}} 
docReady(function(){
var avail_animations=['jswitch_walking.gif','jswitch.gif'];
var index_anim=1;
setInterval(function(){
	document.getElementById('animation').src=avail_animations[index_anim % avail_animations.length];
	index_anim++;
},9000);
});
</script>
<style>
#welcome{
	background-size:cover;
	background-position:center;
}
#animation{
	width:100%;
}

</style>
