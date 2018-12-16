<?php

namespace controllers;

Router::get('/','Guestbook@index');
Router::get('/post/:id','Guestbook@post');
Router::get('/add','Guestbook@add');
Router::get('/admin','Guestbook@admin');
Router::get('/captcha', 'Guestbook@captcha');