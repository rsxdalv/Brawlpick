<html>
<head>
	<title>Wcale nie mapbantool</title>
	

	<link rel="Stylesheet" type="text/css" href="style.css" />
	<meta charset="UTF-8">
	
		<script type="text/javascript">
		
		function refresher()
		{
			dostuffandthings("ref");
			setInterval(function() { dostuffandthings("ref") }, 5000);
		}
		
		
		
			function getXMLHttpRequest() {
				var request = false;
				try {
					request = new XMLHttpRequest();
				}
				catch(err1) {
					try {
						request = new ActiveXObject('Msxml2.XMLHTTP');
					}
					catch(err2) {
						try {
							request = new ActiveXObject('Microsoft.XMLHTTP');                
						} 
						catch(err3) {
							request = false;
						}
					}
				}
				return request;
			}      
			var r;
			r = getXMLHttpRequest();
			function processResponse() {
				if (r.readyState == 4) {
					if (r.status == 200) {
						document.getElementById("bantool").innerHTML=r.responseText; 
					};
				};
			}
			function dostuffandthings(a) {
			
			<?php
			$id=$_GET['id'];
			echo "var id=\"$id\";";
			?>
			
			var adres="banprocessing.php";
				adres=adres+"?id="+id+"&map="+a;
				r.open('GET', adres , true);
				r.onreadystatechange = processResponse;
				r.send();
				//r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			}
		</script>
	
</head>

<body onload='refresher()'>

<div id="bantool">

<div id="blackguard"><img src="pic/blackguard.jpg" onclick='dostuffandthings("blackguard")'></div>
<div id="kings"><img src="pic/kings.jpg" onclick='dostuffandthings("kings")'></div>
<div id="mammoth"><img src="pic/mammoth.jpg" onclick='dostuffandthings("mammoth")'></div>
<div id="ship"><img src="pic/ship.jpg" onclick='dostuffandthings("shipwreck")'></div>
<div id="shithall"><img src="pic/shithall.jpg" onclick='dostuffandthings("shithall")'></div>
<div id="stadium"><img src="pic/stadium.jpg" onclick='dostuffandthings("stadium")'></div>
<div id="twillight"><img src="pic/twillight.jpg" onclick='dostuffandthings("twillight")'></div> <br>

</div>

<div id="tool"></div>
</body>

</html>