<!DOCTYPE html>
<html>
<head>
<link style="height : 10px;" rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
<title>{{$settings[0]->title}}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<style type="text/css">


#example1 {
   /*margin-top: 25px;*/
   margin-bottom: 25px;
   /*margin-left: 10px;*/
   border-radius: 20px;
   width: 100%;
   height: 670px;
   padding: 25px;
   background: url(assets/images/reachimage.jpg);
   background-repeat: no-repeat;
   background-size: 100% 100%;
}


.custom-btn {
  width: 130px;
  height: 40px;
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
   box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  outline: none;
}


/* 11 */
.btn-11 {
    height: 8%;
    width: 20%;
  border: none;
  background: rgb(233, 5, 5);
   margin-top:165px;
    background: linear-gradient(0deg, rgba(233, 5, 5, 1) 0%, rgba(233, 5, 5, 1) 100%);
    color: #fff;
    overflow: hidden;
}


.btn-11:hover {
    text-decoration: none;
    color: #fff;
}

.btn-11 span {
  position: relative;
  display: block;
  margin-left: 22px;
  width: 100%;
  height: 100%;
}

.btn-11:before {
    position: absolute;
    content: '';
    display: inline-block;
    top: -180px;
    left: 0;
    width: 30px;
    height: 100%;
    background-color: #fff;
    animation: shiny-btn1 3s ease-in-out infinite;
}
.btn-11:hover{
  opacity: .7;
}
.btn-11:active{
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
}


@-webkit-keyframes shiny-btn1 {
    0% { -webkit-transform: scale(0) rotate(45deg); opacity: 0; }
    80% { -webkit-transform: scale(0) rotate(45deg); opacity: 0.5; }
    81% { -webkit-transform: scale(4) rotate(45deg); opacity: 1; }
    100% { -webkit-transform: scale(50) rotate(45deg); opacity: 0; }
}

:root {
    --darkgray: #212329;
    --black: #222;
    --lightgray: #b1b1b1;
    --brightred: #F9423D;
    --white: #fff;
    --lightred: #f9433dcc;
    --lightblue: #337AF1;
}

@import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap');

#lab {
  width: 100%;
  height: auto;
  overflow: hidden;
  padding-bottom: 70px;
  position: relative;
  margin: 0 auto;
  margin-bottom: 2.5em;
  background: rgb(236, 236, 236);
  padding-bottom: 8rem;
  border-radius: 40px;
   min-height: 100vh
  -webkit-transition: all ease 500ms;
  -moz-transition: all ease 500ms;
  -o-transition: all ease 500ms;
  -ms-transition: all ease 500ms;
  transition: all ease 500ms;
}

h1 {
  font-family: bebas_neueregular ,sans-serif;
  font-size: 1.75em;
  padding: 0.2em 0 0.2em 0.2em;
  color: white;
  text-shadow: 0 0.06em 0 #424242;
  position: relative;
}

#lab h1 {
   color: var(--black);
  height: auto;
  width: 100%;

}

.beaker {
  -webkit-filter: drop-shadow(#424242 0px 1px 0px);
  border-bottom: 2em solid #FFF;
  border-left: 1em solid transparent;
  border-right: 1em solid transparent;
  border-radius: .5em;
  height: 0;
  width: 1em;
  position: absolute;
  right: 0.7em;
  bottom: 22%;
  font-size: 0.6em;
}

.beaker::before {
  border-left: .25em solid #FFF;
  border-radius: .25em;
  border-right: .25em solid #FFF;
  content: '';
  height: .25em;
  left: -.25em;
  position: absolute;
  top: -1em;
  width: 1em;
}

.beaker::after {
  border-left: .25em solid #FFF;
  border-right: .25em solid #FFF;
  content: '';
  height: 1em;
  left: 0;
  position: absolute;
  top: -1em;
  width: .5em;
}

.sectionheader {
  position: relative;
}

.lab_item {
  width: 200px;
  height: 230px;
  position: relative;
  display: inline-block;
  margin-right: -0px;
  margin-bottom: -3px;


}
.lab_item:hover {
    opacity: 1;
    transition: all 0.3s ease-in-out;
    transform: scale(1.2);
    z-index: 99;
    overflow: hidden;
}

.hexagon2 {
  position: absolute;
  width: 200px;
  height: 400px;
  top: -85px;
}

.hexagon {
  overflow: hidden;
  visibility: hidden;

  -webkit-transform: rotate(120deg);
  -moz-transform: rotate(120deg);
  -o-transform: rotate(120deg);
  -ms-transform: rotate(120deg);
  transform: rotate(120deg);
  cursor: pointer;
}

.hexagon-in1 {
  overflow: hidden;
  width: 100%;
  height: 100%;

  -webkit-transform: rotate(-60deg);
  -moz-transform: rotate(-60deg);
  -o-transform: rotate(-60deg);
  -ms-transform: rotate(-60deg);
  transform: rotate(-60deg);
}

.hexagon-in2 {
  -webkit-box-shadow: inset 0 0 0 200px rgba(176, 218, 212, 0.48);
  box-shadow: inset 0 0 0 200px rgba(176, 218, 212, 0.48);
  overflow: hidden;
  width: 100%;
  height: 100%;
  background-repeat: no-repeat;
  background-position: 50%;

  -webkit-background-size: 125%;
  -moz-background-size: 125%;
  background-size: 125%;
  visibility: visible;

  -webkit-transform: rotate(-60deg);
  -moz-transform: rotate(-60deg);
  -o-transform: rotate(-60deg);
  -ms-transform: rotate(-60deg);
  transform: rotate(-60deg);

  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -ms-transition: all 0.5s ease;
  transition: all 0.5s ease;
}
.hexagon-in2:hover {
  -webkit-box-shadow: inset 0 0 0 0px #B0DAD4;
  box-shadow: inset 0 0 0 0px #B0DAD4;
}

.hexagon-title{
   height: 100%;
    width: 60%;
    margin: 0 auto;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-transform: uppercase;
    color: var(--white);
    font-weight: 700;
    font-size: 1.2rem;
    transition: opacity 350ms;
    text-shadow: 2px 2px 2px var(--darkgray);
}
.services-heading {
    color: var(--black);
    text-align: center;
    margin-bottom: 1rem;
    padding-top: 3rem;
    font-size: 1.2rem;
}


#lab article {
  padding-top: 1em;
  width: 820px;
  margin: 0 auto;
}

.lab_item:nth-child(7n-2) {
  margin-left: 101px;
}

.lab_item:nth-child(n+5) {
  margin-top: -55px;
}

@media (max-width: 1015px) {
  #lab {
  width: 100%;
}

}

@media (max-width: 820px) {
  .lab_item:nth-child(5n-1) {
  margin-left: 102px;
}

.lab_item:nth-child(n+4) {
  margin-top: -62px;
}

.lab_item:nth-child(7n-2) {
  margin-left: 0px;
}

.lab_item:nth-child(n+5) {
  margin-top: -56px;
}

#lab article {
  width: 610px;
}

}

@media (max-width: 640px) {
  #lab article {
  width: 405px;
}

.lab_item:nth-child(5n-1) {
  margin-left: 0px;
}

.lab_item:nth-child(3n) {
  margin-left: 102px;
}

.lab_item:nth-child(n+3) {
  margin-top: -56px;
}

}

@media (max-width: 450px) {
  #lab article {
  width: 300px;
}

.lab_item:nth-child(3n) {
  margin-left: 0px;
}

.lab_item:nth-child(2n) {
  margin-left: 102px;
}

.lab_item:nth-child(n+2) {
  margin-top: -56px;
}

}

@media (max-width: 1024){
  .product{
    margin-left: 922px;
  }
}

























































/*.services-section {
    background-color: #cccccc;
    /*background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);;*/
    /*width: 100%;
    height: auto;
    min-height: 100vh;
    padding-bottom: 8rem;
    border-radius: 40px;

}

.services-heading {
    color: var(--black);
    text-align: center;
    margin-bottom: 1rem;
    padding-top: 3rem;
    font-size: 1.2rem;
}

.services {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    transform: translateY(80px);
    padding: 0;
    /*background-color: var(--darkgray);*/
   /* height: auto;
}

.services-cell {
    flex: 0 1 250px;
    max-width: 250px;
    height: 275px;
    margin: 20px;
    position: relative;
    text-align: center;
    z-index: 1;
    box-shadow:  0px 0px 15px 0px rgba(0,0,0,0.8);
    clip-path: polygon( 50% 0%, 
                        100% 25%,
                        100% 75%,
                        50% 100%,
                        0% 75%,
                        0% 25%);
    cursor: pointer;
}

.services-cell_img {
    object-fit: cover;
    object-position: center;
}

.services-cell-text {
    height: 100%;
    width: 60%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-transform: uppercase;
    color: var(--white);
    font-weight: 700;
    font-size: 1.2rem;
    transition: opacity 350ms;
    text-shadow: 2px 2px 2px var(--darkgray);
}

.services-cell::before, .services-cell::after, .services-cell_img {
    top: -50%;
    width: 100%;
    height: 200%;
    display: block;
    position: absolute;
    clip-path: polygon( 50% 0%, 
                        100% 25%,
                        100% 75%,
                        50% 100%,
                        0% 75%,
                        0% 25%);
    z-index: -1;
}

.services-cell:hover {
    opacity: 1;
    transition: all 0.3s ease-in-out;
    transform: scale(1.2);
    z-index: 99;
    overflow: hidden;
}

.services-cell::before {
    content: "";
    position: absolute;
    opacity: 0.4;
    width: 350px;
    height: 70px;
    background-color: var(--white);
    top: 50;
    left: 0;
    z-index: 1;
    transform: rotate(45deg);
    transition: transform 1.5s;
}

.services-cell:hover::before {
    transform: translate(-100px, 600%) rotate(45deg);
    transition: transform 0.5s;
}

#optinforms-form5-button:hover {
    background-color: : #d8c3a5!important;
    color: black!important;
}*/

@media (min-width: 769px) and (max-width: 992px) {
  .btn-responsive {
    padding:4px 9px;
    font-size:90%;
    line-height: 1.2;

      
    }
}


</style>



</head>
<body>

<div id="example1">
    <button onclick="window.location='{{url('vendor/registration')}}'" type="button" class="custom-btn btn-11" style="float: left; margin-top: 300px">I am a Seller</button>
    <button onclick="window.location='{{url('user/registration')}}'"  type="button" class="custom-btn btn-11" style="float: right; margin-top: 300px" disabled>I am a Buyer</button>

     <div style="margin-top:355px" >
         <a href="{{url('/vendor')}}" style="float: left; background-color:white; display: block;    width: 8%;" onMouseOver="this.style.backgroundColor='#d8c3a5'" onMouseOut="this.style.backgroundColor='white'" class="btn btn-block">Sign In</a>
         <a href="{{url('user/login')}}" style="float: right; background-color:white; display: block;    width: 8%;" onMouseOver="this.style.backgroundColor='#d8c3a5'" onMouseOut="this.style.backgroundColor='white'" class="btn btn-block">Sign In</a>
     </div>

     <div style="margin-top:565px;">
         <h6 style="text-align:center;">B2B Online Distribution</h6>
     </div>

    <div class="d-grid gap-2 d-md-block text-center">
      <a href="{{url('user/login')}}" style="color: black; background-color:white;"  class="btn btn-outline-secondary"  onMouseOver="this.style.backgroundColor='#d8c3a5'" onMouseOut="this.style.backgroundColor='white'">Product Catalogue</a>
    </div>

</div>          <!--   <div class="text-center Product" style="margin-top: 0px; margin-left: -516px;">
              <a href="{{url('/home')}}" class="btn btn-block"  style="width: 11%;background-color: white;text-align: center;margin-left:1589px;"  onMouseOver="this.style.backgroundColor='#d8c3a5'" onMouseOut="this.style.backgroundColor='white'">Product Catalogue</a>
             </div> -->


          



<div class="col-lg-12 col-md-12">
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for slides -->


          
          <div class="carousel-inner">
            @foreach($ourofferings as $key => $banner)
            <div class="item {{$key == 0 ? 'active':''}}">
              <img src="{{url('assets/images/sliders')}}/{{$banner->image}}" style="width:100%; ">
            </div>
            @endforeach
          </div>
          
        
          </div>
        </div>





<!-- <div class="container">
  <h2>Carousel Example</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
  <!--   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
 -->
    <!-- Wrapper for slides --> 
    <!-- <div class="carousel-inner">
      <div class="item active">
        <img src="la.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="chicago.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="ny.jpg" alt="New york" style="width:100%;">
      </div>
    </div>
 -->
    <!-- Left and right controls -->
<!--     <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div> -->



</body>
</html>
