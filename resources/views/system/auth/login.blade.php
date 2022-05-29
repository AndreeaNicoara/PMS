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
                <h5 id="litheader" style="text-align:center;">PROJECT MANAGEMENT SYSTEM2</h5>
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
            
            $(document).ready(function() {
                $('.message-box').html("");
                var form = $('#loginForm'); 

                
                form.on( 'submit', function(e) {
                    e.preventDefault();
                    
                    var username = $(this).find('input[name=username]').val();
                    var password = $(this).find('input[name=password]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
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
                                    url: "{{URL::to('login-form-ajax')}}", 
                                    data: {"_token": "{{ csrf_token() }}"}, 
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
