<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('system/css/login.css') }}">
    </head>
    <body>
        <div class="background-wrap">
            <div class="background"></div>
        </div>
        <div id="lcsFormContent">
            <form id="loginForm" class="default-form" method="post">
                <h1 id="litheader">PMS</h1>
                <h5 id="litheader" style="text-align:center;">PROJECT MANAGEMENT SYSTEM</h5>
                <div class="inset">
                    <div class="form-group">

                        <input type="text" name="username" id="Username" placeholder="Username">
                        <span class="text-danger input-error username-error"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <span class="text-danger input-error password-error"></span>
                    </div>
                    
                    <input class="loginLoginValue" type="hidden" name="service" value="login" />


                </div>

                <p class="p-container">

                    <input type="submit" name="Login" id="go" value="Authorize">
                </p>

                <p style="text-align:center;"><a href="{{URL::to('/signup')}}">Register</a></p>
                <div class="message-box" style="text-align:center;margin-top:15px">
                    
                </div> 
            </form>
        </div>

        <script src="{{ asset('system/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="https://unpkg.com/popper.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            //Login form submit
            $(document).ready(function() {
                $('.message-box').html("");//Clear message box before submit
                var form = $('#loginForm'); //Get login form variable by ID

                //Form submit button clicked 
                form.on( 'submit', function(e) {
                    e.preventDefault();//Stops the default action of a selected element from happening
                    
                    var username = $(this).find('input[name=username]').val();//Get username variable using name attribute
                    var password = $(this).find('input[name=password]').val();//Get password variable using name attribute

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //Pass CSRF token on header using name attribute
                        }
                    });

                    $.ajax({
                        url     : "{{URL::to('login-authentication')}}",
                        type    : form.attr('method'),
                        data    : {"username": username,"password":password},
                        dataType: 'json',
                        success : function ( data ){
                            if(data.status == true){
                                
                                $.ajax({
                                    method: "POST",
                                    url: "{{URL::to('login-form-ajax')}}", //URL To Login Validation
                                    data: {"_token": "{{ csrf_token() }}"}, //Pass data 
                                    dataType: 'json',
                                    success: function(res_data) {
                                        if($.isEmptyObject(res_data.error)){
                                            $('#lcsFormContent').html(res_data.element);
                                            setTimeout("location.href = '{{URL::to('dashboard')}}';", 1000);
                                        }else{
                                            $('.lcs-danger').show();
                                            $('.lcs-danger').html(res_data.error); 
                                        }

                                    }
                                });

                            }else{
                                $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');//Display main form error
                            }

                        },
                        error: function( data ){
                            var errors = data.responseJSON;
                            //Display response message according to relevant input error message
                            $.each(data.responseJSON.errors, function (key, value) {
                                $('.'+key+'-error').html(value);
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
