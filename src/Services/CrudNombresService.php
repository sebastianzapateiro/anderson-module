<?php

namespace Drupal\nombres\Services;


use Drupal\Core\Database\Connection;

class CrudNombresService
{


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

  public function test(){
    return dpm('test');
  }

  /**
   * Obtener todos los datos de la tabla
   */
  public function cargar(): array
  {

    $query = $this->database->select('nombres', 'n');
    $query->fields('n', ['id', 'nombre']);
    $result = $query->execute();


    $nombres = [];

    foreach ($result as $row) {
      $nombres[] = [
        'id' => $row->id,
        'nombre' => $row->nombre,
      ];
    }

    return $nombres;
  }

  /**
   * Obtener dato por id servicio.
   */
  public function cargarPorId($id): array
  {

    $query = $this->database->select('nombres', 'n');
    $query->fields('n', ['id', 'nombre']);
    $query->condition('id', $id);
    $result = $query->execute();

    $nombres = [];

    foreach ($result as $row) {
      $nombres[] = [
        'id' => $row->id,
        'nombre' => $row->nombre,
      ];
    }

    return $nombres;
  }


  /**
   * Guardar servicio.
   * @throws \Exception
   */
  public function guardar($values): void
  {
    $this->database->insert('nombres')
      ->fields($values)->execute();
  }


  /**
   * Actualizar servicio.
   */
  public function actualizar($id,$value): void
  {
    $this->database->update('nombres')
      ->fields($value)
      ->condition('id',$id)
      ->execute();
  }

  /**
   * Eliminar servicio.
   */
  public function eliminar($id): void
  {
    $this->database->delete('nombres')
      ->condition('id',$id)
      ->execute();
  }

}
