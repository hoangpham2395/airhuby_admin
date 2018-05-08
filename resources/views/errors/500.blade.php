<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Airhuby | Page Not Found</title>
        
        <!-- Logo -->
        <link rel="shortcut icon" href="{{ asset('images/logo_short_red.png') }}">
        <!-- Fonts -->
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Source Sans Pro',sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }
            .title {
                font-size: 100px;
                color: #f39c12 !important;
                float: left;
                margin-right: 30px;
            }
            .main-content {
                float: left;
            }
            .main-content>h3 {
                font-size: 20px;
                color: #f39c12 !important;
            }
            .main-content>span {
                font-size: 14px;
                color: black;
            }
            .main-content>span>a {
                text-decoration: none;
                color: #3c8dbc;
            } 
            @media (max-width: 991px) {
                .title {
                    float: none;
                    text-align: center;
                    margin-right: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">500</div>
                <div class="main-content">
                    <h3><i class="fa fa-warning"></i> Oops! Something went wrong.</h3>
                    <span>We will work on fixing that right away. Meanwhile, you may <a href="{{ asset('dashboard') }}">return to dashboard</a>.</span>
                </div>
            </div>
        </div>
    </body>
</html>
    