<?php

return array(
    'username' => array(
        'not_empty' => 'Введите логин',
        'min_length' => 'Минимальная длина логина :param2 символа',
        'max_length' => 'Максимальная длина логина :param2 символа',
        'username_available' => 'Пользователь с таким логином уже зарегистрирован',
        'unique' => 'Пользователь с таким логином уже зарегистрирован',
    ),
    'firstname' => array(
            'not_empty' => 'Введите свое имя'
    ),
    'lastname' => array(
            'not_empty' => 'Введите свою фамилию'
    ),
    'email' => array(
        'not_empty' => 'Введите email',
        'min_length' => 'Минимальная длина email :param2 символа',
        'max_length' => 'Максимальная длина email :param2 символа',
        'email' =>   'Введите корректный email',
        'email_available' => 'Пользователь с таким email уже зарегистрирован',
        'unique' => 'Пользователь с таким email уже зарегистрирован',
    ),
);
