angular.module('myApp',['ui.bootstrap', 'ui.bootstrap.datetimepicker', 'ngResource'])

// モーダル用コントローラー
.controller('modalController', function ($uibModal, $document) {
    var ctrl = this;

    ctrl.open = function (size, parentSelector) {
        var parentElem = parentSelector ? 
        angular.element($document[0].querySelector('.modal-template ' + parentSelector)) : undefined;
      
        //
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'newTodoContent.html',
            controller: 'ModalInstanceCtrl',
            controllerAs: 'ctrl',
            size: size,
            appendTo: parentElem,
        });
    };
})


// TODOリスト関係のコントローラー
.controller('todoController', ['$log', function($log, $resource){

    $log.debug($resource);

    // テスト用データの設定
    this.todolist = [
        {
         id:"1",
         taskname:"タスク１",
         message:"タスク１のメッセージです。",
         scheduling_date:"2016-11-19 14:00:00",
         state:false,
        },
        {
         id:"2",
         taskname:"タスク２",
         message:"タスク２のメッセージです。",
         scheduling_date:"2016-11-19 14:00:00",
         state:true,
        },
        {
         id:"3",
         taskname:"タスク３",
         message:"タスク３のメッセージです。",
         scheduling_date:"2016-11-19 14:00:00",
         state:true,
        },

        {
         id:"4",
         taskname:"タスク４",
         message:"タスク４のメッセージです。",
         scheduling_date:"2016-11-19 14:00:00",
         state:true,
        },

        {
         id:"5",
         taskname:"タスク５",
         message:"タスク５のメッセージです。",
         scheduling_date:"2016-11-19 14:00:00",
         state:false,
        },
    ];

    // 更新ボタン
    this.updButton = function(todo){
        $log.debug("update");
        $log.debug(todo);
    }

    // 削除ボタン
    this.delButton = function(todo){
        $log.debug("delete");
        $log.debug(todo);
    }

    this.completeCheck = function(todo){
        $log.debug("complete check")
        $log.debug(todo);
    }

}])

// ナビゲーションのボタン用コントローラー
.controller('navController', ['$log', function($log){
    this.hideComplete = true;
    
    this.navNewButton = function(){
        $log.debug("navigation new");
    }

    this.navShowComplete = function(){
        $log.debug("navigation show complete");
        $log.debug(this.hideComplete);
    }
}])

// モーダルインスタンス用のコントローラー
.controller('ModalInstanceCtrl', function ($uibModalInstance) {

    this.ok = function () {
        $uibModalInstance.close();
    };

    this.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    this.isOpen = false;
    this.openCalendar = function(e){
        e.preventDefault();
        e.stopPropagation();
        this.isOpen = !this.isOpen;
    }
});

