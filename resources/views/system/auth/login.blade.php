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
            //Login Form Submit
            $(document).ready(function() {
                $('.message-box').html("");// Clear Message Box Before Submit
                var form = $('#loginForm'); //Get Login Form to the Variable by Id

                //Form Submit Button Clicked 
                form.on( 'submit', function(e) {
                    e.preventDefault();//Stops the Default Action of a Selected Element from Happening by a User
                    
                    var username = $(this).find('input[name=username]').val();//Get Username to the Variable Using Name Attribute
                    var password = $(this).find('input[name=password]').val();//Get Password to the Variable Using Name Attribute

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //Pass crf token on header using name attribute
                        }
                    });

                    //AJax Code Goes Here
                    $.ajax({
                        url     : "{{URL::to('login-authentication')}}",
                        type    : form.attr('method'),
                        data    : {"username": username,"password":password},
                        dataType: 'json',
                        success : function ( data ){
                            if(data.status == true){
                                
                                $.ajax({
                                    method: "POST",
                                    url: "{{URL::to('login-form-ajax')}}", // Url To Login Validation
                                    data: {"_token": "{{ csrf_token() }}"}, //Pass Data Here
                                    dataType: 'json',
                                    success: function(res_data) {
                                        if($.isEmptyObject(res_data.error)){
                                            //alert(dep_data.element);
                                            $('#lcsFormContent').html(res_data.element);
                                            setTimeout("location.href = '{{URL::to('dashboard')}}';", 1000);
                                        }else{
                                            $('.lcs-danger').show();
                                            $('.lcs-danger').html(res_data.error); 
                                        }

                                    }
                                });

                            }else{
                                $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');// Dispaly Main Form Error
                            }

                        },
                        error: function( data ){
                            var errors = data.responseJSON;
                            //Display Response Meesage According to Relevant Input Error Message
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
