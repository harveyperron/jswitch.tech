<script>
function docReady(fn){if(document.readyState==='complete'||document.readyState==='interactive'){setTimeout(fn,1);}else{document.addEventListener('DOMContentLoaded',fn);}} 
docReady(function(){
	var months = [
  		'January',
		'February',
    	'March',
    	'April',
    	'May',
    	'June',
    	'July',
    	'August',
    	'September',
    	'October',
    	'November',
    	'December'
  	];
	function cancel_order(id){
		if(confirm("Are you sure you want to cancel order "+id+"?")){
		$.ajax({
			type:'get',
			dataType: 'text',
			url:'https://estateelegance.com/cancel_order.php',
			data:{order_id:id},
			success:function(response){
				alert('order '+response+' deleted from calendar. Informations remain in database');
				location.reload();
			}
		});
	}}
	function put_block_available(block){
		$.ajax({
			type:'get',
			dataType: 'text',
			url:'https://estateelegance.com/back_available.php',
			data:{block:block},
			success:function(response){
				alert('block '+block+' is now available for booking');
				document.getElementById('sked').innerHTML=response;
			}
		});
	}
	function getMonthNumberFromName(monthName){
 		if(months.indexOf(monthName)<10){
 	       return '0'+(months.indexOf(monthName)+1);
 	   	}else{
 		    return months.indexOf(monthName)+1;
 		}
 	}
	var iframe_cal;
	var this_date;
	setInterval(function(){
		iframe_cal=document.getElementById('calendar').contentWindow.document.body;
		var display_year=iframe_cal.getElementsByClassName('picker-switch')[0].innerHTML.split(' ')[1];
		var display_month= iframe_cal.getElementsByClassName('picker-switch')[0].innerHTML.split(' ')[0];
		var month_number=getMonthNumberFromName(display_month);
 		var itds = iframe_cal.getElementsByClassName('day');
    	for(i=0;i<itds.length;i++){
			itds[i].onclick=function(){
				var this_day=this.innerHTML;
				if(this_day<10)this_day='0'+this_day;
				if(this.classList.contains('old')){
					var last_month_year=display_year;
					var last_month_number=parseInt(month_number)-1;
					if(last_month_number==0){
						last_month_number=12;
						last_month_year=display_year-1;
					}
					this_date=last_month_year+'-'+last_month_number+'-'+this_day;
				}else if(this.classList.contains('new')){
					var next_month_year=display_year;
					var next_month_number=parseInt(month_number)+1;
					if(next_month_number==13){
						next_month_number=1;
						next_month_year=display_year+1;
					}
					if(next_month_number<10)
						next_month_number='0'+next_month_number;
					this_date=next_month_year+'-'+next_month_number+'-'+this_day;
				}else{
					this_date=display_year+'-'+month_number+'-'+this_day;
				}
				console.log(this_date);
				$.ajax({
					type:'get',
					dataType: 'text',
					url:'https://estateelegance.com/whatsonthisdate.php',
					data:{date:this_date},
					success:function(response){
						document.getElementById('sked').innerHTML=response;
					}
				});
				var apps_on_date = document.getElementsByName(this_date);
				//document.getElementById('upcoming_container').innerHTML='';
				$('.upcoming').css('display','none');
				$('.awaiting').css('display','none');
				$('div[name="'+this_date+'"]').css('display','block');
			}
		}
		var cancel_order_buttons = document.querySelectorAll('.delete_order');
		for(i=0;i<cancel_order_buttons.length;i++){
			cancel_order_buttons[i].onclick=function(){
				console.log(this.name);
				cancel_order(this.name);
			}
		}
		var back_available_buttons = document.querySelectorAll('.back_available');
		for(i=0;i<back_available_buttons.length;i++){
			back_available_buttons[i].onclick=function(){
				put_block_available(this.name);
			}
		}
	},300);
});	
</script>
