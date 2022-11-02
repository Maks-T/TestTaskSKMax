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

namespace App;

use App\ConnectDB;
use App\User;

/**
 * Class UserCollection is a class 
 * that creates a collection 
 * of users by their id
 */
class UserCollection
{
  use ConnectDB;

  private \MySQLi $mysqli;

  /** @var User[] $users */
  public array $users = [];

  /** @var int[] $usersId */
  private array $usersId = [];

  public function __construct(array $usersId)
  {
    $this->connectDB();

    $this->usersId = $usersId;
    $this->createUsers();
  }

  private function createUsers(): void
  {
    foreach ($this->usersId as $userId) {
      $this->users[] = new User($userId);
    }
  }

  public function deleteAllUsers(): void
  {
    foreach ($this->users as $user) {
      $user->deleteUserById($user->id);
    }
  }

  private function connectDB()
  {
    $this->mysqli = new \MySQLi(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);

    if ($this->mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
      exit();
    }
  }
}
