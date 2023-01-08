<?php

namespace Drupal\nombres\Services;

class CrudNombresService
{

  /**
   * Obtener todos los datos de la tabla
   */
  public function cargar(): array
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
  public function cargarPorId($id): array
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
   * @throws \Exception
   */
  public function guardar($values): void
  {
    \Drupal::database()->insert('nombres')
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
    \Drupal::database()->delete('nombres')
      ->condition('id',$id)
      ->execute();
  }

}
