<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link style="height : 10px;" rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
<title>{{$settings[0]->title}}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<style type="text/css">
	
body {
    width: 100%;
    margin: 0px auto;
    overflow: hidden;
}

div.stretchy-wrapper{
    width: 100%;
    height: 50px;
    padding-bottom: 56.25%; /* 16:9 */
    position: relative;
    overflow: hidden;
}

div.stretchy-wrapper > div {
    position: absolute;
    top: -16.75%; bottom: 0; left: 0; right: 0;
}
button {
  display: none; 
  position: absolute;
  top: 95%;
  left: 94%;
  width: 5%;
  /*margin-right:20px;*/
  background-color: black;
  color: white;


}

</style>

</head>
<body>
<div class="stretchy-wrapper">
    <div>
		<video id="myvideo" width="100%" height="inherit" controls playsinline autoplay muted>
			<source src="http://reachoptic.com/assets/images/Reachlogo.mp4" type="video/mp4">
		</video>
    </div>
</div> 
<button onclick="skip()">Skip</button>  

<script type="text/javascript">
var video = document.getElementById("myvideo");
var button = document.querySelector("button");
var firstRun = true;

video.addEventListener("timeupdate", function(){
    if(this.currentTime > 2 && firstRun) {
        this.play();
        firstRun = false;
        button.style = "display: block";
    }
});

function skip(){
    video.currentTime = 20;
    video.play();
    button.style = "";
    window.location.href="{{url('/homepage')}}";
}
</script>
<script type="text/javascript">

var vid = document.getElementById("myvideo");
vid.onended = function() {
    console.log("hiiii");
    window.location.href="{{url('/homepage')}}";
};

</body>
</html>

