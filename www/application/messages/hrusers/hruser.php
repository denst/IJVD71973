<?php
return array(
    'firstname' => array(
        'not_empty' => 'Введите свое имя',
        'min_length' => 'Минимальная длина имени :param2 символа',
        'max_length' => 'Максимальная длина имени :param2 символа',
    ),
    'lastname' => array(
        'not_empty' => 'Введите свою фамилию',
        'min_length' => 'Минимальная длина фамилии :param2 символа',
        'max_length' => 'Максимальная длина фамилии :param2 символа',
    ),
    'company' => array(
        'not_empty' => 'Введите компанию'
    ),
    'post' => array(
        'not_empty' => 'Введите свою должность',
        'min_length' => 'Минимальная длина должности :param2 символа',
        'max_length' => 'Максимальная длина должности :param2 символа',
    ),
    'email' => array(
        'not_empty' => 'Введите email',
        'email' =>   'Введите корректный email',
        'email_available' => 'Пользователь с таким email уже зарегистрирован',
        'unique' => 'Пользователь с таким email уже зарегистрирован',
    ),
    'telephone' => array(
        'not_empty' => 'Введите свой телефон',
        'phone' => 'Введите корректный телефон'
    ),
);