<div class="dashboard-menu">
    <h3>my account</h3>
    <ul class="dashboard-mainmenu" style="display: flex; flex-direction: column;">
        <li><a href="{{route('user.account')}}"> <i class="fa fa-tachometer" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}account dashboard</a></li>
        <li><a href="{{route('user.accinfo')}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}edit account</a></li>
        <li><a href="{{route('user.accpass')}}"> <i class="fa fa-key" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}Change Password</a></li>
        <li><a href="{{route('user.orders')}}"> <i class="fa fa-first-order" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}my orders</a></li>

        @if(Auth::user()->user_id =='')
          <li><a href="{{route('subuser.details')}}"> <i class="fa fa-users" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}Add Users</a></li>
        @endif
        
        <!--<li><a data-toggle="modal" data-target="#deleteMyAccountModal"> <i class="fa fa-trash" aria-hidden="true"></i> {!! "&nbsp;" !!}{!! "&nbsp;" !!}Delete My Account</a></li>-->
        <li><a href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>{!! "&nbsp;" !!}{!! "&nbsp;" !!}Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form></li>
    </ul>
</div>

<!-- <a href="{{route('deleteaccount.destroy',['id' => '$customer->id'])}}" onclick="return confirm('Are You Sure?')" >
  <i class="fa fa-trash" aria-hidden="true">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Delete My Account</i>
</a> -->

<!-- Modal -->
<div class="modal fade" id="deleteMyAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to delete your account ?</h4>
      </div>
      <div class="modal-footer">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
          <div class="col-md-4">
              <form action="{{route('deleteaccount.destroy')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-primary">Yes</a>    
            </form>
          </div>  
      </div>
    </div>
  </div>
</div>