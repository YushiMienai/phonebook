<?php

class IndexController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function actionIndex() {
        if ($this->isLogged()) {
            $this->pageData['view'] = "index.php";
            $this->pageData['title'] = Configuration::get('title');
            $this->view->render($this->layout, $this->pageData);
        }
        else{
            $this->redirect("/user/login");
        }
    }

    private function getUserId(){
        $user = (new UserModel())->findByLogin($_SESSION['login']);
        return ($user ? $user['id'] : null);
    }

    public function actionAdd(){
        if($this->isLogged()){
            $userId = $this->getUserId();
            $index = new IndexModel();
            $phone = $_POST;
            $phone['user_id'] = $userId;
            $id = $index->savePhone($phone);
            if (isset($_FILES)){
                if($_FILES["pic"]["size"] > 0 && $_FILES["pic"]["error"] == 0){
                    if (!file_exists('../images')) {
                        mkdir('../images', 0755, true);
                    }
                    $fileArray = explode(".", $_FILES["pic"]["name"]);
                    $uploadFile = '../images/' . $id . '.' . $fileArray[count($fileArray) - 1];
                    if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadFile)) {
                        $index->saveImage($id, $uploadFile);
                    } else {
                        $_SESSION['error'] =  "Ошибка в загрузке файла!";
                    }
                }
            }
            $phone['id'] = $id;
            echo json_encode($phone);
        }
        else{
            $this->redirect("/user/login");
        }
    }

    public function actionAll(){
        if($this->isLogged()){
            $userId = $this->getUserId();
            $index = new IndexModel();
            echo json_encode($index->getAllByUser($userId));
        }
    }

    public function actionDel(){
        if($this->isLogged()){
            $id = (int)$_GET['id'];
            $userId = $this->getUserId();
            $index = new IndexModel();
            $info = $index->getByIdAndUserid($id, $userId);
            $del = $index->delByIdAndUserid($id, $userId);
            if ($del == "1"){
                unlink($info['pic']);
            }
            echo $del;
        }
    }

    public function actionShow(){
        if($this->isLogged()){
            $id = (int)$_GET['id'];
            $userId = $this->getUserId();
            $index = new IndexModel();
            $result = $index->getByIdAndUserid($id, $userId);
            $type = pathinfo($result['pic'], PATHINFO_EXTENSION);
            $data = file_get_contents($result['pic']);
            $result['pic'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
            echo json_encode($result);
        }
    }
}