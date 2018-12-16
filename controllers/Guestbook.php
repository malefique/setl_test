<?php

namespace controllers;

use helpers\View as View;
use models\Post as Post;
use helpers\Database as Database;
use helpers\Captcha as Captcha;

class Guestbook extends Controller
{
    public function index()
    {
       $params = [
           'title' => 'Гостевая книга'
       ];

       View::print('index',$params);
    }

    public function post($id)
    {
        $post = new Post(Database::connect());
        $post = $post->getOne(intval($id));
        if($post){
            $params = [
                'title' => $post['subject'],
                'post' => $post
            ];

            View::print('post',$params);
        }
        else
            View::print('404',[ 'title' => 'Страница не найдена']);
    }

    public function add()
    {
        $params = [
            'title' => 'Добавление сообщения'
        ];

        View::print('add',$params);
    }

    public function admin()
    {
        if(isset($_SESSION['login'])){
            $params = [
                'title' => 'Управление',
                'login' => $_SESSION['login']
            ];
            View::print('admin/index', $params);
        }
        else{
            $params = [
                'title' => 'Вход'
            ];
            View::print('login', $params);
        }
    }

    public function captcha()
    {
        $captcha = new Captcha();
    }
}