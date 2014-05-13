<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
<?php
/* @var $this DeveloperController */

$this->breadcrumbs=array(
	'Developer'=>array('/developer'),
	'Todos'  => array('/developer'),
        'Todo1'
);
?>

<?php 
/*
 * <h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
 * if ($model) {
    echo "<ul class='tasks'>";
     foreach ($model as $task) {
         echo "<li id='".$task->taskId."'class='".$task->status."'>".$task->title."</li>";
     }  
     echo "</ul>";
    
  } */
?>
<div ng-app  id="todos" class="main-column">
    
    <div ng-controller="TodoCtrl">
        <h2><?php echo $title; ?></h2>
        <span class="remaining">{{remaining()}} of {{todos.length}} remaining
            [ <a href="" ng-click="archive(<?php echo $_REQUEST['id']; ?>)">delete completed</a> ]</span>
        <table class="bgwhite">
            <tr class="todo" ng-repeat="todo in todos">
                <td class="checkbox">
                    <input ng-change="updateTodo({{todo.taskId}},{{todo.status}})" class="task-checkbox" type="checkbox" ng-true-value="true" ng-false-value="false" value="{{todo.status}}" ng-model="todo.status" id="task-{{todo.taskId}}">
                </td>
                <td>
                    <label for="task-{{todo.taskId}}" class="done-{{todo.status}}">{{todo.title}}</label>
                </td>
            </tr>
        </table>
        <form class="addtodo adduser" ng-submit="addTodo(<?php echo $_REQUEST['id']; ?>)">
            <input type="text" ng-model="todoText"  size="30" placeholder="add new todo here">
            <input class="btn-primary" type="submit" value="add">
            <div class="cb"></div>
        </form>
    </div>
</div>
<?php
if ($navigation) {
    $this->renderPartial('navigation', array('model' => $navigation));
}
?>
<div class="cb">
</div>
<script>
function TodoCtrl($scope, $http) {
  $scope.todos = <?php echo $model ?>;

  $scope.addTodo = function(id) {
    $scope.todos.push({title:$scope.todoText, status:false});
    $http.put("index.php?r=developer/addTask&id=" + id + "&title="+ $scope.todoText);
    $scope.todoText = '';
  };

  $scope.remaining = function() {
    var count = 0;
    angular.forEach($scope.todos, function(todo) {
      count += JSON.parse(todo.status) ? 0 : 1;
    });
    return count;
  };

  $scope.archive = function(id) {
    $http.put("index.php?r=developer/archiveTask&id=" + id);
    var oldTodos = $scope.todos;
    $scope.todos = [];
    angular.forEach(oldTodos, function(todo) {
      if (!JSON.parse(todo.status)) $scope.todos.push(todo);
    });
  };
    $scope.updateTodo = function(id, status) {
      $http.put("index.php?r=developer/checkTask&id=" + id + "&status="+ status);
    };
}
</script>
