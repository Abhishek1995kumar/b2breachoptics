@extends('includes.newmaster')

@section('content')

    <div class="container-fluid">
    <!--<section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">-->
        <section>
       
        <div class="row margin-left-0 margin-right-0" style="background-color:#c2af94; border-radius : 20px; background-image: linear-gradient(to right, #c2af94, #d8c3a5, #c2af94);">
            <div style="margin: 0% 0px 0% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1 style="color : black; margin-bottom : 0;">{{$language->about_us}}</h1>
                </div>
            </div>
        </div>
    </section>
    </div>
    
    <!--<section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">-->
    <!--    <div class="row" style="background-color:rgba(0,0,0,0.7);">-->

    <!--        <div style="margin: 3% 0px 3% 0px;">-->
    <!--            <div class="text-center" style="color: #FFF;padding: 20px;">-->
    <!--                <h1>{{$language->about_us}}</h1>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->


    <div class="home-wrapper">
         <!--Starting of about us area -->
        <div class="section-padding padding-top-0 padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                
                <div class="row" style="display: flex;  align-items: center; justify-content: center;">
                    <div class="col-md-6 about_us_image_div">
                        <a href="" target="_blank">
                            <img class="about_us_image" src="assets/images/about_us/Sebisir.jpg" alt="">
                        </a>
                    </div>
                     
                    <div class="col-md-6 about_us_image_div" >
                        <a href="" target="_blank">
                            <img class="about_us_image" src="assets/images/about_us/Madam.png" alt="">
                        </a>
                    </div>
                    
                </div>
                
                <div class="row" style="display: flex;  align-items: center; justify-content: center;">
                     <div class="about_us_writeup col-md-11">
                       <h1>{!! $pagedata->about !!}</h1> 
                    </div>
                </div>
        </div>
        </div>
    </div>
    
    
    <!--<div class="home-wrapper">-->
        <!-- Starting of about us area -->
    <!--    <div class="section-padding padding-top-0  wow fadeInUp">-->
    <!--        <div class="container-fluid">-->
    <!--            <div class="row">-->
    <!--            <div class="col-md-4 about_us_image_div padding-right-0 padding-left-0 margin-right-0">-->
    <!--                <a href="" target="_blank">-->
    <!--                    <img class="about_us_image" src="assets/images/about_us/men.jpg" alt="">-->
    <!--                </a>-->
                    
    <!--                <a href="" target="_blank">-->
    <!--                    <img class="about_us_image" src="assets/images/about_us/women.jpg" alt="">-->
    <!--                </a>-->
    <!--            </div>-->
                
    <!--            <div class="about_us_writeup_2 col-md-4">-->
    <!--               <h1>{!! $pagedata->about !!}</h1> -->
    <!--            </div>-->
    <!--            <div class="col-md-4 about_us_image_div padding-right-0 padding-left-0 margin-right-0">-->
    <!--                <a href="" target="_blank">-->
    <!--                    <img class="about_us_image" src="assets/images/about_us/women.jpg" alt="">-->
    <!--                </a>-->
                    
    <!--                <a href="" target="_blank">-->
    <!--                    <img class="about_us_image" src="assets/images/about_us/men.jpg" alt="">-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    </div>-->
    <!--</div>-->

@stop

@section('footer')

@stop