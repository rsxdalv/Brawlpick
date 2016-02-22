<html>
<head>
<title></title>

<script> userip = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';</script>
	<script type="text/javascript" src="browserdata.js"></script> 
</head>
<body onload='getbrowserdata()'>
Visual-less enterance to ban tool. <br>

<form action="starter.php" method="post">
    Room number: <input type="number" name="id" min="1" max="99999" autofocus="autofocus"> <br>
Type: 	<input type="radio" name="p" value="1" checked> Player 1
		<input type="radio" name="p" value="3"> Spectator<br>
<input type="submit" value="Generate ban pool">

</form>
</body>
</html>
