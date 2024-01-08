<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="{{$code[0]->meta_keys}}">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
	<link rel="stylesheet" type="text/css" href="{{url('/assets/css/pres.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css')}}">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- for seet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.32/sweetalert2.css" integrity="sha512-e+TwvhjDvKqpzQLJ7zmtqqz+5jF9uIOa+5s1cishBRfmapg7mqcEzEl44ufb04BXOsEbccjHK9V0IVukORmO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <link style="height : 10px;" rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
    <title>{{$settings[0]->title}} > Prescription</title>
    
</head>
<body>
    <style>
        .swal2-container.swal2-center > .swal2-popup {
            font-size: 18px;
        }
    </style>
	<header class="header">
		<img alt="" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}">
	</header>
    <div class="section">
		<div class="grid-column-two">
			<div class="form_image">
				<div class="card-image">
					<div class="img-div-data">
					    @if($main == $productdata->lenscolor)
    						<div class="img-div-data">
    							<img src="{{ URL::asset('assets/images/products/'.$productdata->feature_image)}}" alt="{{$main}} Color Product">
    						</div>
    					@else
    						<div class="img-div-data">
    							<img src="{{ URL::asset('assets/images/product_attr/'.$attrgallery->attr_imgs)}}" alt="{{$main}} Color Product">
    						</div>
    					@endif
					</div>
				</div>
			</div>
			<form action="" class="addtocart-form" id="PrescriptionForm" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
				<div class="title">
					<h2>Get Your Contacts</h2>
				</div>
			    @if($main == $productdata->lenscolor)
				    <input type="hidden" value="{{$productdata->feature_image}}" name="productImage">
				@else
				    <input type="hidden" value="{{$attrgallery->attr_imgs}}" name="productImage">
				@endif

				<!-- Progressive bar -->

				<div class="progressbar">
					<div class="progress-step progress-step-active" data-title="Add Prescritons"></div>
					<div class="progress-step" data-title="Fill in right eye <?php echo "(OD)" ?>"></div>
					<div class="progress-step" data-title="Fill in Both Eye <?php echo "(OD & OS)" ?>"></div>
					<div class="progress-step" data-title="Fill in left eye <?php echo "(OS)" ?>"></div>
					<div class="progress-step" data-title="select-quantity"></div>
					<div class="progress-step" data-title="Great!<span>Let's finish up"></div>
				</div>
				<hr>
				<div class="form-step form-step-active" id="form-1">
					<div class="back">
						<a class="backbtn main-back">Back</a>
					</div>
					<div class="form-data" id="form-model">
						<div class="title"><h2>Add Prescritons</h2></div>
						<div class="main_box">
							<div class="input-group">
								<label for="uploadFile" class="uploadImage">
								    <p class="showImageData">file type - png, jpg, gif and jpeg required</p>
								    Upload File
								    <i class="fa fa-camera"></i>
								</label>
								<input  id="uploadFile" accept="image/png, image/jpg, image/gif, image/jpeg"  class="upload" name="presc_image" type="file">
							</div>
							<div class="input-group">
								<div class="fill-manual">
								    Fill in manually
								    <i class="fa fa-hand-paper-o"></i>
								</div>
							</div>
							<div class="skip-btn">
								<a href="javascript:void(0)" class="btn next-1">Skip and send leter</a>
							</div>
						</div>
					</div>

					<div class="form-data" id="img-model">
						<div class="title"><h2>Add Prescritons</h2></div>
						<div class="main_box">
							<div class="input-group img-div">
								<img  id="showFile" src="">
							</div>
							<div class="input-group img-name">
								<label for="" id="showLabel"></label>
							</div>
							<div>
								<a href="javascript:void(0)" class="btn img-next">Select Your Quantity</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-step" id="form-2">
					<div class="back">
						<a href="javascript:void(0)" class="backbtn back-1">Back</a>
					</div>
					<div class="form-data">
						<div class="title"><h2>Fill in right eye <?php echo "(OD)" ?></h2></div>
						<div class="main_box">
							<div class="option-input-group">
								@if($productdata->lenstype == "MultiFocal")
								    <input type="hidden" id="lenseType" value="{{$productdata->lenstype}}">
									<div class="right button-div">
										<button role="button" type="button" class="power-button" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="rsphere" type="text" class="getPowerRight" readonly>
										</button>
										<div class="data-table">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-right" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-right" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-right" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
    							        <p>ADD</p>
										<select name="rpower" id="multi_rpower" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->addpower) as $addpowerr)
												<option value="{{$addpowerr}}">{{$addpowerr}}</option>
											@endforeach
											<option value="High">High</option>
											<option value="Low">Low</option>
										</select>
										<span class="massage">This field is required</span>
									</div>
									<div class="right" style="display: flex; align-items:center;">
    							        <p>BC</p>
										<select name="rbc" id="rbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $basecurvee)
												<option value="{{$basecurvee}}" selected>{{$basecurvee}}</option>
											@endforeach
										</select>
										<span class="massage">This field is required</span>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
    							        <p>DIA</p>
										<select name="rdia" id="rdia" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $diameterr)
												<option value="{{$diameterr}}" selected>{{$diameterr}}</option>
											@endforeach
										</select>
										<span class="massage">This field is required</span>
									</div>
								@elseif($productdata->lenstype == "toric & Astigmatism" || $productdata->lenstype == "toric and Astigmatism")
								    <input type="hidden" id="lenseType" value="{{$productdata->lenstype}}">
									<div class="right button-div">
										<button role="button" type="button" class="power-button" id="rightSperesBtn" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="rsphere" type="text" class="getPowerRight" readonly>
										</button>
										<div class="data-table"  onclick="powerRightToricPlusMinusList(event)">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-right" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-right" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-right" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
    							        <p>Axis</p>
										<select name="Raxis" id="raxis" class="sphare" style="position: realative; text-align: center;">
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->axisnew) as $axisn)
												<option value="{{$axisn}}">{{$axisn}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center;">
    							        <p>DIA</p>
										<select name="rdia" id="rdia" class="sphare" style="position: realative; text-align: center;" readonly>
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $di)
												<option value="{{$di}}" selected>{{$di}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
    							        <p>BC</p>
										<select name="rbc" id="rbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $basecu)
												<option value="{{$basecu}}" selected>{{$basecu}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
    							        <p>CYL</p>
									    <select name="rcyl" id="rcyl" onchange="selectRightCylinder(event)" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->cylindernew) as $cylinder)
												<option value="{{$cylinder}}">{{$cylinder}}</option>
											@endforeach
										</select>
									</div>
								@elseif($productdata->lenstype == "Single Vision" || $productdata->lenstype == "Plano")
								    <input type="hidden" id="lenseType" value="{{$productdata->lenstype}}">
									<div class="right button-div">
										<button role="button" type="button" class="power-button" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="rsphere" type="text" class="getPowerRight" readonly>
											<span class="massage">This field is required</span>
										</button>
										<div class="data-table">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-right" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-right" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-right" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
							            <p>DIA</p>
										<select name="rdia" id="rdia" class="sphare" style="position: realative; text-align: center;" readonly>
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $diam)
												<option value="{{$diam}}" selected>{{$diam}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center;">
							            <p>BC</p>
										<select name="rbc" id="rbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $base)
												<option value="{{$base}}" selected>{{$base}}</option>
											@endforeach
										</select>
									</div>
								@else
    								<div class="right">
    									<select name="" id="" class="sphare">
    										<option value=""></option>
    									</select>
    								</div>
								@endif
							</div>
							<div class="show-prescription">
								<button class="showPrescription" type="button">How to read my prescriptions ?</button>
							</div>
							<div class="input-group">
								<input type="checkbox" name="same_rx_both" id="both_eyes" class="both_eyes"><p>Same Rx for both eyes</p>
							</div>
							<div>
								<a href="javascript:void(0)" class="btn next-2">Continue to Left Eye</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-step" id="form-3">
					<div class="back">
						<a href="javascript:void(0)" class="backbtn back-2">Back</a>
					</div>
					<div class="form-data">
						<div class="title"><h2>Fill in Both Eye <?php echo "(OD & OS)" ?></h2></div>
						<div class="main_box">
							<div class="option-input-group">
							@if($productdata->lenstype == "MultiFocal" || $productdata->lenstype == "toric & Astigmatism" ||$productdata->lenstype == "toric and Astigmatism" || $productdata->lenstype == "Single Vision" || $productdata->lenstype == "Plano")
								<div class="right button-div">
									<button role="button" type="button" class="power-button" aria-haspopup="listbox">
										<span type="text" class="sphere-data">Power</span>
										<input name="bsphere" type="text" class="getPowerBoth" readonly>
									</button>
									<div class="data-table">
										<div class="range-list">
											<svg width="100%" xmlns="http://www.w3.org/2000/svg">
												<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<svg width="100%" xmlns="http://www.w3.org/2000/svg">
												<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
													<path d="M13.7 7.85H2M7.85 13.7V2"></path>
												</g>
											</svg>
										</div>
										<div class="value">
											<li class="power-data-both" value="N/A">N/A</li>
										</div>
										<div class="sphare-data">
											<div class="min-data">
												<ul>
													@foreach(explode(',',$productdata->powermin) as $mi)
														<li class="power-data-both" value="{{$mi}}">{{$mi}}</li>
													@endforeach
												</ul>
											</div>
											<div class="max-data">
												<ul>
													@foreach(explode(',',$productdata->powermax) as $ma)
														<li class="power-data-both" value="{{$ma}}">{{$ma}}</li>
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							@endif
							@if($productdata->lenstype == "MultiFocal")
							    <div class="right" style="display: flex; align-items:center;">
							        <p>ADD</p>
									<select name="bpower" id="multi_bpower" class="sphare" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->addpower) as $addpowerr)
											<option value="{{$addpowerr}}">{{$addpowerr}}</option>
										@endforeach
										<option value="High">High</option>
										<option value="Low">Low</option>
									</select>
								</div>
								<div class="right" style="display: flex; align-items:center;">
							        <p>BC</p>
									<select name="Bbc" id="multi_bbc" style="position: realative; text-align: center;">
									    <option value=""></option>
									    <option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->basecurve) as $basecu)
											<option value="{{$basecu}}">{{$basecu}}</option>
										@endforeach
									</select>
								</div>
									
								<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
							        <p>DIA</p>
									<select name="Bdia" id="multi_bdia" style="position: realative; text-align: center;" readonly>
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->diameter) as $diameterr)
											<option value="{{$diameterr}}" selected>{{$diameterr}}</option>
										@endforeach
									</select>
								</div>
							@elseif($productdata->lenstype == "toric & Astigmatism" || $productdata->lenstype == "toric and Astigmatism")
							    <div class="right" style="display: flex; align-items:center;">
							        <p>Axis</p>
									<select name="Baxis" id="toric_baxis" class="sphare" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->axisnew) as $axisn)
											<option value="{{$axisn}}">{{$axisn}}</option>
										@endforeach
									</select>
								</div>
								<div class="right" style="display: flex; align-items:center;">
							        <p>DIA</p>
									<select name="Bdia" id="toric_bdia" class="sphare" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->diameter) as $di)
											<option value="{{$di}}" selected>{{$di}}</option>
										@endforeach
									</select>
								</div>
								<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
							        <p>BC</p>
									<select name="Bbc" id="toric_bbc" class="sphare" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->basecurve) as $basecu)
											<option value="{{$basecu}}">{{$basecu}}</option>
										@endforeach
									</select>
								</div>
								<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
							        <p>CYL</p>
									<select name="Bcyle" id="toric_bcyle" class="sphare" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->cylindernew) as $cylinder)
											<option value="{{$cylinder}}">{{$cylinder}}</option>
										@endforeach
									</select>
								</div>
							@elseif($productdata->lenstype == "Single Vision" || $productdata->lenstype == "Plano")
								<div class="right" style="display: flex; align-items:center;">
								    <p>DIA</p>
									<select name="Bdia" id="sph_bdia" style="position: realative; text-align: center;">
									    <option value=""></option>
									    <option value="N/A">N/A</option>
									    @foreach(explode(',',$productdata->diameter) as $di)
										    <option value="{{$di}}">{{$di}}</option>
										@endforeach
									</select>
								</div>
								<div class="right" style="display: flex; align-items:center;">
							        <p>BC</p>
									<select name="Bbc" id="sph_bbc" style="position: realative; text-align: center;">
										<option value=""></option>
										<option value="N/A">N/A</option>
										@foreach(explode(',',$productdata->basecurve) as $di)
										    <option value="{{$di}}">{{$di}}</option>
										@endforeach
									</select>
								</div>
							@else
								<div class="right">
									<select name="" id="both-eye" class="left-select">
										<div class="category">
											<div class="minus">
												<option value="">Power</option>
											</div>
										</div>
									</select>
								</div>
							@endif
							</div>
							<div class="show-prescription">
								<button class="showPrescription2" type="button">How to read my prescriptions ?</button>
							</div>
							<div class="input-group">
								<input type="checkbox" name="same_rx_both" id="both_eyes-2" class="both_eyes-2"><p>Same Rx for both eyes</p>
							</div>
							<div>
								<a href="javascript:void(0)" class="btn next-3">Select Quantity</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-step" id="form-4">
					<div class="back">
						<a href="javascript:void(0)" class="backbtn back-3">Back</a>
					</div>
					<div class="form-data">
						<div class="title"><h2>Fill in left eye <?php echo "(OS)" ?></h2></div>
						<div class="main_box">
							<div class="option-input-group">
								@if($productdata->lenstype == "MultiFocal")
								    <div class="right button-div">
										<button role="button" type="button" class="power-button" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="Lsphere" type="text" class="getPowerLeft" readonly>
										</button>
										<div class="data-table">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-left" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-left" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-left" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>ADD</p>
										<select name="Lpower" id="multi_lopwer" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->addpower) as $addpowerr)
												<option value="{{$addpowerr}}">{{$addpowerr}}</option>
											@endforeach
											<option value="High">High</option>
											<option value="Low">Low</option>
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>BC</p>
										<select name="LBc" id="multi_lbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $basecurvee)
												<option value="{{$basecurvee}}">{{$basecurvee}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
								        <p>DIA</p>
										<select name="LDia" id="multi_ldia" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $diameterr)
												<option value="{{$diameterr}}" selected>{{$diameterr}}</option>
											@endforeach
										</select>
									</div>
								@elseif($productdata->lenstype == "toric & Astigmatism" || $productdata->lenstype == "toric and Astigmatism")
								    <div class="right button-div">
										<button role="button" type="button" class="power-button" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="Lsphere" type="text" class="getPowerLeft" readonly>
										</button>
										<div class="data-table" onclick="powerLeftToricPlusMinusList(event)">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-left" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-left" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-left" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>Axis</p>
										<select name="Laxis" id="toric_laxis" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->axisnew) as $axisn)
												<option value="{{$axisn}}">{{$axisn}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>DIA</p>
										<select name="LDia" id="toric_ldia" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $di)
												<option value="{{$di}}" selected>{{$di}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
								        <p>BC</p>
										<select name="LBc" id="toric_lbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $basecu)
												<option value="{{$basecu}}">{{$basecu}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center; margin-top: 4px;">
								        <p>CYL</p>
										<select name="Lcyle" onchange="selectLeftCylinder(event)" id="toric_lcyle" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->cylindernew) as $cylinder)
												<option value="{{$cylinder}}">{{$cylinder}}</option>
											@endforeach
										</select>
									</div>
								@elseif($productdata->lenstype == "Single Vision" || $productdata->lenstype == "Plano")
								    <div class="right button-div">
										<button role="button" type="button" class="power-button" aria-haspopup="listbox">
											<span type="text" class="sphere-data">Power</span>
											<input name="Lsphere" type="text" class="getPowerLeft" readonly>
										</button>
										<div class="data-table">
											<div class="range-list">
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<path d="M14 2H2" fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<svg width="100%" xmlns="http://www.w3.org/2000/svg">
													<g fill-rule="nonzero" stroke="currentColor" stroke-width="3" fill="none" strok-linecap="round" stroke-linejoin="round">
														<path d="M13.7 7.85H2M7.85 13.7V2"></path>
													</g>
												</svg>
											</div>
											<div class="value">
												<li class="power-data-left" value="N/A">N/A</li>
											</div>
											<div class="sphare-data">
												<div class="min-data">
													<ul>
														@foreach(explode(',',$productdata->powermin) as $mi)
															<li class="power-data-left" value="{{$mi}}">{{$mi}}</li>
														@endforeach
													</ul>
												</div>
												<div class="max-data">
													<ul>
														@foreach(explode(',',$productdata->powermax) as $ma)
															<li class="power-data-left" value="{{$ma}}">{{$ma}}</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>DIA</p>
										<select name="LDia" id="sph_ldia" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->diameter) as $diam)
												<option value="{{$diam}}">{{$diam}}</option>
											@endforeach
										</select>
									</div>
									<div class="right" style="display: flex; align-items:center;">
								        <p>BC</p>
										<select name="LBc" id="sph_lbc" class="sphare" style="position: realative; text-align: center;">
											<option value=""></option>
											<option value="N/A">N/A</option>
											@foreach(explode(',',$productdata->basecurve) as $base)
												<option value="{{$base}}">{{$base}}</option>
											@endforeach
										</select>
									</div>
								@else
									<div class="right">
										<select name="" id="" class="sphare">
											<option value=""></option>
										</select>
									</div>
								@endif
							</div>
							<div class="show-prescription">
								<button class="showPrescription3" type="button">How to read my prescriptions ?</button>
							</div>
							<div class="input-group">
								<input type="checkbox" name="same_rx_both" id="both_eyes-3" class="both_eyes-3"><p>Same Rx for both eyes</p>
							</div>
							<div>
								<a href="javascript:void(0)" class="btn next-4">Select Quantity</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-step" id="form-5">
					<div class="back">
						<a href="javascript:void(0)" class="backbtn back-4">Back</a>
					</div>
					<div class="form-data">
						<div class="title"><h2>Select Your Quantity</h2></div>
						<div class="main_box">
							<div class="box-input-group" style="display: block;" id="leftQuantity">
								<div class="qty_box">
									<select onchange="leftQuantity(event)" class="left-quantity" name="lefteyequantity" id="select">
										<option value="">Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="1">1 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="2">2 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="3">3 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="4">4 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="5">5 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="6">6 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>	
										<option value="7">7 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="8">8 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="9">9 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="10">10 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="11">11 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="12">12 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="13">13 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="14">14 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="15">15 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="16">16 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="17">17 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="18">18 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="19">19 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="20">20 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="21">21 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="22">22 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="23">23 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="24">24 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="25">25 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="26">26 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="27">27 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="28">28 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="29">29 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="30">30 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="31">31 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="32">32 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="33">33 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="34">34 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="35">35 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="36">36 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="37">37 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="38">38 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="39">39 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="40">40 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="41">41 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="42">42 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="43">43 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="44">44 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="45">45 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="46">46 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="47">47 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="48">48 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="49">49 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
										<option value="50">50 Boxes <small> Left Eye <?php echo "(OS)"?></small></option>
									</select>
								</div>
							</div>
							<div class="box-input-group" style="display: block;" id="rightQuantity">
								<div class="qty_box">
									<select onchange="rightQuantity(event)" class="right-quantity" name="righeyequantity" id="select2">
										<option value="">Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="1">1 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="2">2 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="3">3 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="4">4 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="5">5 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="6">6 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="7">7 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="8">8 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="9">9 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="10">10 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="11">11 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="12">12 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="13">13 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="14">14 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="15">15 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="16">16 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="17">17 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="18">18 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="19">19 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="20">20 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="21">21 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="22">22 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="23">23 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="24">24 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="25">25 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="26">26 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="27">27 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="28">28 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="29">29 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="30">30 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="31">31 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="32">32 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="33">33 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="34">34 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="35">35 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="36">36 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="37">37 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="38">38 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="39">39 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="40">40 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="41">41 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="42">42 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="43">43 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="44">44 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="45">45 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="46">46 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="47">47 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="48">48 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="49">49 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
										<option value="50">50 Boxes <small> Right Eye <?php echo "(OD)"?></small></option>
									</select>
								</div>
							</div>
							
							
							<div class="box-input-group" id="bothQuantity" style="display: none;">
								<div class="qty_box">
									<select onchange="bothQuantity(event)" class="both-quantity" name="botheyequantity" id="select2">
										<option value="">Boxes <small> (OD) & (OS) Quantity</small></option>
										<option value="1">1 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="2">2 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="3">3 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="4">4 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="5">5 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="6">6 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="7">7 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="8">8 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="9">9 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="10">10 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="11">11 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="12">12 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="13">13 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="14">14 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="15">15 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="16">16 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="17">17 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="18">18 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="19">19 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="20">20 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="21">21 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="22">22 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="23">23 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="24">24 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="25">25 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="26">26 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="27">27 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="28">28 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="29">29 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="30">30 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="31">31 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="32">32 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="33">33 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="34">34 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="35">35 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="36">36 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="37">37 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="38">38 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="39">39 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="40">40 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="41">41 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="42">42 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="43">43 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="44">44 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="45">45 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="46">46 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="47">47 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="48">48 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="49">49 Boxes <small> (OD) & (OS) Quantity </small></option>
										<option value="50">50 Boxes <small> (OD) & (OS) Quantity </small></option>
									</select>
								</div>
							</div>
							<div>
								<a href="javascript:void(0)" type="button" class="btn next-5">Continue</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-step" id="form-6">
					<div class="back">
						<a href="javascript:void(0)" class="backbtn back-5">Back</a>
					</div>
					<div class="form-data">
						<div class="title"><h3><i class="fa fa-check"></i>Great!<span>Let's finish up</span></h3></div>
						<div class="main_box">
							<div class="data-input-group">
							    <table style="height: 110px">
								    <tr style="height: 35px;">
                                        <th scope="row" style="text-align: left; width: 32%">Product Name</th>
                                        <td style="width: 10%"> :</td>
                                        <td style="text-align: left;">
                                            <span class="main-data">{{substr($productdata->title, 0, 36)}}</span>
                                            <span class="more-data" style="display:none;">{{substr($productdata->title, 36, 100)}}</span>
                                            <a style="color:blue" href="javascript:void(0)" class="more_button">more</a>
                                            <a style="color:blue; display: none;" href="javascript:void(0)" class="hidden_button">less</a>
                                        </td>
                                    </tr>
                                    <tr style="height: 35px;">
                                        <th scope="row" style="text-align: left;">Brand</th>
                                        <td style="width: 10%"> :</td>
                                        <td style="text-align: left;">{{$productdata->brandname}}</td>
                                    </tr>
                                    <tr style="height: 35px;">
                                        <th scope="row" style="text-align: left;">Color</th>
                                        <td style="width: 10%"> :</td>
                                        <td style="text-align: left;">{{$main}}</td>
                                    </tr>
                                    <tr style="height: 35px;">
                                        <th scope="row" style="text-align: left;">Cost Price</th>
                                        <td style="width: 10%"> :</td>
                                        <td style="text-align: left;">{{$settings[0]->currency_sign}} {{$productdata->costprice}}</td>
                                    </tr>
                                    <tr style="height: 35px;">
                                        <th scope="row" style="text-align: left;">Usage Duration</th>
                                        <td style="width: 10%"> :</td>
                                        <td style="text-align: left;">{{$productdata->usagesduration}}</td>
                                    </tr>
                                </table>
                                <table style="height: 70px">
                                    <tbody>
                                        <tr>
                                            <td><h4>Quantity</h4></td>
                                            <td><h4>MRP</h4></td>
                                            <td><h4>Total Amount</h4></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td><input class="boxQty" type="text" style="border: none; width: 80px; font-size: 16px; background-color: #f5f0f0; outline:none; text-align: center;" readonly></th>
                                            <td><span>{{$settings[0]->currency_sign}}<input class="previous" type="text" style="border: none; width: 50px; font-size: 16px; background-color: #f5f0f0; outline:none; text-align: center;" readonly></span></td>
                                            <td>{{$settings[0]->currency_sign}}<input class="selling" name="cost" type="text" style="border: none; width: 50px; font-size: 16px; background-color: #f5f0f0; outline:none; text-align: center; color:rgb(38, 232, 96);" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
								<div class="right">
									<label for="">
										<p></p>
									</label>
								</div>
								<div>
									{{csrf_field()}}
									@if(Session::has('uniqueid'))
										<input type="hidden" name="uniqueid" value="{{Session::get('uniqueid')}}">
									@else
										<input type="hidden" name="uniqueid" value="{{str_random(7)}}">
									@endif
									
				                    <input name="main_cat" type="hidden" value="{{$cate[0]->name}}">
				                    
									<input type="hidden" id="price" name="price" value="{{\App\Product::Cost($productdata->id)}}">

									<!--<input type="hidden" id="price_1" name="price_1" value="{{\App\Product::Costtwopis($productdata->id)}}">-->
									<input type="hidden" id="price_2" name="price_2" value="{{\App\Product::Costfiftypis($productdata->id)}}">
									<input type="hidden" id="price_3" name="price_3" value="{{\App\Product::Costfivethousandpis($productdata->id)}}">

									<input type="hidden" name="title" value="{{$productdata->title}}">
									<input type="hidden" name="product" value="{{$productdata->id}}">
									<input type="hidden" id="quantity" name="quantity" value="1">
									<input type="hidden" id="size" name="size" value="">
									<input type="hidden" id="minus_right_eye" name="minus_right_eye">
									<input type="hidden" id="minus_left_eye" name="minus_left_eye">
									<input type="hidden" id="category" name="category" value="{{$productdata->category[0]}}">
									<input type="hidden" id="prev-price" name="price_1" value="{{$productdata->previous_price}}">
									<input type="hidden" id="sell-price" name="price" value="{{$productdata->costprice}}">
									
									<input type="hidden" name="main_price" value="{{$productdata->costprice}}">
									
									<input type="hidden" name="lenseType" value="{{$productdata->lenstype}}">
									
									@if(isset($attr[0]))
										<input type="hidden" name="productAttrId" value="{{$attr[0]->id}}">
									@else
										<input type="hidden" name="productAttrId" value="">
									@endif

                                    <input type="hidden" name="cartcolor" value="{{$main}}">
                                    <input type="hidden" name="maincolor" value="{{$productdata->lenscolor}}">
                                    
									@if($productdata->stock != 0 || $productdata->stock === null)
										 <button type="submit" id="cart-button" onclick="addCartProduct()" class="btn to-cart"><i class="fa fa-cart-plus"></i><span>{{$language->add_to_cart}} </span></button>                                                        
			                        @else
                                        <button type="button" class="addTo-cart to-cart" disabled><i class="fa fa-cart-plus "></i></button>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

    <div class="modelShaddow"></div>

	<div class="prescriptionModel" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="model-content">
				<div class="model-header">
					<h3 class="model-title">Read Your Prescription</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="model-body">
					<div class="select-prescription">
						<table>
							<thead>
								<tr>
									<th>Where can I find my contacts prescription?</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<ul>
											<li>On your written prescription</li>
											<li>On your box of contacts / on each contact</li>
											<li>Ask for a copy from your optician</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th>See example of contacts prescription:</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<ul>
											<li><input class="contact-lens-button" type="radio">Written prescription</li>
											<li><input class="right-left-button" type="radio">On box of contacts</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="contact-lens-data">
						<table class="table table-bordered" style="width:100%">
							<thead>
								<tr>
									<th style="width:2%"scope="col"></th>
									<th style="width:2%" scope="col"><center>POWER</center></th>
									<th style="width:2%"scope="col"><center>BC</center></th>
									<th style="width:2%"scope="col"><center>DIA</center></th>
									<th style="width:2%"scope="col"><center>CYL</center></th>
									<th style="width:2%"scope="col"><center>AXIS</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="width:2%" scope="row">OD</th>
									<td><center>-2.50</center></td>
									<td><center>8.5</center></td>
									<td><center>14.2</center></td>
									<td><center></center></td>
									<td><center></center></td>
								</tr>
								<tr>
									<th scope="row">OS</th>
									<td><center>-3.00</center></td>
									<td><center>8.5</center></td>
									<td><center>14.2</center></td>
									<td><center></center></td>
									<td><center></center></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="right-left-data">
						<div class="data-content">
							<table class="table table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>O.D.</center></th>
										<th style="width:2%"scope="col"><center>O.S.</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><center><input type="checkbox" disabled>R</center></td>
										<td><center><input type="checkbox" disabled>L</center></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>PWR</center></th>
										<th style="width:2%"scope="col"><center>BC</center></th>
										<th style="width:2%"scope="col"><center>DIA</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>-3.00</center></td>
										<td><center>8.5</center></td>
										<td><center>14.2</center></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="detail">
						<div class="row">
							<table class="detail-table">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>Eye</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><center>
											<p>The right eye (O.D) will always be</p>
											<span>listed before left eye (O.S).</span>
										</center></td>
									</tr>
								</tbody>
							</table>
							<table class="detail-table">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>Power</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<center>
												Can displayed as PWR / SPH / D, shows whether you are far or near-sighted and how much correction your eyes require.
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<table class="detail-table">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>BC</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<center>
												The base curve, usually a number between 8 and 10, measures the curve of the lens.
											</center>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="detail-table">
								<thead>
									<tr>
										<th style="width:2%" scope="col"><center>Dia</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<center>
												The diameter of the contact lens, usually between 13 and 15, determines the width that best fits your eye.
											</center>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- for sweet alert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<script>
	


        var moreData = document.querySelector('.more-data');
        var moreBotton = document.querySelector('.more_button');
        var hideButton = document.querySelector('.hidden_button');
        var mainData = document.querySelector('.main-data');
        
        if(mainData.innerText.length >= 36){
            moreBotton.addEventListener('click', function() {
                moreData.style.display = 'inline';
                hideButton.style.display = 'inline';
                moreBotton.style.display = 'none';
            });
        }
        else{
            moreBotton.style.display = 'none';
        }
        
        hideButton.addEventListener('click', function() {
            moreData.style.display = 'none';
            hideButton.style.display = 'none';
            moreBotton.style.display = 'inline';
        });
	   // var colorData = JSON.parse(window.localStorage.getItem("colorObject"));
        
    //     url = "{{url('productshoww')}}/";
        
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             color: colorData,
    //         },
    //         success: function (data) {
    //             console.log(data);
    //         }
    //     });
        // window.onload = (e) => {
        //   console.log('page is fully loaded');
        // };

	</script>
    
	<script>
		var showPresButton = document.querySelector('.showPrescription');
		var showPresButton2 = document.querySelector('.showPrescription2');
		var showPresButton3 = document.querySelector('.showPrescription3');
		
		var closeModelButton = document.querySelector('.close');

		var modelWindow = document.querySelector('.prescriptionModel');
		var overLayWindow = document.querySelector('.modelShaddow');

		var contactLensButton = document.querySelector('.contact-lens-button');
		var contactLensData = document.querySelector('.contact-lens-data');
		var powerLensButton = document.querySelector('.right-left-button');
		var powerLensData = document.querySelector('.right-left-data');

		showPresButton.addEventListener('click', function() {
			overLayWindow.style.display = 'block';
			modelWindow.style.display = 'block';
		});
		
		showPresButton2.addEventListener('click', function() {
			overLayWindow.style.display = 'block';
			modelWindow.style.display = 'block';
		});
		
		showPresButton3.addEventListener('click', function() {
			overLayWindow.style.display = 'block';
			modelWindow.style.display = 'block';
		});

		closeModelButton.addEventListener('click', function() {
			overLayWindow.style.display = 'none';
			modelWindow.style.display = 'none';
		});

		contactLensButton.checked = true;

		contactLensButton.addEventListener('click', function() {
			contactLensData.style.display = 'block';
			powerLensData.style.display = 'none';
			powerLensButton.checked = false;
		});

		powerLensButton.addEventListener('click', function() {
			contactLensData.style.display = 'none';
			powerLensData.style.display = 'block';
			contactLensButton.checked = false;
		});
	</script>


<script type="text/javascript">

	// Forwarrd process ----------------------------------------
	const nextFirst = document.querySelector('.next-1');
	const nextSecond = document.querySelector('.next-2');
	const nextThird = document.querySelector('.next-3');
	const nextFourth = document.querySelector('.next-4');
	const nextFifth = document.querySelector('.next-5');
	const nextSixth = document.querySelector('.next-6');

	const imgNext = document.querySelector('.img-next');

	const fillManual = document.querySelector('.fill-manual');

	const firstCheck = document.querySelector('#both_eyes');
	const secondCheck = document.querySelector('#both_eyes-2');
	const thirdCheck = document.querySelector('#both_eyes-3');

	const firstForm = document.querySelector('#form-1');
	const secondForm = document.querySelector('#form-2');
	const thirdForm = document.querySelector('#form-3');
	const fourthForm = document.querySelector('#form-4');
	const fifthForm = document.querySelector('#form-5');
	const sixthForm = document.querySelector('#form-6');

	const formModel = document.querySelector('#form-model');
	const imgModel = document.querySelector('#img-model');
	const bothQty = document.querySelector('#bothQuantity');
	const leftQty = document.querySelector('#leftQuantity');
	const rightQty = document.querySelector('#rightQuantity');


	var fileTag = document.getElementById("uploadFile"),
		preview = document.getElementById("showFile");
		labelData = document.getElementById("showLabel")

	fileTag.addEventListener("change", function() {
		changeImage(this);
		formModel.style.display = "none";
		imgModel.style.display = "block";
	});

    var image = {};
	function changeImage(input) {
		var reader;

		if (input.files && input.files[0]) {
			reader = new FileReader();

			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);

				var filename = input.files[0].name;
				
				if(filename != '') {
					$('#showLabel').html(filename);
				}
			}

			reader.readAsDataURL(input.files[0]);
			
            image.prescription = input.files[0];
		}
		
	}

	imgNext.addEventListener('click', function() {
		if(image.prescription != null) {
    	    // left eye field ----------
    	    $('#toric_ldia').val('');
    	    $('#toric_laxis').val('');
    	    $('#toric_lbc').val('');
    	    $('#toric_lcyle').val('');
    	    $('#sph_ldia').val('');
    	    $('#sph_lbc').val('');
    	    $('#multi_lopwer').val('');
    	    $('#multi_lbc').val('');
    	    $('#multi_ldia').val('');
    	    
    	    // right eye field --------
    	    $('.getPowerRight').val('');
    	    $('#raxis').val('');
    	    $('#rbc').val('');
    	    $('#rcyl').val('');
    	    $('#rdia').val('');
    	    $('#multi_rpower').val('')
    	    
    	    // both eye field ---------
    	    $('.getPowerBoth').val('');
    		$('#multi_bbc').val('');
    		$('#multi_bpower').val('');
    		$('#toric_bcyle').val('');
    		$('#sph_bbc').val('');
		
			fifthForm.style.display = 'block';
			firstForm.style.display = 'none';
			// imgModel.style.display = 'none';
		}else {
			fifthForm.style.display = 'none';
			imgModel.style.display = 'none';
			formModel.style.display = "block";
			firstForm.style.display = 'block';
		}
		// fifthForm.style.display = 'block';
		// firstForm.style.display = 'none';
	});

	nextFirst.addEventListener('click', function() {
	    // left eye field ----------
	    $('#toric_ldia').val('');
	    $('#toric_laxis').val('');
	    $('#toric_lbc').val('');
	    $('#toric_lcyle').val('');
	    $('#sph_ldia').val('');
	    $('#sph_lbc').val('');
	    $('#multi_lopwer').val('');
	    $('#multi_lbc').val('');
	    $('#multi_ldia').val('');
	    
	    // right eye field --------
	    $('.getPowerRight').val('');
	    $('#raxis').val('');
	    $('#rbc').val('');
	    $('#rcyl').val('');
	    $('#rdia').val('');
	    $('#multi_rpower').val('')
	    
	    // both eye field ---------
	    $('.getPowerBoth').val('');
		$('#multi_bbc').val('');
		$('#multi_bpower').val('');
		$('#toric_bcyle').val('');
		$('#sph_bbc').val('');
	    
		fifthForm.style.display = 'block';
		firstForm.style.display = 'none';
	});

	fillManual.addEventListener('click', function() {
	    if(firstCheck.checked){
	        thirdForm.style.display = 'block';
		    firstForm.style.display = 'none';
	    }else{
	        secondForm.style.display = 'block';
		    firstForm.style.display = 'none';
	    }
	});

	firstCheck.addEventListener('click', function() {
	    $('#toric_ldia').val('');
	    $('#toric_laxis').val('');
	    $('#toric_lbc').val('');
	    $('#toric_lcyle').val('');
	    $('#sph_ldia').val('');
	    $('#sph_lbc').val('');
	    $('#multi_lopwer').val('');
	    $('#multi_lbc').val('');
	    $('#multi_ldia').val('');
	    
	    if($('.getPowerRight').val() != '' && $('#raxis').val() != '' && $('#rbc').val() != '' && $('#rcyl').val() != '' && $('#rdia').val() != '' && $('#multi_rpower').val() != '') {
    		if(firstCheck.checked) {
    			thirdForm.style.display = 'block';
    			secondForm.style.display = 'none';
    			secondCheck.checked = true;
    			thirdCheck.checked = true;
                
                if($('#lenseType').val() == "MultiFocal") {
        			var rightPower = $('.getPowerRight').val();
        			var rightBase = $('#rbc').val();
        			var rightAddPower = $('#multi_rpower').val();
    			
        			$('.getPowerBoth').val(rightPower);
        			$('#multi_bbc').val(rightBase);
        			$('#multi_bpower').val(rightAddPower);
    		    }
    		    else if($('#lenseType').val() == "toric and Astigmatism") {
    		        var rightPower = $('.getPowerRight').val();
        			var rightAxis = $('#raxis').val();
        			var rightBase = $('#rbc').val();
        			var rightCycle = $('#rcyl').val();
        			
        			$('.getPowerBoth').val(rightPower);
        			$('#toric_baxis').val(rightAxis);
        			$('#toric_bbc').val(rightBase);
        			$('#toric_bcyle').val(rightCycle);
    		    }
    		    else {
    		        var rightPower = $('.getPowerRight').val();
        			var rightBase = $('#rbc').val();
        			var rdia = $('#rdia').val();
    			
        			$('.getPowerBoth').val(rightPower);
        			$('#sph_bbc').val(rightBase);
        			$('#sph_bdia').val(rdia)
    		    }
    		    
    		    $("#sph_ldia option[value!='']").attr('selected', false);
		        $("#sph_lbc option[value!='']").attr('selected', false);
    		}
    		
    		if(firstCheck.unchecked) {
        		$('.getPowerBoth').val('');
        		$('#toric_baxis').val('');
        		$('#toric_bbc').val('');
        		$('#toric_bcyle').val('');
        		$('#multi_bpower').val('');
    		}
	    }
	    else{
	        firstCheck.checked = false;
	        if($('.getPowerRight').val() == '') {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_rpower').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rbc').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#raxis').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rcyl').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right RCYL data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rdia').val() != ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right DIA data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	    }
	});

	secondCheck.addEventListener('click', function() {
		if(secondCheck.checked == false) {
			thirdForm.style.display = 'none';
			secondForm.style.display = 'block';
			firstCheck.checked = false;
			thirdCheck.checked = false;
			
			$("#sph_ldia option[value!='']").attr('selected', false);
		    $("#sph_lbc option[value!='']").attr('selected', false);
		}
		else{
    	    $('#toric_ldia').val('');
    	    $('#toric_laxis').val('');
    	    $('#toric_lbc').val('');
    	    $('#toric_lcyle').val('');
    	    $('#sph_ldia').val('');
    	    $('#sph_lbc').val('');
    	    $('#multi_lopwer').val('');
    	    $('#multi_lbc').val('');
    	    $('#multi_ldia').val('');
		}
	});
	
	thirdCheck.addEventListener('click', function() {
		if(thirdCheck.checked) {
			thirdForm.style.display = 'block';
			fourthForm.style.display = 'none';
			secondCheck.checked = true;
			thirdCheck.checked = true;
			
			var rightPower = $('.getPowerRight').val();
			var rightAxis = $('#raxis').val();
			var rightBase = $('#rbc').val();
			var rightCycle = $('#rcyl').val();
			
			$('.getPowerBoth').val(rightPower);
			$('#toric_baxis').val(rightAxis);
			$('#toric_bbc').val(rightBase);
			$('#toric_bcyle').val(rightCycle);
			
			$("#sph_ldia option[value!='']").attr('selected', false);
		    $("#sph_lbc option[value!='']").attr('selected', false);
		    
		    // left eye field -----------
    	    $('#toric_ldia').val('');
    	    $('#toric_laxis').val('');
    	    $('#toric_lbc').val('');
    	    $('#toric_lcyle').val('');
    	    $('#sph_ldia').val('');
    	    $('#sph_lbc').val('');
    	    $('#multi_lopwer').val('');
    	    $('#multi_lbc').val('');
    	    $('#multi_ldia').val('');
		}
			
	});

	nextSecond.addEventListener('click', function() {
	    if($('.getPowerRight').val() != '' && $('#raxis').val() != '' && $('#rbc').val() != '' && $('#rcyl').val() != '' && $('#rdia').val() != '' && $('#multi_rpower').val() != '') {
    		fourthForm.style.display = 'block';
    		secondForm.style.display = 'none';
	    }
	    else {
	        if($('.getPowerRight').val() == '') {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_rpower').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rbc').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#raxis').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rcyl').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right Cyl data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rdia').val() != ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill right DIA data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	    }
	})

	nextThird.addEventListener('click', function() {
	    if($('.getPowerBoth').val() != ''&& $('#sph_bbc').val() != '' && $('#sph_bdia').val() != '' && $('#toric_baxis').val() != '' && $('#toric_bcyle').val() != '') {
    		fifthForm.style.display = 'block';
    		thirdForm.style.display = 'none';
		    bothQty.style.display = 'block';
		    leftQty.style.display = 'none';
		    rightQty.style.display = 'none';
	    }
	    else{
	        if($('.getPowerLeft').val() == '') {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_lopwer').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_lbc').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#raxis').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rcyl').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_ldia').val() != ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left DIA data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	    }
	})

	nextFourth.addEventListener('click', function() {
	    if($('.getPowerLeft').val() != '' && $('#multi_lopwer').val() != '' && $('#multi_lbc').val() != '' && $('#multi_ldia').val() != '') {
    		fifthForm.style.display = 'block';
    		fourthForm.style.display = 'none';
	    }
	    else{
	        if($('.getPowerLeft').val() == '') {
    	        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_lopwer').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left ADD Power data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_lbc').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left BC data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#raxis').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#rcyl').val() == ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left Axis data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	        else if($('#multi_ldia').val() != ''){
	            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    width: 500,
                    text: 'Please fill Left DIA data!',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
	        }
	    }
	})

	nextFifth.addEventListener('click', function() {
	    if($('.left-quantity').val() != '' || $('.right-quantity').val() != '' || $('.both-quantity').val() != ''){
    		sixthForm.style.display = 'block';
    		fifthForm.style.display = 'none';
    		
    		if($('.left-quantity').val() != ''){
    		    var quantity = parseInt($('.left-quantity').val());
    		}
    		else{
    		    var quantity = 0;
    		}
    		
    		if($('.right-quantity').val() != ''){
    		    var quantity2 = parseInt($('.right-quantity').val());
    		}
    		else{
    		    var quantity2 = 0;
    		}
    		
    		if($('.both-quantity').val() != ''){
    		    var quantity3 = parseInt($('.both-quantity').val());
    		}
    		else{
    		    var quantity3 = 0;
    		}
    		var prePrice = parseInt($('#prev-price').val());
    		var price = parseInt($('#sell-price').val());
    		
    		if(quantity3 == ''){
    		    var mrpPrice = (quantity + quantity2) * prePrice;
    		}
    		else{
    		    var mrpPrice = (quantity3) * prePrice;
    		}
    		
    		if(quantity3 == ''){
    		    var sellPrice = (quantity + quantity2) * price;
    		}
    		else{
    		    var sellPrice = (quantity3) * price;
    		}
    		
    		if(quantity3 == ''){
    		    $('.boxQty').val(quantity + quantity2);
    		    $('#quantity').val(quantity + quantity2);
    		}
    		else{
    		    $('.boxQty').val(quantity3);
    		    $('#quantity').val(quantity3);
    		}
    		
    		
    		
    		$(".previous").val(mrpPrice);
    		
    		$(".selling").val(sellPrice);
	    }
	    else{
	        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                width: 500,
                text: 'Please Select Any One Eye Qty !',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
	    }
		
	})

	// back process ----------------------------------------

	// const firstForm = document.querySelector('#form-1');
	// const secondForm = document.querySelector('#form-2');
	// const thirdForm = document.querySelector('#form-3');
	// const fourthForm = document.querySelector('#form-4');
	// const fifthForm = document.querySelector('#form-5');
	// const sixthForm = document.querySelector('#form-6');

	const firstBack = document.querySelector('.back-1');
	const secondBack = document.querySelector('.back-2');
	const thirdBack = document.querySelector('.back-3');
	const fourthBack = document.querySelector('.back-4');
	const fifthBack = document.querySelector('.back-5');
	
	$('.main-back').on('click', function() {
	    window.location.href = "{{url('product/'.$productdata->id.'/'.str_replace('/','',$productdata->title))}}";
	})

	firstBack.addEventListener('click', function() {
		firstForm.style.display = 'block';
		secondForm.style.display = 'none';
		formModel.style.display = "block";
	});

	secondBack.addEventListener('click', function() {
		firstForm.style.display = 'block';
		thirdForm.style.display = 'none';
	});

	thirdBack.addEventListener('click', function() {
		secondForm.style.display = 'block';
		fourthForm.style.display = 'none';
	});

	fourthBack.addEventListener('click', function() {
		if(secondCheck.checked == true){
		    thirdForm.style.display = 'block';
		    fifthForm.style.display = 'none';
		}else {
		    if(image.prescription != null){
			    firstForm.style.display = 'block';
		        imgModel.style.display = "block";
		        formModel.style.display = "none";
		        fifthForm.style.display = 'none';
		        thirdForm.style.display = 'none';
		    }
		    else{
		        fourthForm.style.display = 'block';
		        fifthForm.style.display = 'none';
		        imgModel.style.display = "none";
		        formModel.style.display = "none";
		        firstForm.style.display = 'none';
		    }
		}
	});

	fifthBack.addEventListener('click', function() {
		fifthForm.style.display = 'block';
		sixthForm.style.display = 'none';
	});
</script>

<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
<script type="text/javascript">
	$(document).ready(()=>{
		$("#select option[value=0]").attr('selected', 'selected');
		$("#select2 option[value=0]").attr('selected', 'selected');
		$("#sph_ldia option[value!='']").attr('selected', true);
		$("#sph_lbc option[value!='']").attr('selected', true);
	});
	
	// right eye power ajax function -------------------------

	$(".power-data-right").click(function() {
		var data = $(this).attr('value');
		insertDataRight(data);
	});

	function insertDataRight(data) {
		$('.getPowerRight').val(data);
	}
	
	// both eye ajax function ----------------------------------
	
	$(".power-data-both").click(function() {
		var data = $(this).attr('value');
		insertDataBoth(data);
	});

	function insertDataBoth(data) {
		$('.getPowerBoth').val(data);
	}
	
	// left eye ajax function ---------------------------------
	
	$(".power-data-left").click(function() {
		var data = $(this).attr('value');
		insertDataLeft(data);
	});

	function insertDataLeft(data) {
		$('.getPowerLeft').val(data);
	}

</script>

<script type="text/javascript">    
    var save_method;

$(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
    $('#PrescriptionForm').submit(function(e){
        var formData = new FormData(this);
		
        e.preventDefault();
        $.ajax({
            url: "{{url('/cartupdate')}}",
            method:'POST',
            data : formData,
            processData: false,
            contentType: false,
            cache : false,
            dataType: 'JSON',
            success:function(data){
			    if (data.status == 200) {
					window.location.href = "{{url('/cart')}}";
				}
			},
		});
	}); 
});

function validate() {
// var emp_name = $('#emp_name').val();



var msg = new Array();


//     if(upload_document == ''){
//         msg.push('Please Field  Upload Document'); 
//     }    


if( !jQuery.isEmptyObject(msg)) {
    $('.error').text(msg[0]);
    }
    else return true;
}

//vishal

var getPowerRight, selectRigCyl;
function powerRightToricPlusMinusList(e){
	getPowerRight = $(".getPowerRight").val();
	getRightEyeConv();
}
function selectRightCylinder(e){
	selectRigCyl = e.target.value;
	getRightEyeConv();
}

var validArray = ['',undefined]
function getRightEyeConv(){
	if(!(validArray.includes(getPowerRight)) && !(validArray.includes(selectRigCyl))){
		$.ajax({
			method:'POST',
			url: "<?php echo url('/fetchConversionRight'); ?>",
			data: {
            "_token": "{{ csrf_token() }}",
                sphere: getPowerRight,
				cylinder: selectRigCyl
            },
			dataType: 'JSON',
			success:function(resp) {
				if(resp.ststus == 'success'){
					$("#minus_right_eye").val(resp.data);
				}
			}
		});
	}
}

$("#both_eyes").on("click", function(e){
	if($(this).prop('checked')){
		$("#minus_left_eye").val($("#minus_right_eye").val());
	}else{
		$("#minus_left_eye").val('');
	}
});

$("#both_eyes-3").on("click", function(e){
	if($(this).prop('checked')){
		$("#minus_left_eye").val($("#minus_right_eye").val());
	}else{
		$("#minus_left_eye").val('');
	}
});

var getPowerLeft, selectLeftCyl;
function powerLeftToricPlusMinusList(e){
	getPowerLeft = $(".getPowerLeft").val();
	getLeftEyeConv();
}
function selectLeftCylinder(e){
	selectLeftCyl = e.target.value;
	getLeftEyeConv();
}

function getLeftEyeConv(){
	if(!(validArray.includes(getPowerLeft)) && !(validArray.includes(selectLeftCyl))){
		$.ajax({
			method:'POST',
			url: "<?php echo url('/fetchConversionRight'); ?>",   //same url 
			data: {
            "_token": "{{ csrf_token() }}",
                sphere: getPowerLeft,
				cylinder: selectLeftCyl
            },
			dataType: 'JSON',
			success:function(resp) {
				if(resp.ststus == 'success'){
					$("#minus_left_eye").val(resp.data);
				}
			}
		});
	}
}

</script>

<script>
	var url = "{{url('/check-product-qty')}}";
	var leftEyeQuantity;
	function leftQuantity(e)
	{
		let id = $("input[name=product]").val();
		let paid = $("input[name=productAttrId]").val();
		
		leftEyeQuantity = $(e.target).val();
		
		if(!leftEyeQuantity) return false;
		fetchEyeQtyDetails(id, paid, leftEyeQuantity, url, e);
	}
		
	var rightEyeQuantity;
	function rightQuantity(e)
	{
		var id = $("input[name=product]").val();
		var paid = $("input[name=productAttrId]").val();
		rightEyeQuantity = $(e.target).val();
		if(!rightEyeQuantity) return false;
		fetchEyeQtyDetails(id, paid, rightEyeQuantity, url, e);
	}

	function fetchEyeQtyDetails(id, paid, qty, url, e){
		$.ajax({
			type: "POST",
			url: url,
			data: {
            	"_token": "{{ csrf_token() }}",
				id:id,
				paid:paid,
				qty:qty,
			},
			success: function(data) {
				if(data.error){
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						width: 500,
						text: data.response,
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						}
					});
					$(e.target).val('');
				}else{
					bothEyeQuantity(e);
				}
			}
		});
	}


	const bothEyeQuantity = (e) => {
		let id = $("input[name=product]").val();
		let paid = $("input[name=productAttrId]").val();

		if(rightEyeQuantity && leftEyeQuantity){
			let qty = parseInt(rightEyeQuantity)+parseInt(leftEyeQuantity);
			$.ajax({
				type: "POST",
				url: url,
				data: {
					"_token": "{{ csrf_token() }}",
					id:id,
					paid:paid,
					qty:qty,
				},
				success: function(data) {
					if(data.error){
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							width: 500,
							text: data.response,
							showClass: {
								popup: 'animate__animated animate__fadeInDown'
							},
							hideClass: {
								popup: 'animate__animated animate__fadeOutUp'
							}
						});
						$(e.target).val('');
    					leftEyeQuantity = $(e.target).val();
    					rightEyeQuantity = $(e.target).val();
					}
				}
			});
		}
	}



	function bothQuantity(e)
	{
		var id = $("input[name=product]").val();
		var paid = $("input[name=productAttrId]").val();
		var color = $("input[name=cartcolor]").val();
		var qty = $(e.target).val();
		var url = "{{url('/check-product-qty')}}";
		if(!qty) return false;
		$.ajax({
			type: "POST",
			url: url,
			data: {
            	"_token": "{{ csrf_token() }}",
				id:id,
				paid:paid,
				color:color,
				qty:qty,
			},
			success: function(data) {
				if(data.error){
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						width: 500,
						text: data.response,
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						}
					});
					$(e.target).val('');
				}
			}
		});
	}
</script>

</body>
</html>