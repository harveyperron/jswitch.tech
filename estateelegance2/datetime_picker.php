<div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<select id=year_selection><option>2023</option><option>2024</option><option>2025</option><option>2026</option><option>2027</option><option>2028</option><option>2029</option><option>2030</option><option>2031</option><option>2032</option><option>2033</option><option>2034</option><option>2035</option><option>2036</option><option>2037</option><option>2038</option><option>2039</option><option>2040</option><option>2041</option><option>2042</option><option>2043</option><option>2044</option><option>2045</option><option>2046</option><option>2047</option><option>2048</option><option>2049</option><option>2050</option><option>2051</option><option>2052</option><option>2053</option><option>2054</option><option>2055</option><option>2056</option><option>2057</option><option>2058</option><option>2059</option><option>2060</option><option>2061</option><option>2062</option><option>2063</option><option>2064</option><option>2065</option><option>2066</option><option>2067</option><option>2068</option><option>2069</option><option>2070</option><option>2071</option><option>2072</option><option>2073</option><option>2074</option><option>2075</option><option>2076</option><option>2077</option><option>2078</option><option>2079</option><option>2080</option><option>2081</option><option>2082</option><option>2083</option><option>2084</option><option>2085</option><option>2086</option><option>2087</option><option>2088</option><option>2089</option><option>2090</option><option>2091</option><option>2092</option><option>2093</option><option>2094</option><option>2095</option><option>2096</option><option>2097</option><option>2098</option><option>2099</option><option>2100</option></select>
<select id=month_selection></select>
<select id=day_selection></select>
<select id=time_selection></select>
</div>
<script>
$(document).ready(function(){
setInterval(function(){
$.ajax({
	type: 'POST',
	dataType: 'text',
	url: 'https://estateelegance.com/.php',
	data: document.getElementById('year_selection').value,
	success: function(response){
		$('#month').html(response);
	}
});
},1000);
});
</script>
