<?php

namespace Drupal\nombres\Services;

class CrudNombresService
{


  /**
   * Obtener todos los datos de la tabla
   */
  public function cargar()
  {

    $query = \Drupal::database()->select('nombres', 'n');
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
  public function cargarPorId($id)
  {

    $query = \Drupal::database()->select('nombres', 'n');
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
   */
  public function guardar($values){
    \Drupal::database()->insert('nombres')
      ->fields($values)->execute();
  }


  /**
   * Actualizar servicio.
   */
  public function actualizar($id,$value){
    \Drupal::database()->update('nombres')
      ->fields($value)
      ->condition('id',$id)
      ->execute();
  }

  /**
   * Eliminar servicio.
   */
  public function eliminar($id){
    \Drupal::database()->delete('nombres')
      ->condition('id',$id)
      ->execute();
  }

}
