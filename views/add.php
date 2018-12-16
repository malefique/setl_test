<?php

$content = <<<EOT
<div class="row">
    <div class="col-md-12">
          <h4 class="mb-3">Новое сообщение</h4>
          <div class="alert alert-success" style="display: none;" role="alert">
                        Сообщение добавлено
            </div>
          <form class="add">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="author">Имя</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="" value="" required="">
                <div class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
              <div class="invalid-feedback">
              </div>
            </div>

            <div class="mb-3">
              <label for="subject">Заголовок</label>
              <input type="text" class="form-control" id="subject" name="subject" placeholder="" required="">
              <div class="invalid-feedback">
              </div>
            </div>

            <div class="mb-3">
              <label for="message">Текст сообщения</label>
              <textarea name="message" cols="30" rows="10" class="form-control" id="message" required=""></textarea>
            </div>
            
            <div class="mb-3">
              <label for="captcha">Введите текст с изображения</label>
              <img id="captchaImage" src="/captcha" /> <a href="#" id="refreshCaptcha">Обновить</a>
              <input type="text" class="form-control" id="captcha" name="captcha" placeholder="" required="">
              <div class="invalid-feedback">
              </div>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Отправить</button>
          </form>
    </div>
</div>
EOT;


require_once ('layout.php');
