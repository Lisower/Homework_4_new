<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
    <title>ФОРМА</title>
  </head>
  
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

    <button id="Button">Открыть форму</button>

        <div id="Popup" class="Popup">
            <form id="Form" action="" method="POST">
                <h1>Форма</h1>

                <label>
                    ФИО<br>
                    <input name="FIO"
                    placeholder="Введите Ваше ФИО"
                    <?php if ($errors['FIO_empty'] || $errors['FIO_error']) {print 'class="error"';} ?> value="<?php print $values['FIO']; ?>"
                    >
                </label><br>

                <label>
                Номер телефона<br>
                <input name="phone_number"
                    type="tel"
                    placeholder="Введите Ваш номер телефона"
                    <?php if ($errors['phone_number_empty'] || $errors['phone_number_error']) {print 'class="error"';} ?> value="<?php print $values['phone_number']; ?>"
                    >
                </label><br>

                <label>
                Почта e-mail<br>
                <input name="e_mail"
                    type="email"
                    placeholder="Введите Вашу почту"
                    <?php if ($errors['e_mail_empty'] || $errors['e_mail_error']) {print 'class="error"';} ?> value="<?php print $values['e_mail']; ?>"
                    >
                </label><br>

                <label>
                    Дата рождения<br>
                    <input name="birthday"
                    type="date"
                    >
                </label><br>
                
                Пол<br>
                <label><input type="radio"
                name="sex" value="М" checked="checked">
                М</label>
                <label><input type="radio"
                name="sex" value="Ж">
                Ж</label><br>

                <label>
                    Любимый язык программирования<br>
                    <select name="favourite_languages[]"
                        multiple="multiple">
                        <option value="1">Pascal</option>
                        <option value="2">C</option>
                        <option value="3">C++</option>
                        <option value="4">JavaScript</option>
                        <option value="5">PHP</option>
                        <option value="6">Python</option>
                        <option value="7">Java</option>
                        <option value="8">Haskel</option>
                        <option value="9">Clojure</option>
                        <option value="10">Prolog</option>
                        <option value="11">Scala</option>
                    </select>
                </label><br>

                <label>
                    Биография<br>
                    <textarea name="biography" placeholder="Напишите Вашу биографию"></textarea>
                </label><br>

                <label><input type="checkbox"
                    name="check" required>
                    С контрактом ознакомлен
                </label><br>

                <input type="submit" value="Сохранить">
            </form>
        </div>
  </body>
</html>
