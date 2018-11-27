
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('APP_NAME', 'Blue Bay')}}</title>
        @extends('navbar')
    </head>
        
    <body>
        <br><br><br><br>
       @yield('content')
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
       

    </body>

</html>
<script type="text/javascript">
        $(document).ready(function(){
        $("#formButton").click(function(){
            $("#form1").toggle();
        });
    });
    (function($) {  

$('.dropdown-page-select .dropdown-menu a').click(function (e) {
  e.preventDefault();
  $(this).closest('.dropdown-submit-input').find('input').val($(this).data('value'));
  $(this).closest('form').submit();
});

})(jQuery);
   
    </script>
<style>
    #form1 {

display:none;

}
</style>

