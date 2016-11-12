<!DOCTYPE html>
<html>
    <head>
    <title>TODOリスト - 新規タスク作成</title>
    </head>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <body>
        <div class="container">
            <p id="msg">　　　</p>
            <h2>タスク新規登録</h2>
            <form action="/regist" method="post">
                <div class="form-group">
                    <label>タスク名</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>本文</label>
                    <textarea name="message" rows=8 cols=40  class="form-control"></textarea>
                </div>
                <input value="新規作成" id="newbutton" name="do" type="submit" class="btn btn-default navbar-btn"></button>
                <input value="戻る" id="cancelbutton" name="cancel" type="submit" class="btn btn-default navbar-btn"></button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>

    </body>

</html>
