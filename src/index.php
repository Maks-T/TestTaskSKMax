<?php

/**
 * Author: Maksim Tsatsura
 *
 * Implementation date: 01.11.1989 21:00
 *
 * Modification date: 02.11.1989 10:00
 *
 * Database utility: phpmyadmin
 **/

declare(strict_types=1);

require './../vendor/autoload.php';

use App\User;
use App\UserCollection;

const HOST_NAME = '127.0.0.1';
const USER_NAME = 'root';
const PASSWORD = '';
const DB_NAME = "sk-max";

//$user1 = new User(1, 'Maxim', 'Tsatsura', '1989-01-07', '0', 'Mogilev');
//$user2 = new User(2, 'Vadim', 'Petrov', '1992-12-01', '0', 'Minsk');
//$user3 = new User(3, 'Alexsandra', 'Svetlakova', '2002-11-24', '1', 'Brest');
//$user4 = new User(4, 'Svetlana', 'Alekseeva', '2001-07-02', '1', 'Vitebsk');
//$user5 = new User(5, 'Oleg', 'Vladimirov', '2001-08-14', '0', 'Grodno');

//print_r(User::convertDateToAge($user));
//print_r(User::convertGenderToString($user));

//$users = new UserCollection([1, 2, 3, 4, 5]);
//$users->deleteAllUsers();
