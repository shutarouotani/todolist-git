<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ToDoList</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- 自サイトのCSS -->
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        @include('commons.navbar')
        @include('commons.modal_create')

        <div class="container">
            @include('commons.error_messages')

            @yield('content')
        </div>
        
        <script>
            // タスク追加がクリックされた時に実行される
            document.getElementById("CreateTaskModal").onclick = function() {
                $('#modal-create').modal('show');
            };
        </script>
    </body>
</html>