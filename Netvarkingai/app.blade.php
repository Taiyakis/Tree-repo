<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/styles.css">
        <title>Hostinger</title>
    </head>
    <body>
        <nav class="navbar custom-nav-color">
            <div class="container-fluid">
                <div class="navbar-header">
                    <label class="webname">Hierarchy</label>
                </div>
            </div>
        </nav>

        <div class="container">

            <div class="panel-group">
                <div class="panel panel-color">
                    <div class="panel-heading panel-bg-color">New category form</div>
                    <div class="panel-body">
                        @yield('form')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    @yield('recursive')
                </div>
                <div class="col-sm-6">
                    @yield('iterative')
                </div>
            </div>
        </div>
        
    </body>
</html>  