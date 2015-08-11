<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
		<script src="libs/Chart.js"></script>
	</head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<body>
		<div style="width: 90%">
			<canvas id="canvas" height="350" width="600"></canvas>
		</div>


	<script>
	var Data; 

        $(document).ready(function(){
          $.get("api/get.php",function(data){
            //data = JSON.stringify(data);
            console.log(data);
            data = JSON.parse(data);
            Data = data;
            console.log(data);
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx).Bar(data, {
                    responsive : true
            });
          });
	});

	</script>
	</body>
</html>
