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

/**
 * Class User is a class that creates
 *  an instance of a new user or
 *  returns an instance of an
 *  existing user by id
 * @package App
 */
class User
{
  use ConnectDB;

  private \MySQLi $mysqli;

  public int $id;

  public ?string $firstName;

  public ?string $lastName;

  public ?string $date;

  public ?string $gender;

  public ?string $city;

  public function __construct(int $id, string $firstName = null, string $lastName = null, string $date  = null, string $gender  = null, string $city  = null)
  {
    $this->connectDB();

    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->date = $date;
    $this->gender = $gender;
    $this->city = $city;

    $this->createUser();
  }

  private function createUser(): void
  {
    if ($this->getUserById($this->id)) {

      return;
    }

    $request = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `date`, `gender`, `city`) "
      . "VALUES('$this->id', '$this->firstName', '$this->lastName', '$this->date', '$this->gender', '$this->city');";

    $result = $this->mysqli->prepare($request);
    $result->execute();
  }

  public function deleteUserById(int $id): bool
  {
    $request = "DELETE FROM `users` WHERE id={$id};";

    $result = $this->mysqli->prepare($request);
    $result->execute();

    return true;
  }

  private function getUserById(int $id): bool
  {
    $request = "SELECT * FROM `users` WHERE id={$id}";
    $result = $this->mysqli->prepare($request);
    $result->execute();
    $result = $result->get_result();

    if ($result->num_rows !== 0) {
      foreach ($result as $key) {
        $this->id = $key['id'];
        $this->firstName = $key['first_name'];
        $this->lastName = $key['last_name'];
        $this->date  = $key['date'];
        $this->gender = $key['gender'];
        $this->city = $key['city'];
      }

      return  true;
    }

    return  false;
  }

  public static function convertDateToAge(User $user): User
  {
    $diff = date('Ymd') - date('Ymd', strtotime($user->date));
    $user->date = substr((string)$diff, 0, -4);

    return $user;
  }

  public static function  convertGenderToString(User $user): User
  {
    $user->gender === '0' ? 'муж' : 'жен';

    return $user;
  }
}
