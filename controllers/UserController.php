<?php


class UserController extends Controller
{
    public function actionLogin(){
        $this->pageData['view'] = "login.php";
        $this->pageData['title'] = Configuration::get('title') . " :: Авторизация";
        $this->view->render($this->layout, $this->pageData);
    }

    public function actionRegister(){
        $this->pageData['view'] = "register.php";
        $this->pageData['title'] = Configuration::get('title') . " :: Регистрация";
        $this->view->render($this->layout, $this->pageData);
    }

    public function actionCreate(){
        $login = trim(strip_tags($_POST['login']));
        $email = trim(strip_tags($_POST['email']));
        $password = trim(strip_tags($_POST['password']));

        $user = new UserModel();
        if ($user->findByLogin($login) != false){
            $_SESSION['error'] = "Такой логин уже существует!";
            $this->redirect("/user/register");
        }
        else{
            $result = $user->save(compact('login','email','password'));
            if ($result) {
                $this->redirect("/");
            }
            else{
                $_SESSION['error'] = "Регистрация не удалась!";
                $this->redirect("/user/register");
            }
        }
    }

    public function actionLogout(){
        session_destroy();
        $this->redirect("/user/login");
    }

    public function actionAuth(){
        $login = trim(strip_tags($_POST['login']));
        $user = (new UserModel())->findByLogin($login);
        echo trim(strip_tags($_POST['password'])) . $login . "<br>";
        $password = UserModel::genPassword(trim(strip_tags($_POST['password'])), $login);
        if ($user['password'] == $password){
            $_SESSION['login'] = $login;
            $this->redirect("/");
        }
        else echo $user['password'] . "<br>" . $password;
        die;
    }
}