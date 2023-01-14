<?php

namespace Drupal\nombres\Services;


use Drupal\Core\Database\Connection;
/**
 * Class Scoopdb.
 */
class Animesdb  {
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

    
    $query = $this->database->select('animes', 'a');
    $query->fields('a', ['id', 'nombre','descripcion','portada','cover']);
    $result = $query->execute()->fetchAll();


    return dpm($result);
  }


  public function add($data): void
  {
    $this->database->insert('animes')
      ->fields($data)->execute();
  }


}