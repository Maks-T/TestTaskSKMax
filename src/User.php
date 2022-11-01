<?php

declare(strict_types=1);

namespace App;

class User
{
  private \MySQLi $mysqli;

  public int $id;

  public string $firstName;

  public string $lastName;

  public string $date;

  public string $gender;

  public string $city;

  public function __construct($id, $firstName, $lastName, $date, $gender, $city)
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

  public static function convertDateToAge(string $birthday)
  {
    $diff = date('Ymd') - date('Ymd', strtotime($birthday));

    return substr((string)$diff, 0, -4);
  }

  public static function convertGenderToString(string $gender)
  {
    return $gender === '0' ? 'муж' : 'жен';
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
