Замечания
---------


1. Не отрабатывает обновление капчи (`#refreshCaptcha`). Вероятно роутер некорректно обрабатывает ссылки, содержащие `trailing-slash`?
   [клац](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/static/js/main.js#L94).
2. Сомнительное решение относительно использования heredoc-синтаксиса в шаблонах.
   Возможно стоило подумать о захвате вывода?
3. Нет аннотаций к методам класса.
4. Нет аннотаций в шаблонах:
    - приходится подглядывать в контроллер;
    - думать, к какому именно контроллеру относится текущая вьюшка;
    - совсем неочевидно, какие данные доступны в текущем представлении.
5. [Здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/Database.php#L12), при повтоном подключении файла вместо массива получим `true`. Вряд ли это ожидаемое поведение.
6. [Здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/Validator.php#L17) осуществлен возврат `$this`. Зачем?
7. Зачем алиасы [тут](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/controllers/Guestbook.php#L5)?
8. Функция [`extract`](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/View.php#L13) может вести себя непредсказуемо. Рекомендую ознакомиться с описанием параметра [`flags`](https://secure.php.net/manual/ru/function.extract.php);
9. [Здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/View.php#L11) и [здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/View.php#L14) использовано одно то же выражение. Это будет удобно модифицировать в будущем?
10. [Зачем](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/helpers/Validator.php#L7) если нигде не используется?
11. Если пользователь достигает страницы `404.php`, то получает ошибку на странице. А что получит админ?
12. Потенциальная ошибка [здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/controllers/Router.php#L59) и [здесь](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/controllers/Router.php#L77). Если клиент небрежен и отправит запрос с заголовком в нижнем или раНдОМноМ регистре, у роутера ничего не получится.
    Простой тест: `curl 'http://localhost:8000/' -X GET` vs `curl 'http://localhost:8000/' -X get`.
13. Почему класс `controllers\Router` расположен в папке с контроллерами? Он разве исполняет ту же функицю?
14. Почему [БЕЗ конструктора](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/controllers/Router.php#L62)?
15. По работе с кодом рекомендуется смотреть в сторону:
    - автозагрузка: [PSR-0](https://www.php-fig.org/psr/psr-0/), [PSR-4](https://www.php-fig.org/psr/psr-4/)
    - оформление кода: [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-2](https://www.php-fig.org/psr/psr-2/);
16. Зачем [дополнительные обращения](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/static/js/main.js#L5) к серверу при отрисовке списков? И в чем ценность [этого](https://github.com/malefique/setl_test/blob/2ed65a87060efb6b89272536c243634f4eddf8cf/views/index.php#L4) предстваления ``?

...
