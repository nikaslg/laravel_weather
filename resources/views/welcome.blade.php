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
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="citiesTabs" role="tablist">
                    </ul>
                    <div class="tab-content" id="citiesContent">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                <form class="form-signin">

                    <div class="input-group">
                        <input type="text" id="token" class="form-control mb-2" placeholder="API key" required autofocus>
                    </div>

                    <div class="input-group">
                        <input type="text" id="city" class="form-control" placeholder="City" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </body>
</html>
