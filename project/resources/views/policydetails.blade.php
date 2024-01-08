@extends('includes.newmaster')

@section('content')

    <!-- Blog Post area -->
    <div class="section-padding blog-post-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{$blog->titles}}</h2>
                       <!--  <ul class="blog-info">
                            <li><i class="fa fa-clock-o"></i> {{$blog->created_at->diffForHumans()}}</li>
                            @if($blog->source != null)
                                <li>Source: {{$blog->source}}</li>
                            @endif
                            <li><i class="fa fa-eye"></i> {{$blog->views}}</li>
                        </ul> -->
                    </div>
                </div>
            </div>
           <!--  <div class="row">
                <div class="col-md-12">
                <!--     <div class="row"> -->
                       <!--  <div class="col-md-8"> -->
                              <!-- <video     width= "739px" height="415px" controls="">
                                        <source src="http://localhost/reachoptic/assets/images/products/1637580646demo.mp4" id="adminvideo2" type="video/mp4">
                                    </video> -->
                           <!--  <p><img src="{{url('assets/images/blog')}}/{{$blog->featured_image}}" alt=""></p> -->
 
                            <div class="entry-content">
                                {!! $blog->details !!}
                            </div>
                            <!-- <div class="social-sharing">
                                <p>{{$language->share_in_social}}:</p> -->
                                <!-- AddToAny BEGIN -->
                                <!-- <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_pinterest"></a>
                                    <a class="a2a_dd" href="https://www.geniusocean.com"></a>
                                </div> -->
                                <!-- <script async src="https://static.addtoany.com/menu/page.js"></script> -->
                                <!-- AddToAny END -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="post-sidebar-area">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('footer')

@stop