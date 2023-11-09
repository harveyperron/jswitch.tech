<head>
<title>Jswitch</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Fontdiner+Swanky&family=Montez&family=Oswald:wght@700&display=swap" rel="stylesheet">
</head>
<?php include "visitors_data.php";?>
<?php include "lib/jmhp.php";?>
<script>
function show(section){
	$('.texte').css('display','none');
	$(section).css('display','block');
	document.getElementById('content_container').scrollTop = 0;
}
</script>
</style>
<body>
<center>
<a class=fhc href='https://jswitch.tech'>
<div id=logo class=fvc>
	<div id=brand_name class="fhc">
	&ltJSwitch/&gt
	</div>
	<div id=brand_description class=fhc>
		Headquarter
	</div>
</div>
</a>
<hr>
<center>
	<div class='w fha' id=nav>
			<div onclick=show('#about')>About</div>
			<div onclick=show('#journal')>Journal</div>
			<div onclick=show('#resources')>Resources</div>
			<div onclick=show('#contact')>Contact</div>
			<div onclick=show('#contribute')>Contribute</div>
	</div>
	</center>
<hr>
<div id=content_container class=fhc>
	<div id=content>
	<br>
		<?php include "welcome.php";?>
		<?php include "about.php";?>
		<?php include "resources.php";?>
		<?php include "contact.php";?>
		<?php include "contribute.php";?>
		<?php include "thanks.php";?>
	</div>
</div>
<div class='fhc w' id=advertisement>
<div>The DOM</div>
<div>Javascript</div>
<div>asynchronous requests</div>
<div>Databases</div>
<div>Server-side languages</div>
</div>
</body>
<div id=footer>
Jswitch&copy Trois-Rivières, Qc 2023
</div>
</footer>
<script>
function docReady(fn){if(document.readyState==="complete"||document.readyState==="interactive"){setTimeout(fn,1);}else{document.addEventListener("DOMContentLoaded",fn);}} 
docReady(function(){
function param(name){return (location.search.split(name+'=')[1]||'').split('&')[0];}
const stripe_succeed=param('stripe_succeed')
const interac_transfer=param('interac_transfer')
if(interac_transfer==1){
	show('#contact');
}else if(stripe_succeed==1){
	show('#thanks');
}else{
	show('#about');
}
document.getElementById('content_container').scrollTop = 0;
var touching_screen=0;
function pageScroll(){if(touching_screen==0){document.getElementById('content_container').scrollBy(0,1);}}
document.getElementById('content').onmouseover=function(){touching_screen=1;}
document.getElementById('content').onmouseout=function(){touching_screen=0;}
document.getElementById('content').ontouchstart=function(){touching_screen=1;}
document.getElementById('content').ontouchend=function(){touching_screen=0;}
setTimeout(function(){setInterval(pageScroll,102);},2000);
gid('brand_description').style.opacity=0;
setTimeout(function(){
	gid('brand_description').style.opacity=1;
},1100);
});
</script>
<style>
body{
	overflow:hidden;
}
@import url('https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Fontdiner+Swanky&family=Montez&family=Oswald:wght@700&display=swap');
#logo{
}
#brand_description:hover{
	text-shadow:0 0 5px white,0 0 15px white;
}
#brand_description{
	font-size:3vh;
	transform:translateY(-4.7vh);
    font-family:'Fontdiner Swanky',cursive;
	color:black;
	text-shadow:0 0 5px white;
	animation:fadeIN 1s;
	animation-delay:1s;
	height:0;
}
#brand_name:hover{
	text-shadow:0 0 5px white,0 0 15px white;
}
#brand_name{
	color:black;
	text-shadow:0 0 12px white;
    font-family:'Fontdiner Swanky',cursive;
	font-size:7vh;
	animation:fadeIN 1s;
}
@keyframes fadeIN {
	from{opacity:0};
	to{opacity:1};
}
#nav{
	max-width:800px;
	font-family:'Fontdiner Swanky',cursive;
	font-size:2vh;
	color:grey;
}
#content:hover{
	color:white;
}
.texte{
	animation:appear .7s ease-in;
	text-align:justify;
	width:100%;
}
@keyframes appear{
	from{opacity:0;}
	to{opacity:1;}
}
#nav_container{
	width:100%;
}
.texte:hover{
	color:white;
}
#content{
	margin:0 auto;
}
#content_container{
	padding:3vh;
	overflow:auto;
	height:min-content;
	max-height:50vh;
	border-radius:3vw;
	max-width:800px;
}
#nav div{
	transition:.3s;
	padding:1vw;
}
#nav:hover{
	font-size:1.7vh;
}
#nav div:hover{
	font-size:3vh;
	text-shadow:0 0 7px white,0 0 30px white;
	color:lightgrey;
}
input,button{

	max-width:50vw;
	font-size:2vh;
}
:root{
	background-color:#050508;
	color:grey;
	font-size:2vh;
}
#footer{
	position:absolute;
	bottom:1vw;
	text-align:center;
	margin:0 auto;
	left:0;
	right:0;
	font-size:2vh;
}

#advertisement div:hover{
	border:solid 1px white;
	color:white;
}
#advertisement div{
	margin:7px;
	border:solid 1px grey;
	padding:7px;
}
#advertisement{
	margin:0 auto;
}

</style>
