<?php

class View
{
    public function render($layout, $pageData) {
        ob_start();
        $error = '';
        if (isset($_SESSION['error'])){
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $success = '';
        if (isset($_SESSION['success'])){
            $success = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        include( ROOT . '/views/' . $pageData['view']);
        $title = $pageData['title'];
        $content = ob_get_contents();
        ob_end_clean();
        require_once ROOT. '/views/layout/' . $layout . '.php' ;
    }
}