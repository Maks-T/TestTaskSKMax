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

/**
 * Trait ConnectDB is a trait 
 * that provides a function
 * for connecting to the database
 */
trait ConnectDB
{
  private function connectDB(): void
  {
    $this->mysqli = new \MySQLi(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);

    if ($this->mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
      exit();
    }
  }
}
