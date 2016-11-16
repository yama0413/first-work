<!DOCTYPE html>
<html lang="en">
    <title>TODOリスト</title>
    <head>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/js/jquery-tmpl/jquery.tmpl.min.js"></script>

        <script id="template_todoitem" type="text/x-query-tmpl">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="checkbox"><label><input name="state" type="checkbox" class="check_${id}">達成</label></div>
                    <button id="btnupd_${id}" name="update" type="button" class="btn btnupd btn-default navbar-btn">更新</button>
                    <button id="btndel_${id}" name="delete" type="button" class="btn btndel btn-default navbar-btn">削除</button>
                     ${title}
                </div>
                <div class="panel-body">
                    <div class="msgform">
                        <textarea name="message" id="textarea_${id}" class="textarea form-control" rows="4">${message}</textarea>
                    </div>
                </div>
            </div>
            <input id="token2" type="hidden" name="_token" value="{{ csrf_token() }}">
        </script>

        <script type="text/javascript">
        <!--
        $(document).ready(function(){

            var taskName = $("#modal_taskname").val()
            var message = $("#modal_message").val()

            $("body").on("click", "#modal_newbutton", function(event){
                event.preventDefault();
                console.log("new click");

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     url: "/new",
                     type: "POST",
                     data: {
                         "taskname":$("#modal_taskname").val(),
                         "message" :$("#modal_message").val()
                     },
                     success:function(data){
                         // NOTE: POST -> GET
                         $("#todoitems").empty()
                         $.get("/tasklist", function(items){
                            // JSON形式のデータをtmplに渡す
                            var data = items;
                            $("#template_todoitem").tmpl(data).appendTo("#todoitems");
                            $("#myModal").modal("hide")
                         });
                     },
                     error:function(XMLHttpRequest, textStatus, errorThrown){
                         alert("Error:" + textStatus);
                     },
                     complete:function(){
                         $("#modal_taskname").val("");
                         $("#modal_message").val("");
                     },
                 });
            });


            $("body").on("click", ".btnupd", function(e){
                var id = e.target.id.slice(7)
                $(this).prop("disabled",true);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/updtask/" + id,
                    type: "POST",
                    data: {
                        "message": $("#textarea_" + id).val(),
                        "state": $(".check_" + id).prop('checked')
                    },
                    beforeSend:function(XMLHttpRequest){
                        $(this).prop("disabled",true);
                    },
                    success:function(data){
                         // NOTE: POST -> GET
                         $("#todoitems").empty()
                         $.get("/tasklist", function(items){
                            // JSON形式のデータをtmplに渡す
                            var data = items;
                            $("#template_todoitem").tmpl(data).appendTo("#todoitems");
                            $("#myModal").modal("hide")
                         });
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error:" + textStatus);
                    },
                    complete:function(){
                        $(this).prop("disabled",false);
                    },
                });
            });
            $("body").on("click", ".btndel", function(e){
                var id = e.target.id.slice(7)
                $(this).prop("disabled",true);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/remove/" + id,
                    type: "POST",
                    data: {},

                    beforeSend:function(XMLHttpRequest){
                        $(this).prop("disabled",true);
                    },
                    success:function(data){
                         // NOTE: POST -> GET
                         $("#todoitems").empty()
                         $.get("/tasklist", function(items){
                            // JSON形式のデータをtmplに渡す
                            var data = items;
                            $("#template_todoitem").tmpl(data).appendTo("#todoitems");
                            $("#myModal").modal("hide")
                         });

                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error:" + textStatus);
                    },
                    complete:function(){
                    },
                });
            });


            /*
            $(".msgform").keyup(function(e){
                alert($("textarea",this).val());
                alert(e.key);
            });
            */



            // ウィンドウを閉じる際に処理を行う
            $(window).on("beforeunload", function(e){
                ;
            });


        });
        //-->
        </script>
        <title>TODOリスト</title>
    </head>

    <body>
        <p id="test"></p>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="container-header">
                    <button data-toggle="modal" data-target="#myModal" type="button" id="newbutton" class="btn btn-default navbar-btn">
                        新規
                    </button>
                </div>
            </div>
        </nav>

        <div id="todo_container" class="container">
            <h4>TODOリスト一覧</h4>
            <div id="todoitems">
            @foreach($users as $user)
            <div class="panel panel-success">
                <div class="panel-heading">
                    @if($user->state === 1)
                    <div class="checkbox"><label><input name="state" type="checkbox" class="check_{{$user->id}}" checked="checked">達成</label></div>
                    @else
                    <div class="checkbox"><label><input name="state" type="checkbox" class="check_{{$user->id}}">達成</label></div>
                    @endif
                    <button id="btnupd_{{$user->id}}" name="update" type="button" class="btn btnupd btn-default navbar-btn">更新</button>
                    <button id="btndel_{{$user->id}}" name="delete" type="button" class="btn btndel btn-default navbar-btn">削除</button>
                    {{ $user->title }}
                </div>
                <div class="panel-body">
                    <div class="msgform">
                        <textarea name="message" id="textarea_{{$user->id}}" class="textarea form-control" rows="4">{{ $user->message }}</textarea>
                    </div>
                </div>
<!--        
                <div class="panel-footer">
                    登録日：{{ $user->done_date }}<br />
                    締切日：{{ $user->deadline_date }}<br />
                </div>
--!>        
            </div>
            @endforeach
            </div> <!-- end todoitems-->


 
            <!-- モーダルウィンドウの中身 -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h2 class="modal-title">新規作成</h2>
                                <hr />
                                <div class="form-group">
                                    <label>タスク名</label>
                                    <input id="modal_taskname" type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="modal-body">
                            <div class="form-group">
                            <label>本文</label>
                                <textarea id="modal_message" rows=8 cols=40  class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="modal_newbutton" type="button" class="btn btn-default  navbar-btn">新規作成</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>

