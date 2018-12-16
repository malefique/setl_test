<?php

namespace controllers;

Router::get('/api/posts','Api@posts', ['count' => 10,'offset' => 0]);
Router::get('/api/refreshCaptcha', 'Api@refreshCaptcha');
Router::post('/api/post/send','Api@postSend');
Router::post('/api/login','Api@login');

if(isset($_SESSION['login']))
{
    Router::get('/api/posts/all','Api@postsAdmin', ['count' => 10,'offset' => 0]);
    Router::get('/api/logout','Api@logout');
    Router::get('/api/delete/:id','Api@postDelete');
    Router::get('/api/showHide/:id','Api@postShowHide');
}