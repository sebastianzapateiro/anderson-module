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
  public function getAll(){


    $query = $this->database->select('animes', 'a');
    $query->fields('a', ['id', 'nombre','descripcion','portada','cover']);
    $result = $query->execute()->fetchAll();
    return $result;
  }

  public function getById($id)
  {
    $query = $this->database->select('animes', 'a');
    $query->fields('a', ['id', 'nombre','descripcion','portada','cover']);
    $query->condition('id', $id);
    $result = $query->execute()->fetchAll();
    return $result;
  }


  public function add($data)
  {
    $result = $this->database->insert('animes')
      ->fields($data)->execute();

    return $result;
  }


  public function update($id,$data): void
  {
    $this->database->update('animes')
      ->fields($data)
      ->condition('id',$id)
      ->execute();
  }

  public function delete($id): void
  {
    $this->database->delete('animes')
      ->condition('id',$id)
      ->execute();
  }

}
