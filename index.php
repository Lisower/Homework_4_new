<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  
  $errors['FIO_empty'] = !empty($_COOKIE['FIO_empty']);
  $errors['FIO_error'] = !empty($_COOKIE['FIO_error']);
  
  $errors['phone_number_empty'] = !empty($_COOKIE['phone_number_empty']);
  $errors['phone_number_error'] = !empty($_COOKIE['phone_number_error']);
  
  $errors['e_mail'] = !empty($_COOKIE['e_mail']);
  $errors['birthday'] = !empty($_COOKIE['birthday']);
  $errors['sex'] = !empty($_COOKIE['sex']);
  $errors['favourite_languages'] = !empty($_COOKIE['favourite_languages']);
  $errors['biography'] = !empty($_COOKIE['biography']);
  $errors['check'] = !empty($_COOKIE['check']);

  if ($errors['FIO_empty']) {
    setcookie('FIO_empty', '', 100000);
    setcookie('FIO_value', '', 100000);
    $messages[] = '<div class="error">Заполните имя!</div>';
  }
  if ($errors['FIO_error']) {
    setcookie('FIO_error', '', 100000);
    setcookie('FIO_value', '', 100000);
    $messages[] = '<div class="error">Недопустимое имя! Допустимые символы: буквы английского и русского алфавитов</div>';
  }
  
  if ($errors['phone_number_empty']) {
    setcookie('phone_number_empty', '', 100000);
    setcookie('phone_number_value', '', 100000);
    $messages[] = '<div class="error">Введите номер телефона!</div>';
  }
   if ($errors['phone_number_error']) {
    setcookie('phone_number_error', '', 100000);
    setcookie('phone_number_value', '', 100000);
    $messages[] = '<div class="error">Недопустимый номер телефона! Допустимые символы: цифры 0-9</div>';
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['FIO'] = empty($_COOKIE['FIO_value']) ? '' : $_COOKIE['FIO_value'];
  $values['phone_number'] = empty($_COOKIE['phone_number_value']) ? '' : $_COOKIE['phone_number_value'];
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['FIO'])) {
    setcookie('FIO_empty', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (!preg_match('/^[a-zA-ZйцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ]+$/', $_POST['FIO'])) {
    setcookie('FIO_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (empty($_POST['phone_number'])) {
    setcookie('phone_number_empty', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  if (!is_numeric($_POST['phone_number']) || !preg_match('/^\d+$/', $_POST['phone_number'])) {
    setcookie('phone_number_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('FIO_value', $_POST['FIO'], time() + 30 * 24 * 60 * 60);
  setcookie('phone_number_value', $_POST['phone_number'], time() + 30 * 24 * 60 * 60);

// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('FIO_empty', '', 100000);
    setcookie('FIO_error', '', 100000);
    
    setcookie('phone_number_empty', '', 100000);
    setcookie('phone_number_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в БД.
  // ...

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
