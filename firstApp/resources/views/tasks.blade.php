<!DOCTYPE html>
<html lang="jp" ng-app="myApp">
    <head>
        <title>TODOリスト</title>

        <!-- 外部提供スクリプト・スタイルシートの読み込み -->
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="/bower_components/angular/angular.min.js"></script>
        <script src="/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
        <script src="/bower_components/angular-animate/angular-animate.min.js"></script>
        <script src="/bower_components/angular-touch/angular-touch.min.js"></script>
        <script src="/bower_components/bootstrap-ui-datetime-picker/dist/datetime-picker.min.js"></script>

        <!-- 自分で作ったスクリプト・スタイルシートの読み込み -->
        <link rel="stylesheet" href="./css/tasks.css">
        <script src="./js/tasks.js"></script>
    </head>

    <body ng-controller="navController as navCtrl">
        <div ng-controller="modalController as ctrl">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- ナビゲーションバーの定義 -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">予定管理</a>
                    <button type="button" ng-click="ctrl.open('md', '.modal-parent')" class="btn btn-default btn-default navbar-btn">新規作成</button>
                    <button type="button" ng-click="navCtrl.navShowComplete()" class="btn btn-default" ng-model="navCtrl.hideComplete" uib-btn-checkbox btn-checkbox-true="false" btn-checkbox-false="true">完了タスクを表示</button>
                </div>
            </div>
        </nav>

        <!-- タスク表示コンテナ -->
        <div class="container-fluid todolist">
            <div ng-controller="todoController as todoCtrl">

                <!-- タスクの表示 -->
                <uib-accordion close-others="true">
                    <div ng-repeat="todo in todoCtrl.todolist">
                        <div class="todoitem" ng-hide="todo.state && navCtrl.hideComplete">
                            <div uib-accordion-group class="panel panel-default">
                                <!-- ヘッダ -->
                                <uib-accordion-heading class="panel-heading">
                                    <input class="myCheck" type="checkbox" ng-model="todo.state" ng-click="todoCtrl.completeCheck(todo); $event.stopPropagation();">
                                    <span class="panel-title">@{{todo.taskname}}</span>
                                    <span class="datetime">締切日：@{{todo.scheduling_date}}</span>
                                    <button class="btn btn-default">詳細</button>
                                </uib-accordion-heading>

                                <!-- 内容 -->
                                <textarea ng-model"todo.message" class="form-control" rows="8" ng-model="todo.message"></textarea>
                                <div class="edit-buttons">
                                    <button class="btn btn-default" ng-click="todoCtrl.updButton(todo)">更新</button>
                                    <button class="btn btn-default" ng-click="todoCtrl.delButton(todo)">削除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </uib-accordion>
            </div>
        </div><!-- タスク表示コンテナ -->




        <!-- モーダルテンプレート -->
        <div class="modal-template">
            <script type="text/ng-template" id="newTodoContent.html">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title">新規作成</h3>
                </div>
                <div class="modal-body" id="modal-body">
                    <div>
                        <div class="form-group">
                            <h4>タスク名</h4>
                            <input type="text" class="form-control" ng-model="ctrl.newTaskname"></input>
                        </div>

                        <div class="form-group">
                            <h4>締切日</h4>
                            <div class='input-group date'>
                                <input type="text" class="form-control" datetime-picker="dd MMM yyyy HH:mm" ng-model="ctrl.newDate" is-open="ctrl.isOpen" />
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar" ng-click="ctrl.openCalendar($event, prop)"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <h4>本文</h4>
                            <textarea ng-model="ctrl.newMessage" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" ng-click="ctrl.ok()">OK</button>
                    <button class="btn btn-warning" type="button" ng-click="ctrl.cancel()">Cancel</button>
                </div>
            </script>

            <!-- モーダル -->
            <div class="modal-parent"></div>
        </div>
        </div><!-- end modalController -->
    </body>
</html>

