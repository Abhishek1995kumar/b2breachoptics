@extends('includes.newmaster')

@section('content')

    <div class="container-fluid">
    <section>
        <div class="row margin-left-0 margin-right-0" style="background-color:#c2af94; border-radius : 20px; background-image: linear-gradient(to right, #c2af94, #d8c3a5, #c2af94);">

            <div style="margin: 0% 0px 0% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1 style="color : black; margin-bottom : 0;">{{$language->faq}}</h1>
                </div>
            </div>

        </div>
    </section>
    </div>

    <div class="home-wrapper padding-bottom-0">
        <!-- Starting of faq area -->
        <div class="section-padding padding-top-0 padding-bottom-0 wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="styled-faf-fullDiv">
                            <div class="panel-group product-faq" id="asked-questions">
                                @foreach($faqs as $faq)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a href="#asked-questions-{{$faq->id}}" data-parent="#asked-questions" data-toggle="collapse" aria-expanded="false">
                                                {{$faq->question}}
                                            </a>
                                        </div>
                                        <div id="asked-questions-{{$faq->id}}" class="panel-collapse collapse" aria-expanded="false">
                                            <div class="panel-body">
                                                <p>{!! $faq->answer !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of faq area -->
    </div>

@stop

@section('footer')

@stop