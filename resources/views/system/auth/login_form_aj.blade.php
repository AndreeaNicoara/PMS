<div id='ctsFormLoader' style="text-align: center;margin-top: 30px;">
    <h3>Hi</h3>
    <h5>
        @if(session()->has('user'))
        {{ Session::get('user')['first_name'].' '.Session::get('user')['last_name'] }}
        @endif
    </h5>
    <img src="{{ asset('system/images/gif/1485.gif')}}" width='30px' style="margin-top:30px"/>
    <p style="margin-top:30px">Please wait! you will be redirect to the system.</p>
</div>