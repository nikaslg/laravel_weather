<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container d-flex flex-column">
            <div class="error-msg-container row">
                <div class="col-md-12">
                    <div id="error-msg" class="alert alert-danger alert-dismissible collapse" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center dev-height">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Cities</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent"></div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4">
                    <form id="form" class="form">

                        <div class="input-group">
                            <input type="text" id="token" name="token" class="form-control mb-2" placeholder="API key" required autofocus>
                        </div>

                        <div class="input-group">
                            <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
                            <div class="input-group-append">
                                <button id="formSubmitButton" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
