<script src="https://js.stripe.com/v3/"></script>
<div id=contribute class=texte>
<center>
Your contributions are serving the development of technologies and the empowerment of communities.
<br>
<br>
<br>
<input id=name placeholder='Your name' type=text></input>
<br>
<br>
<input id=project_name placeholder='Project name' type=text></input>
<br>
<br>
<input id=amount placeholder='Amount' type=text></input>
<br>
<br>
Payment options:
<br>
<br>
<div class=fhc>
<button id=card_payment_button>Credit card</button>
<a href="https://jswitch.tech?interac_transfer=1"><button>e-transfer</button></a>
</div>
<br>
<br>
* Card payments are done on official page.
</div>
</center>
<script>	
var amount=document.getElementById('amount');
var client_name=document.getElementById('name');
var project_name=document.getElementById('project_name');
var card_button=document.getElementById('card_payment_button');
card_button.onclick=function(){
$.ajax({
    type: 'post',
    url: 'https://jswitch.tech/save_transaction.php',
    data: {amount:amount.value,project_name:project_name.value,client_name:client_name.value},
    success:function(response){
	console.log(response);
	var url='https://jswitch.tech/stripe_session.php?amount='+encodeURIComponent(amount.value)+'&project_name='+encodeURIComponent(project_name.value);
	fetch(url,{
		method: 'POST'
	}).then(function(response){
  		return response.json();
	}).then(function(session){
  		var stripe = Stripe('pk_live_51Mz9gpGqRZvKEf3uLHYSHaphoucEVaispERUAjERJDeNFMUSMufX3tkPBrCwLt9lIYKKWSt7HNYlG6Wc6XiL3SGz00KUjyLI8y');
  		stripe.redirectToCheckout({
   			sessionId:session.sessionId,
  		});
	}).catch(function(error) {
  		console.error('Error:', error);
	});

    }
}); 
}
</script>	
<style>
button{
	width:min-content;
	height:min-content;
	margin:1vw;
}
</style>
