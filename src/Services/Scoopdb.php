<?php

namespace Drupal\nombres\Services;


use Drupal\Core\Database\Connection;
/**
 * Class Scoopdb.
 */
class Scoopdb  {
  /**
   * @var \Drupal\Core\Database\Connection $database
   */
  protected $database;

  /**
   * Constructs a new Scoopdb object.
   * @param \Drupal\Core\Database\Connection $connection
   */
  public function __construct(Connection $connection) {
    $this->database = $connection;
  }

  /**
   * Returns list of nids from icecream table.
   */
  public function test(){

    
    $query = $this->database->select('servicios', 's');
    $query->fields('s', ['id', 'nombre','descripcion']);
    $result = $query->execute();


    return dpm('test');
  }
}