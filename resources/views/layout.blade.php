
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>{{config('APP_NAME', 'Blue Bay')}}</title>
        @extends('navbar')
    </head>
        
    <body>
        <br><br><br><br>
       @yield('content')
    </body>

</html>
<script type="text/javascript">
        $(document).ready(function(){
        $("#formButton").click(function(){
            $("#form1").toggle();
        });
    });
    </script>
<style>
    #form1 {

display:none;

}
</style>

