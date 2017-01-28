<!DOCTYPE html>
<html lang="en">
<head>
  <title>Units</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php include("fav.php");?>

  <script>
    var units=[];
    $(document).ready(function(){
      $.get("getunits.php",function(data){
        units = data.split(",");
        units = sort_unique(units);
      }).done(function(){
        $(".list-group").html("");
        units.forEach(function(u){
          if( !u.includes("ZRC") && !u.includes("TNG") && !u.includes("TAC")){
            $(".list-group").append('<a href="#" class="list-group-item">'+u+'</a>');
          }
        });
      });

      $(".list-group").on("click",".list-group-item",function(){
        localStorage.unit = $(this).html();
        window.location.href = "index.php";
      });
    });

    function sort_unique(arr) {
      return arr.sort().filter(function(el,i,a) {
        return (i==a.indexOf(el));
      });
    }
  </script>
</head>
<body>

<div class="container">
  <h2>Select a Unit</h2>
  <div class="list-group">
  </div>
</div>

</body>
</html>
