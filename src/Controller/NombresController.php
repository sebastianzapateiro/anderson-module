<?php

namespace Drupal\nombres\controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\nombres\Services\CrudNombresService;
use Drupal\nombres\Services\ServiciosService;
use Drupal\nombres\Services\Scoopdb;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NombresController extends ControllerBase
{


  /**
   * La conexión a la base de datos.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;
  protected $crud;
  protected $serviciosservice;
  protected $scoopdb;

  /**
   * Crea una nueva instancia del controlador.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   La conexión a la base de datos.
   */
  public function __construct(Connection $database, CrudNombresService $crud, Scoopdb $scoopdb,ServiciosService $serviciosservice)
  {
    $this->database = $database;
    $this->crud = $crud;
    $this->scoopdb = $scoopdb;
    $this->serviciosservice = $serviciosservice;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('database'),
      $container->get('nombres.crudNombres'),
      $container->get('nombres.icecream'),
      $container->get('nombres.servicios_crud')
    );
  }


  /**
   * Carga todos los datos de la tabla nombres.
   */
  public function cargar()
  {

    /** @var CrudNombresService $servicio */
    $servicio = $this->crud;
    $data = $servicio->cargar();

    $servicio = $this->serviciosservice;
    $servicio->test();

    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\NombresForm');


    return [
      '#theme' => 'listar_nombres',
      '#form' => $formulario,
      '#data' => $data,
    ];
  }

  /**
   * Carga un registro por ID de la tabla nombres.
   */
  public function cargarPorId($id)
  {


    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\ServiciosForm');

    /** @var CrudNombresService $servicio */
    $servicio = $this->crud;
    $data = $servicio->cargarPorId($id);


    return [
      '#theme' => 'ver_nombres',
      '#data' => $data,
      '#form' => $formulario,
    ];
  }

  /**
   * Agrega un registro a la tabla nombres.
   */
  public function agregar()
  {

    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\NombresForm');

    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];

    $build[] = $formulario;
    $build[] = $markup;
    return $build;
  }

  /**
   * Edita un registro por id a la tabla nombres.
   */

  public function editar($id)
  {

    /** @var CrudNombresService $servicio */
    $servicio =     $this->crud;
    $data = $servicio->cargarPorId($id);

    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\NombresForm', $data);


    $nombre = $data[0]['nombre'];

    $markup = ['#markup' => "Se esta editando los datos del registro con id: $id y nombre:  $nombre",];

    $build[] = $markup;
    $build[] = $formulario;
    return $build;
  }


  /**
   * Elimina un registro a la tabla nombres.
   */
  public function eliminar($id)
  {


    /** @var CrudNombresService $servicio */
    $servicio =     $this->crud;
    $data = $servicio->cargarPorId($id);

//    /** @var CrudNombresService $servicio */
//    $servicio =     $this->crud;;
//    $data = $servicio->eliminar($id);


    if (!empty($data)) {
      $nombre = $data[0]['nombre'];

      $build = "<p>Esta seguro que desea eliminar el registro con el nombe de: ID $id - $nombre</p>
                    <a class='button--action button' href='/nombres'>Cancelar</a>
                    <a class='button--primary button' href='/nombres/$id/eliminar/si'>Eliminar</a>
                    ";
    } else {
      $build = "<h2>No hay datos para este id: $id</h2>
                <a class='button--action button' href='/nombres'>Regresar</a>";
    }


    return [
      '#type' => 'markup',
      '#markup' => $build,
    ];
  }

  /**
   * Elimina un registro a la tabla nombres.
   */
  public function eliminarSi($id)
  {




    /** @var CrudNombresService $servicio */
    $servicio =     $this->crud;
    $data = $servicio->eliminar($id);

    return $this->redirect('nombres.cargar');
  }

}
