<!DOCTYPE html>
<html lang="en">
    <title>TODOリスト</title>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--
        <link rel="stylesheet" href="{{ base_path('bower_compose/bootstrap/dist/css/bootstrap.min.css') }}">
        <script src="{{ base_path('bower_compose/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ base_path('bower_compose/bootstrap/dist/js/bootstrap.min.js') }}"></script>
--!>

        <script type="text/javascript">
        <!--
        $(document).ready(function(){
            $("#newbutton").click(function(){
                $("#msg").text("New Button Clicked!")
            });

            $("#editbutton").click(function(){
                $("#msg").text("Edit Button Clicked!")
            });

            $("#delbutton").click(function(){
                $("#msg").text("Delete Button Clicked!")
            });
        });
        //-->
        </script>
        <title>TODOリスト</title>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="container-header">
                    <button id="newbutton" type="button" class="btn btn-default navbar-btn">
                        新規
                    </button>

                    <button id="editbutton" type="button" class="btn btn-default navbar-btn">
                        編集
                    </button>

                    <button id="delbutton" type="button" class="btn btn-default navbar-btn">
                        削除
                    </button>
                </div>
            </div>
        </nav>

        <div class="container">
            <p id="msg"></p>
            <h2>TODOリスト一覧</h2>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="checkbox"><label><input type="checkbox">達成</label></div>
                    タスク１
                </div>
                <div class="panel-body">
                    本文をここに記述
                </div>
                <div class="panel-footer">
                    締切：<br />
                    登録：<br />
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    通常タスク
                </div>
                <div class="panel-body">
                    本文をここに記述
                </div>
                <div class="panel-footer">
                    締切：<br />
                    登録：<br />
                </div>
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    超過タスク
                </div>
                <div class="panel-body">
                    本文をここに記述
                </div>
                <div class="panel-footer">
                    締切：<br />
                    登録：<br />
                </div>
            </div>
        </div>

    </body>
</html>

