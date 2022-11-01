<?php

declare(strict_types=1);

require './../vendor/autoload.php';

use App\User;

const HOST_NAME = '127.0.0.1';
const USER_NAME = 'root';
const PASSWORD = '';
const DB_NAME = "sk-max";

$user = new User(2, 'Maxim', 'Tsatsura', '1989-01-07', '0', 'Mogilev');

echo $user::convertDateToAge($user->date);
echo $user::convertGenderToString($user->gender);
