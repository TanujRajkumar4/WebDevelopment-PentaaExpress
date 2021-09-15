<html>
	<head>
		<title>Sum Html Textbox Values using jQuery/JavaScript</title>
		<style>
			body {
				font-family: sans-serif;
			}
			#summation {
				font-size: 18px;
				font-weight: bold;
				color:#174C68;
			}
			.txt {
				background-color: #FEFFB0;
				font-weight: bold;
				text-align: right;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	</head>
	<body>
<table width="300px" border="1" style="border-collapse:collapse;background-color:#E8DCFF">
	<tr>
		<td width="40px">1</td>
		<td>Butter</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Cheese</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Eggs</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Milk</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Bread</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>6</td>
		<td>Soap</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr id="summation">
		<td>&nbsp;</td>
		<td align="right">Sum :</td>
		<td align="center"><span id="sum">0</span></td>
	</tr>
</table>


<script>
	$(document).ready(function(){

		//iterate through each textboxes and add keyup
		//handler to trigger sum event
		$(".txt").each(function() {

			$(this).keyup(function(){
				calculateSum();
			});
		});

	});

	function calculateSum() {

		var sum = 0;
		//iterate through each textboxes and add the values
		$(".txt").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}

		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
		$("#sum").html(sum.toFixed(2));
	}
</script>
</body>
</html>