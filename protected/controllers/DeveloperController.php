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

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform only 'login' action
                'actions'=>array('login'),
                'users'=>array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' AND 'delete' AND 'index' actions
                'actions'=>array('index','adduser','users', 'calendar', 'userinfo', 'projectinfo', 'editproject', 'saveprojectchanges', 'addprojectuser', 'deleteproject', 'createmindmap', 'mindmap', 'addtodo', 'todo', 'checktask', 'addtask', 'archivetask', 'addproject', 'addmindmap', 'refreshmap', 'UserAdded'),
                'users'=>array('@'),
                'expression'=>'($user->usergroup === "admin")'
            ),
            array('allow', // allow admin user to perform 'admin' AND 'delete' AND 'index' actions
                'actions'=>array('index', 'calendar', 'userinfo', 'projectinfo', 'mindmap', 'addtodo', 'todo', 'checktask', 'addtask', 'archivetask', 'addmindmap', 'refreshmap', 'UserAdded'),
                'users'=>array('@'),
                'expression'=>'($user->usergroup === "client")'
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex() {

        $projects = tblProject::model()->findAll();

        if(Yii::app()->user->usergroup == 'admin') {

            $model = array();

            foreach ($projects as $project) {

                $todo = Todo::model()->findall('projectId=:projectId', array(':projectId' => $project->projectId));
                $mindmap = Mindmap::model()->find('projectId=:projectId', array(':projectId' => $project->projectId));
                $user = User::model()->findall();

                if (!$todo) {
                    $todo = null;
                }
                if (!$mindmap) {
                    $mindmap = null;
                }
                $projecttest = new Project($project, $todo, $mindmap);
                $model[] = $projecttest;
            }
        }
        else {
            //$allow_projects = tblProject::model()->find('projectId=:projectId', array(':projectId' => Yii::app()->user->projectId));

            $model = array();
            foreach ($projects as $project) {

                $todo = Todo::model()->findall('projectId=:projectId', array(':projectId' => $project->projectId));
                $mindmap = Mindmap::model()->find('projectId=:projectId', array(':projectId' => $project->projectId));
                $user = User::model()->findall();

                if (!$todo) {
                    $todo = null;
                }
                if (!$mindmap) {
                    $mindmap = null;
                }
                $projecttest = new Project($project, $todo, $mindmap);
                $model[] = $projecttest;
            }
        }

        $this->render('index', array(
            'model' => $model,
            'user'  => $user
        ));
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

        $user = new User();

        $projects = TblProject::model()->findAll();
        $list = array();

        foreach ($projects as $project) {
            $list[$project['projectId']] = $project['title'];
        }


        if(isset($_POST['ajax']) && $_POST['ajax']==='user-adduser-form') {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }
        else {
            if (isset($_POST['User'])) {
                $user->attributes = $_POST['User'];
                $asd = $user->validate();
                if($asd) {
                    $pass = crypt($user->password);
                    $user->password = $pass;

                    $user->save();
                    $this->redirect('index.php?r=developer/useradded');
                }
            }
        }
        $this->render('adduser', array('model' => $user, 'projects' => $list));
    }

    public function actionUserAdded() {
        $this->render('useradded');
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
            $todo = Todo::model()->findall('projectId=:projectId', array(':projectId' => $id));
            $mindmap = Mindmap::model()->findAll('projectId=:projectId', array(':projectId' => $id));
            $user = User::model()->findAll('projectId=:projectId', array(':projectId' => $id));
            $all_users = User::model()->findAll();

            if ($project) {
                $this->render('projectinfo', array(
                    'model'     => $project,
                    'todo'      => $todo,
                    'mindmap'   => $mindmap,
                    'user'      => $user,
                    'allusers'  => $all_users
                ));
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
        $user = Yii::app()->user->name;
        if ($status == "false") {
            $status = "true";
            $curr_date = date('Y-m-d H:i:s');
        } else {
            $status = "false";
            $curr_date = "";
        }
        $sql = "UPDATE tbl_task SET status = '" . $status . "', completed = '" . $curr_date . "', user = '" . $user . "' WHERE taskId = '" . $id . "'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }

    public function actionAddTask($id, $title) {
        $curr_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO tbl_task (title, todoId, created) VALUES ('".$title."', '".$id."', '" . $curr_date . "');";
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

        $empty_project = new tblProject();
        $project = new tblProject();

        if(isset($_POST['ajax']) && $_POST['ajax']==='project-addproject-form') {
            echo CActiveForm::validate($project);
            Yii::app()->end();
        }
        else {
            if (isset($_POST['TblProject'])) {
                $curr_date = date('Y-m-d H:i:s');
                $project->modified = $curr_date;
                $project->attributes = $_POST['TblProject'];
                $asd = $project->validate();
                if($asd) {
                    $project->save();
                    $this->redirect("index.php?r=developer/index");
                }
            }
        }

        $this->render('addproject', array('model' => $empty_project));
        //$this->render('index');
    }

    public function actionEditproject($project_id) {
        $project = tblProject::model()->find('projectId=:projectId', array(':projectId' => $project_id));

        $this->render('editproject', array('model' => $project));
    }

    public function actionSaveprojectchanges() {
        $curr_date = date('Y-m-d H:i:s');
        $project_id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $status = $_POST['status'];

        $sql = "UPDATE tbl_project SET start = '$start', end = '$end', title = '$title', description = '$description', modified = '$curr_date', status = '$status' WHERE projectId = '$project_id' ;";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }

    public function actionAddprojectuser() {
        $project_id = $_POST['project_id'];
        $user_id = $_POST['user_id'];

        $sql = "UPDATE tbl_user SET projectId = '$project_id' WHERE id = '$user_id' ;";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rowCount = $command->execute();
    }

    public function actionDeleteproject() {
        $project_id = $_POST['id'];

        $sql = "DELETE FROM tbl_project WHERE projectId = '$project_id' ;";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->execute();

        echo("index.php?r=developer/index");
    }

    public function actionInfo() {
        $this->render('info');
    }

    public function actionCreateMindmap() {
        $this->render('create_mindmap');
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
