<div id=page class="matri" ontouchstart="track()" ontouchmove="track()"></div>
<!--Include Jquery-------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--Scripts-------------------------->
<script>
window.onload = init;
function docReady(fn){if(document.readyState==="complete"||document.readyState==="interactive"){setTimeout(fn,1);}else{document.addEventListener("DOMContentLoaded",fn);}} 
function init() {
	if (window.Event) {
	document.captureEvents(Event.MOUSEMOVE);
	}
	document.onmousemove = getCursorXY;
}
var cursorX;
var cursorY;
function getCursorXY(e) {
	cursorX = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	cursorY = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
}
function track()
{
	cursorX = event.touches[0].clientX;
  	cursorY = event.touches[0].clientY;
}
var screenwidth = screen.width;
var midwidth = screen.width/2;
var screenheight = screen.height;
var midheight = screen.height/2;
function rgba(r,g,b,a)
{
	return "rgba("+r+","+g+","+b+","+a+")";
}
function cosi(x)
{
	return Math.cos(x);
}
function sine(x)
{
	return Math.sin(x);
}
function gid(id)
{
	return document.getElementById(id);
}
</script>
<!--css------------------------------>
<style>
.f1{flex:1;}
.f2{flex:2;}
.f3{flex:3;}
.f4{flex:4;}
.f5{flex:5;}
.f6{flex:6;}
.f7{flex:7;}
.f8{flex:8;}
.f9{flex:9;}
.w
{
	flex-wrap:wrap;
}
.fhc
{
	display:flex;
	justify-content:center;
}
.fhs
{
	display:flex;
	justify-content:flex-start;
}
.fhe
{
	display:flex;
	justify-content:flex-end;
}
.fha
{
	display:flex;
	justify-content:space-around;
}
.fhb
{
	display:flex;
	justify-content:space-between;
}
.fvc
{
	display:flex;
	flex-direction:column;
	justify-content:center;
}
.fvs
{
	display:flex;
	flex-direction:column;
	justify-content:flex-start;
}
.fva
{
	display:flex;
	flex-direction:column;
	justify-content:space-around;
}
a
{
	text-decoration:none;
}
.matrix
{
	width:100vw;
	height:100vh;
	background:navy;
}
.a
{
	position:absolute;
}
.originate
{
	transform:translateX(-50%) translateY(-50%);
}
.gold
{
	margin:1vw;
	padding:1vh;
	background-color:rgba(1,100,1,.5);
	color:rgba(250,250,0,1);
	border:solid 3px black;
	text-align:center;
	border-radius:2vh;
	text-shadow:1px 1px 1px black;
	transition:.2s;
}
.gold:hover
{
	background-color:rgba(250,0,250,.5);
}
.retro
{
	border:solid 1px black;
	border-radius:1vh;
	margin:1vh;
	background:red;
	color:gold;
	text-align:center;
	box-shadow:0 0 5px gold;
}

</style>
