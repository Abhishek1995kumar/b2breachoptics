@extends('admin.includes.master-admin')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style type="text/css">
    .content-box {
        background-color: #fafafb;
        box-shadow: 1px 4px 8px rgba(0,0,0,.15);
        transition: all .3s ease-in-out;
        padding: 10px;
        padding-bottom: 0;
        margin-top: 40px;
        margin-bottom: 10px;
        height: 250px;
    }
.content-box .finbyz-icon {
    height: 100px;
    width: 100px;
    display: inline;
}

</style>

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                   <!--  <div class="pull-right">
                        <a href="{!! url('vendor/withdrawmoney') !!}" class="btn btn-primary btn-add"><i class="fa fa-download"></i> Withdraw Now</a>
                    </div> -->
                    <h3>Payment Overview</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="container">
						  
						  <ul class="nav nav-pills" role="tablist">
							  <li class="active"><a class="btn btn-primary" href="{{url('admin/Paymentoverview')}}">Admin Payment Overview</a></li>
							  
							  <li>
							  	<select class="form-control" id="dynamic_select">
							  		<option value="">Select Vendor For Payment Overview</option>
						          @foreach ($list as $sn) 
						          {
						            <option value="{{ $sn->id }}">{{ $sn->name }}</option>
						          }
						          @endforeach
						        </select>
							  </li>
						  </ul>


						</div>
               
                
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@stop

@section('footer')

<script>
    $(function(){
      $('#dynamic_select').on('change', function () {
          var id = $(this).val(); // get selected value
          // alert(id);
          if (id) { 
              window.location = "vendors/view/"+id+""; 
          }
          return false;
      });
    });
</script>


@stop


