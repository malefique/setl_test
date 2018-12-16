<?php

$content = <<<EOT
<div class="row">
    <div class="col-md-12">
          <h4 class="mb-3">Вход в панель управления</h4>
          <form class="login">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="" value="" required="">
                <div class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="login">Пароль</label>
              <input type="password" class="form-control" id="password" name="password" required="">
              <div class="invalid-feedback">
              </div>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Войти</button>
          </form>
    </div>
</div>
EOT;


require_once('layout.php');
