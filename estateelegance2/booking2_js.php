<script>
function docReady(fn){if(document.readyState==="complete"||document.readyState==="interactive"){setTimeout(fn,1);}else{document.addEventListener("DOMContentLoaded",fn);}} 
docReady(function(){
	console.log(requested_services);
	var services_JSON=JSON.parse(requested_services);
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
		function getMonthNumberFromName(monthName){
 		if(months.indexOf(monthName)<10){
 	       return '0'+(months.indexOf(monthName)+1);
 	   	}else{
 		    return months.indexOf(monthName)+1;
 		}
 	}
	for(i=0;i<services_JSON.length;i++){
		if(services_JSON[i].amount){
			document.getElementById('requested_services').innerHTML+=services_JSON[i].amount+"X "+services_JSON[i].service+" $ "+services_JSON[i].price+"<br>";
		}else{
			var tax = services_JSON[i].order_price * 13 / 100;
			console.log(tax);
			var totalPrice = parseFloat(services_JSON[i].order_price) + parseFloat(tax);
			document.getElementById('requested_services').innerHTML+="Tax(HST): $ "+tax.toFixed(2) +"<br>";			
			document.getElementById('requested_services').innerHTML+="Total $ "+totalPrice.toFixed(2) +"<br>"+"<br>";			
			order_price=services_JSON[i].order_price;
		}
	}
	setInterval(function(){
		var radios=document.querySelectorAll('input[type=radio]');
		for(i=0;i<radios.length;i++){
			if(radios[i].checked){
				radios[i].name=radios[i].className;
			}else{
				radios[i].name="not_used";
			}
		}
	},300);
	var stripe_method_button=document.getElementById('stripe_gateway');
	stripe_method_button.onclick=function(){
		var allIputs=document.getElementsByClassName('question');
		var data='{"order_id":"'+order_id+'",';
		var year_selected=document.getElementById('year_selection').value;
		var month_selected=document.getElementById('month_selection').value;
		var day_selected=document.getElementById('day_selection').value;
		var time_selected=document.getElementById('time_selection').value;
		if(day_selected<10)day_selected="0"+day_selected;
		var appointment_datetime=year_selected+"-"+getMonthNumberFromName(month_selected)+"-"+day_selected+" "+time_selected;
		data+='"appointment_datetime":"'+appointment_datetime+'",';
		for(i=0;i<allIputs.length;i++){
			if(allIputs[i].querySelector('input').name!="not_used"){
				if(allIputs[i].querySelector('input').value == '' && allIputs[i].querySelector('input').name != 'additional_info')
				{
					alert("please fillout all required field");
					return false;
				}
				data+='"'+allIputs[i].querySelector('input').name+'":"'+allIputs[i].querySelector('input').value+'",';
			}
		}
		data+='"order_price":"'+order_price+'"}';
		$.ajax({
            type: "POST",
			dataType: "text",
            url: 'https://estateelegance.com/book_reservation.php',
            data: data,
            success: function(){
				fetch('https://estateelegance.com/stripe_session.php?order_id='+order_id,{
  					method: 'POST'
				}).then(function(response){
  					return response.json();
				}).then(function(session) {
  					var stripe = Stripe('pk_live_51MoIdhJO5OCfeChi7sUjKOhr21FVp6X2TVUkJsbYQ9mOd5oJew7elJIzsd2pTdhmJmryLA10SqdLcySf1KtSt5cl00GlcWixNH');
  					stripe.redirectToCheckout({
    					sessionId: session.sessionId,
  					});
				}).catch(function(error) {
  					console.error('Error:', error);
				});
            }
       });
	}
	// Paypal button on-click
	var paypal_button=document.getElementById('paypal_gateway');
	paypal_button.onclick=function(){
		//e.preventDefault();
		//
		var allIputs = document.getElementsByClassName('question');
		var data='{"order_id":"'+order_id+'",';
		var year_selected=document.getElementById('year_selection').value;
		var month_selected=document.getElementById('month_selection').value;
		var day_selected=document.getElementById('day_selection').value;
		var time_selected=document.getElementById('time_selection').value;
		if(day_selected<10)day_selected="0"+day_selected;
		var appointment_datetime=year_selected+"-"+getMonthNumberFromName(month_selected)+"-"+day_selected+" "+time_selected;
		data+='"appointment_datetime":"'+appointment_datetime+'",';
		for(i=0;i<allIputs.length;i++){
			if(allIputs[i].querySelector('input').name!="not_used"){
				if(allIputs[i].querySelector('input').value == '' && allIputs[i].querySelector('input').name != 'additional_info')
				{
					alert("please fillout all required field");
					return false;
				}
				data+='"'+allIputs[i].querySelector('input').name+'":"'+allIputs[i].querySelector('input').value+'",';
			}
		}
		data+='"order_price":"'+order_price+'"}';
		$.ajax({
            type: "POST",
			dataType: "text",
            url: 'https://estateelegance.com/paypal_payment.php',
            data: data,
            success: function(response){
				var data = JSON.parse(response);
				if(data.success == 1)
				{
					window.location.href = data.payment_url;
				}
				else{
					alert("Something wrong please try again later");
				}
            }
       });
	}
});
</script>
