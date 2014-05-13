<?php

class DeveloperController extends Controller {

    public function actionAdd() {
        $sql = "CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    projectId INTEGER,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    usergroup VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
)";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
        $this->render('add');
    }

    public function actionUserinfo($id) {
        if (isset($id)) {
            $user = User::model()->find('id=:id', array(':id' => $id));
            if ($user) {
                $this->render('userinfo', array('user' => $user));
            } else {
                $this->render('add');
            }
        } else {
            $this->render('add');
        }
    }

    public function actionAddUser() {
        if (isset($_POST['User'])) {
            $user = new User();
            $user->attributes = $_POST['User'];
            $user->save();
        }
        $model = User::model()->find('id=:id', array(':id' => 1));
        $this->render('adduser', array('model' => $model));
    }
    
    public function actionUsers() {
        $users = User::model()->findAll();
        $this->render('users', array('model' => $users));
    }

    public function actionCalendar() {
        $this->render('calendar');
    }

    public function actionProjectinfo($id) {
        if (isset($id)) {
            $project = tblProject::model()->find('projectId=:projectId', array(':projectId' => $id));
            if ($project) {
                $this->render('projectinfo', array('model' => $project));
            } else {
                $this->render('addproject');
            }
        } else {
            $this->render('addproject');
        }
    }

    public function actionMindmap($id) {
        $as = dirname(__FILE__);
        if (isset($id)) {
            $navigation = $this->NavigationBar($id);
            $mindmap = Mindmap::model()->findAll('projectId=:projectId', array(':projectId' => $id));
            $index = count($mindmap)-1;
            $json = file_get_contents(dirname(__FILE__).'/../../mindmaps/'.$mindmap[$index]->json);
            if ($mindmap) {
                $this->render('mindmap', array('model' => $mindmap, 'json' => $json, 'navigation'=> $navigation));
            } else {
                $this->render('mindmap');
            }
        } else {
            $this->render('index');
        }
    }

    public function actionIndex() {
        $projects = tblProject::model()->findAll();
        $model = array();
        foreach ($projects as $project) {
            
            $todo = Todo::model()->findall('projectId=:projectId', array(':projectId' => $project->projectId));
            $mindmap = Mindmap::model()->find('projectId=:projectId', array(':projectId' => $project->projectId));
            if (!$todo) {
                $todo = null;
            }
            if (!$mindmap) {
                $mindmap = null;
            }
            $projecttest = new Project($project, $todo, $mindmap);
            $model[] = $projecttest;
        }
        $this->render('index', array('model' => $model));
    }
    public function actionAddtodo() {
            if (isset($_POST['Todo'])) {
            $todo = new Todo();
            $todo->attributes = $_POST['Todo'];
            $todo->save();
            $this->redirect("index.php?r=developer/index");
        }
        $empty_todo = new Todo();
        $this->render('addtodo', array('model' => $empty_todo));
    }
    public function actionTodo($id)
    {
        if (isset($id)) {
            $navigation = $this->NavigationBar($id);
            $todo = Todo::model()->find('projectId=:projectId', array(':projectId' => $id));
            if ($todo) {
                $tasks = Task::model()->findall('todoId=:todoId', array(':todoId' => $todo->todoId));
                $tasks = CJSON::encode($tasks);
                $this->render('todo', array('model' => $tasks, 'title' => $todo->title, 'navigation' => $navigation), false, true);
            } else {
                $this->render('todo');
            }
        } else {
            $this->render('todo');
        }
    }
    private function NavigationBar($id) {
        $project = tblProject::model()->find('projectId=:projectId', array(':projectId' => $id));
        $todo = Todo::model()->findall('projectId=:projectId', array(':projectId' => $project->projectId));
        $mindmap = Mindmap::model()->find('projectId=:projectId', array(':projectId' => $project->projectId));
        if (!$todo) {
            $todo = null;
        }
        if (!$mindmap) {
            $mindmap = null;
        }
        $projecttest = new Project($project, $todo, $mindmap);
        return $projecttest;
    }
    public function actionCheckTask($id, $status) {
        if ($status == "false") {
            $status = "true";
        } else {
            $status = "false";
        }
        $sql = "UPDATE tbl_task SET status = '" . $status . "' WHERE taskId = '" . $id . "'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }

    public function actionAddTask($id, $title) {
        $sql = "INSERT INTO tbl_task (title, todoId) VALUES ('".$title."', '".$id."');";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }
    public function actionArchiveTask($id) {
        $sql = "DELETE FROM tbl_task WHERE todoId='" . $id . "' and status='true'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }

    public function actionAddproject() {
        if (isset($_POST['Project'])) {
            $project = new tblProject();
            $project->attributes = $_POST['Project'];
            $project->save();
            $this->redirect("index.php?r=developer/index");
        }
        $empty_project = new tblProject();
        $this->render('addproject', array('model' => $empty_project));
    }

    public function actionInfo() {
        $this->render('info');
    }
    public function actionAddMindmap() {
        $mindmap = new Mindmap();
        $json = $_POST['json'];
        
        if ($_POST['image'] && !empty($_POST['image'])) {

            $dataURL = $_POST['image'];

            $parts = explode(',', $dataURL);
            $data = base64_decode($parts[1]);

            if (is_writable(dirname(__FILE__) . '/../../mindmaps')) {
                $file = date("Ymdhms")."mindmap";
                $success = file_put_contents(dirname(__FILE__).'/../../mindmaps/'.$file.'.png', $data);
                $json = file_put_contents(dirname(__FILE__).'/../../mindmaps/' . $file. '.json', $json);
                //echo ($success ? 'success' : 'unable to save file');
            } else {
                //echo 'directory not writable';
            }
        } else {
            //echo 'no image';
        }
        $mindmap->json = $file.".json";
        $mindmap->img = $file  . ".png";
        $mindmap->projectId = $_POST['id'];
        $mindmap->save();
    }
    public function actionRefreshMap() {
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $mindmap = Mindmap::model()->findall('projectId=:projectId', array(':projectId' => $id));
            if ($mindmap[count($mindmap)-1]) {
                $json = file_get_contents(dirname(__FILE__).'/../../mindmaps/' . $mindmap[count($mindmap) - 1]->json);
                $answer = array(
                    "img"=>  $mindmap[count($mindmap) - 1]->img,
                    "json" => $json
                );
                echo json_encode($answer);
            } else echo "Error";
        }
        
        
    }
    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
