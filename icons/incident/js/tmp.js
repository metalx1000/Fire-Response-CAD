var dispatchTime, tac, msg, lat, lng;
var loc = "";
var id = getParm("id");
var units = [];
var unit = "EN24";
checkSupport();
Notification.requestPermission();
$("#secondsDisplay").hide();

$(document).ready(function(){
  checkUnit();
  update();



  $("#speech").click(function(){
    if(localStorage.speek != "false"){
      localStorage.speek = "false";
      $("#speechText").html("Speech is disabled.");
    }else{
      localStorage.speek = "true";
      $("#speechText").html("Speech is enabled.");
    }
  });
});

function startCounter(){
  var secondsOut = setInterval(function(){
    var seconds = sinceDispatch();
    $("#seconds").html(seconds);
    if(seconds == 60){
      speech("60 Seconds since Dispatch");
    }else if(seconds == 90){
      speech("90 Seconds since Dispatch");
    }else if(seconds > 120){
      $("#secondsDisplay").hide(); 
      clearInterval(secondsOut);
    }
  },1000);
}

function sinceDispatch(){
  var currentTime = new Date().getTime()/1000;
  var seconds = Math.floor(currentTime-dispatchTime);
  return seconds; 
}

function speech(message){
  if(localStorage.speek != "false"){
    $("#speechText").html("Speech is enabled.");
    var msg = new SpeechSynthesisUtterance(message);
    msg.lang = 'en-US';
    window.speechSynthesis.speak(msg);
  }else{
    $("#speechText").html("Speech is disabled.");
  }
}

function update(){
  $("#notesbox").hide();
  $.getJSON("getbyid.php", {id:id},function(data){
    for(var i=0;i<data.length;i++){

      //get call id
      callid = data[i].id;
      if(localStorage.calllid != callid || loc == ""){
        localStorage.calllid = callid;
        $("#unitInfo").html("<a href='changeunit.php'>Viewing Past Call For " + unit + "</a>");
        loc = data[i].loc.toUpperCase();
        loc = loc.replace("(AP)","");//For memory care 

        //Get residents based on Voters Reg
        getVoters(loc.replace("NAPLES FL",""));

        //add location to top of page
        $(".calladd").html(loc);
        $("#getmap").attr("href","https://www.google.com/maps/place/"+loc);
        loadMaps();

        //load date and time
        $("#date").html("Dispatched at: " + data[i].date);

        //get dispatched units
        units = data[i].units.split(",");
        loadUnits();

        //load comments
        $("#comments").html(data[i].cmt.split("RUN CARD")[0]);
        msg+=data[i].cmt.split("RUN CARD")[1];

        //get dispatch time
        dispatchTime = data[i].timestamp;
    
        //check if this is a new call
        if(sinceDispatch() < 120){
          $("#secondsDisplay").show();
          startCounter();
          notify();
        }

        msg+=" "+loc;

        if(data[i].lat > 26.181998 && data[i].lng < -81.751523 && unit == "EN24"){
          $("#notesbox").show();
          $("#notes").html("Call may be in North Zone!!!"); 
        }
      } 

    }  
  });
}

function loadUnits(){
  $("#units").html("");
  var tmp = [];
  msg = "";
  units.forEach(function(u){
    if(u.startsWith("M0")){
      u = u.replace("M0", "MEDIC ");
      tmp.push(u);
      msg += u+", ";
      $("#units").append(u+"<br>");
    }else if (u.startsWith("EN")){
      u = u.replace("EN", "ENGINE ");
      tmp.push(u);
      msg += u+", ";
      $("#units").append(u+"<br>");
    }else if (u.startsWith("BA")){
      u = u.replace("BA", "BATTALION ");
      tmp.push(u);
      msg += u+", ";
      $("#units").append(u+"<br>");
    }else if (u.startsWith("LA")){
      u = u.replace("LA", "LADDER ");
      tmp.push(u);
      msg += u+", ";
      $("#units").append(u+"<br>");
    }else if (u.startsWith("SQ")){
      u = u.replace("SQ", "SQUAD ");
      tmp.push(u);
      msg += u+", ";
      $("#units").append(u+"<br>");
    }else if (u.startsWith("TAC")){
      $("#comments").append("<br><br>Please use: "+u);            
    }
  });
  units=tmp;
}

function loadMaps(){

  //load map
  $("#map").attr("style","background-image: url('https://maps.googleapis.com/maps/api/staticmap?center="+loc+"&zoom=17&size=640x640&maptype=roadmap&markers=color:red%7C4798 "+loc+"&scale=1')");

  //load satellite image
  $("#sat").attr("style","background-image: url('https://maps.googleapis.com/maps/api/staticmap?center="+loc+"&zoom=17&size=640x640&maptype=hybrid&markers=color:red%7C4798 "+loc+"&scale=1')")            
  //load Street View
  $("#street").attr("style","background-image: url('https://maps.googleapis.com/maps/api/streetview?size=600x400&location="+loc+"')");



  $(".getmap").click(function(){
    window.open("https://www.google.com/maps/place/"+loc, '_blank');
  });
}

function removeA(arr) {
  var what, a = arguments, L = a.length, ax;
  while (L > 1 && arr.length) {
    what = a[--L];
    while ((ax= arr.indexOf(what)) !== -1) {
      arr.splice(ax, 1);
    }
  }
  return arr;
}

function checkUnit(){
  if(localStorage.unit != null){
    unit = localStorage.unit;
  }else{
    unit = "EN24";
  }
}

function checkSupport(){
  if(typeof Storage === "undefined"){
    alert("It seems your browser is either really old or you have it set to private mode. This program wants to remember what truck you are in, so please turn off private mode");
  }
}

function notify(){
  playsound("notify"); 
  notifyBox();
}

function notifyBox(){  
  var n = new Notification(unit,{ 
    body : loc, 
    icon : "../icons/favicon-32x32.png", 
    tag : "NEW-CALL" 
  });

  n.onclick = function(){window.focus();}
}

function playsound(snd){
  var sound = new Howl({
    src: [snd + '.ogg'],
    autoplay: true,
    loop: false,
    volume: 0.5,
    onend: function() {
      console.log('Finished!');
    }
  });
}

function getVoters(address){
  $("#residents").html('<h3 class="post-title">Possible Residents</h3>');
  $.getJSON("../../voters/getAddress.php",{address:address},function(data){
    if(data.length > 0){
      $("#residents").show();
      for(i=0;i<data.length;i++){
        var name = data[i].fname + " " + data[i].lname;
        name = name.toUpperCase();
        var dob = data[i].dob;
        var add = data[i].address;
        $("#residents").append('<p style="margin:0px" class="copyright text-muted list-inline text-center">'+name+' - '+dob+'</p>')
      }
    }else{
      $("#residents").hide();
    }

    $("#residents").append("<br>");
  });
}

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
