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
        <link href="{{ asset('system/css/style.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('system/css/login.css') }}">
    </head>
    <body>
        <div class="background-wrap">
            <div class="background"></div>
        </div>
        <div id="lcsFormContent" style="width:600px">
            <form id="signupForm" class="default-form" method="post">
                <h1 id="litheader">PMS</h1>
                <h5 id="litheader" style="text-align:center;">SIGN UP HERE</h5>
                <div class="inset">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <input type="text" name="first_name" id="inputFirstName" placeholder="First Name">
                                <span class="text-danger input-error first_name-error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <input type="text" name="last_name" id="inputLastName" placeholder="Last Name">
                                <span class="text-danger input-error last_name-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <input type="text" name="username" id="inputUsername" placeholder="Username">
                                <span class="text-danger input-error username-error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <input type="password" name="password" id="inputPassword" placeholder="Password">
                                <span class="text-danger input-error password-error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input type="password" name="password_confirmation" id="inputCpassword" placeholder="Confirm Password">
                                <span class="text-danger input-error password_confirmation-error"></span>
                            </div>
                        </div>
                    </div>
                    
                    <input class="loginLoginValue" type="hidden" name="service" value="login" />


                </div>

                <p class="p-container">

                    <input type="submit" name="Login" id="go" value="Register">
                </p>

                <p style="text-align:center;"><a href="{{URL::to('/')}}">Back to Login</a></p>
                <div class="message-box" style="text-align:center;margin-top:15px">
                    
                </div> 
            </form>
        </div>

        <script src="{{ asset('system/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="https://unpkg.com/popper.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            
            $(document).ready(function() {

                var form = $('#signupForm'); 

                
                form.on( 'submit', function(e) {
                    $('.message-box').html("");
                    $('.input-error').html("");
                    e.preventDefault();
                    
                    var first_name = $(this).find('input[name=first_name]').val();
                    var last_name = $(this).find('input[name=last_name]').val();
                    var username = $(this).find('input[name=username]').val();
                    var password = $(this).find('input[name=password]').val();
                    var password_confirmation = $(this).find('input[name=password_confirmation]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        }
                    });

                   
                    $.ajax({
                        url     : "{{URL::to('signup-process')}}",
                        type    : form.attr('method'),
                        data    : {"first_name": first_name,"last_name":last_name,"username":username,"password":password,"password_confirmation":password_confirmation},
                        dataType: 'json',
                        success : function ( data ){
                            if(data.status == true){
                                $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                                setTimeout("location.href = '{{URL::to('/')}}';", 1000);

                            }else{
                                $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');
                            }

                        },
                        error: function( data ){
                            var errors = data.responseJSON;
                            
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
