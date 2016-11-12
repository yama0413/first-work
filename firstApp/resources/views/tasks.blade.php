<!DOCTYPE html>
<html lang="en">
    <title>TODOリスト</title>
    <head>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script type="text/javascript">
        <!--
        $(document).ready(function(){
            $(".textarea").change(function(e){
                var objname = $(this).attr("id")
                objname = objname.replace(/textarea/g, 'btnupd')
                $("#"+objname).prop('disabled',false)
            });

            $(".checkbox").click(function(){
                $("#msg").text("checkbox touched")
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
                    <form action="/new" method="post">
                        <button id="newbutton" type="submit" class="btn btn-default navbar-btn">
                            新規
                        </button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>TODOリスト一覧</h2>
            @foreach($users as $user)
            <form action="/updtask/{{$user->id}}" method="post">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        @if($user->state === 1)
                        <div id="check_{{$user->id}}" class="checkbox"><label><input name="state" type="checkbox" value="checked" checked=checked>達成</label></div>
                        @else
                        <div id="check_{{$user->id}}" class="checkbox"><label><input name="state" type="checkbox" value="checked">達成</label></div>
                        @endif
                        <input value="更新" id="btnupd_{{$user->id}}" name="update" type="submit" class="btn btnupd btn-default navbar-btn">
                        <input value="削除" id="btndel_{{$user->id}}" name="delete" type="submit" class="btn btn-default navbar-btn">
                        {{ $user->title }}
                    </div>
                    <div class="panel-body">
                        <textarea name="message" id="textarea_{{$user->id}}" class="textarea form-control" rows="4">{{ $user->message }}</textarea>
                    </div>
<!--            
                    <div class="panel-footer">
                        登録日：{{ $user->done_date }}<br />
                        締切日：{{ $user->deadline_date }}<br />
                    </div>
--!>            
                </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            @endforeach
        </div>
    </body>
</html>

