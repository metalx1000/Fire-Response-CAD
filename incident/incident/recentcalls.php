<!DOCTYPE html>
<html lang="en">
<head>

  <?php include("head.php");?>
  <title>Recent Calls</title>
  <?php include("fav.php");?>
  <style>
    .well{
      padding : 5px;
      margin : 5px;
    }
    h3,.info{
      margin : 10px;
    }
  </style>
  <script>
    var time = getParm("time");
    if(time === null){time = 30};
    $(document).ready(function(){
      $("#time").html(time + " Minutes");
      if(time == "1440"){$("#time").html( "24 Hours")};
      getCalls();
      setInterval(getCalls,60000);

      $("#unitInfo").html('<a href="index.php">CAD</a>');

      //filter list
      $("#filter").on("input",filterList);
    });

    function filterList(){
      var vals = $("#filter").val().toUpperCase().split(" ");
      $(".item").show();
      vals.forEach(function(f){
        $(".item").each(function(){
          console.log(f);
          var v = $(this).is(":contains('"+f+"')");
          if(v && $(this).is(':visible')){
            $(this).show();
          }else{
            $(this).hide();
          }
        });
      });

    }

    function getCalls(){
      $("#list").html("");
      $.getJSON("getrecent.php",{time,time},function(data){
        //if there haven't been any recent calls
        if(data.length < 1){
          $("#list").html("<h1>It's been pretty quiet</h1>");
          $("#list").append("<h3>No calls in the last " + time + " minutes</h3>");
          $("#list").append("<img class='img-responsive' src='res/shhhh.jpg'>");
        }

        for(var i=0;i<data.length;i++){
          var units = data[i].units.replace(",ZRC/SOUTH", "");
          units = units.replace("TNGN,","<br>");
          var id = data[i].id;
          $("#list").append('<a href="byid.php?id='+id+'"><div class="well item" >'+
            '<h3>'+units+'</h3>'+
            '<div class="info">'+data[i].loc.toUpperCase()+'<br>'+
            data[i].date.toUpperCase()+'</div>'+
          '</div></a>');
        } 
      });
    };


    function getParm(name, url) {
        if (!url) {
          url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
  </script>
</head>
<body>
    <?php include("nav.php");?>

<div class="container">
  <br>
  <br>
  <h2>Calls In The Last <span id="time"></span></h2>
  <div>
    <input type="text" class="form-control" id="filter" placeholder="Type here to Fliter List">
  </div>
  <div id="list"></div>
</div>

</body>

</html>

