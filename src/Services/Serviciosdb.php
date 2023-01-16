<?php

namespace Drupal\nombres\Services;


use Drupal\Core\Database\Connection;

class Serviciosdb
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
    return dpm('ServiciosService is working');
  }


  /**
   * Obtener todos los datos de la tabla
   */
  public function cargar(): array
  {

    $query = $this->database->select('servicios', 's');
    $query->fields('s', ['id','nombres_id', 'nombre','descripcion']);
    $result = $query->execute();


    $nombres = [];

    foreach ($result as $row) {
      $nombres[] = [
        'id' => $row->id,
        'nombres_id' => $row->nombres_id,
        'nombre' => $row->nombre,
        'descripcion' => $row->descripcion,
      ];
    }

    return $nombres;
  }

  /**
   * Obtener dato por id servicio.
   */
  public function cargarPorId($id): array
  {

    $query = \Drupal::database()->select('servicios', 's');
    $query->fields('s', ['id', 'nombres_id' ,'nombre', 'descripcion']);
    $query->condition('nombres_id', $id);
    $result = $query->execute();


    $nombres = [];

    foreach ($result as $row) {
      $nombres[] = [
        'id' => $row->id,
        'nombres_id' => $row->nombres_id,
        'nombre' => $row->nombre,
        'descripcion' => $row->descripcion,
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
    $this->database->insert('servicios')
      ->fields($values)->execute();
  }


  /**
   * Actualizar servicio.
   */
  public function actualizar($id,$value): void
  {
    \Drupal::database()->update('nombres')
      ->fields($value)
      ->condition('id',$id)
      ->execute();
  }

  /**
   * Eliminar servicio.
   */
  public function eliminar($id): void
  {
    
    $this->database->delete('animes')
      ->condition('id',$id)
      ->execute();
  }

}
