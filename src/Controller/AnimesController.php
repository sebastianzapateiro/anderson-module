<?php

namespace Drupal\nombres\controller;


// mis imports
use Drupal\nombres\Services\Animesdb;
use Drupal\nombres\Helper\Helper;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;


class AnimesController extends ControllerBase
{



  protected $database;
  protected $animesdb;

  public function __construct(Connection $database, Animesdb $animesdb)
  {
    $this->database = $database;
    $this->animesdb = $animesdb;
  }




  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('database'),
      $container->get('nombres.animes'),
    );
  }



  public function home()
  {

    $data = $this->animesdb->getAll();

    $filas = [];
    foreach($data as $item){
      $filas[] = [
        'data' => [
          $item->id,
          $item->descripcion,
          $item->portada,
          $item->cover,
        ]
      ];
    }

    $cabeceras = [
      'id',
      'descripcion',
      'portada',
      'cover',
    ];


    $tabla = [
      '#type' => 'table',
      '#header' => $cabeceras,
      '#rows' => $filas,
    ];





    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\AnimesForm');


    return [
      '#theme' => 'animes',
      '#data' => $data,
      '#form' => $formulario,
      '#table' => $tabla,
    ];
  }



  public function admin()
  {

    $helper = new Helper();




    $resultado = $this->animesdb->getAll();


    $data = [];

    foreach($resultado as $item){
          $data[] = [
            'id' => $item->id,
            'nombre' => $item->nombre,
            'descripcion' => $item->descripcion,
            'portada' => $helper->helpergetUri($item->portada),
            'cover' => $helper->helpergetUri($item->cover),
          ];
    }




    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\AnimesForm');


    return [
      '#theme' => 'animes_admin',
      '#data' => $data,
      '#form' => $formulario,
    ];
  }

  public function adminVer($id,$name)
  {

    $resultado = $this->animesdb->getById($id);
    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\AnimesForm', $resultado);

    $helper = new Helper();

    $data = [];

    foreach($resultado as $item){
      $data[] = [
        'id' => $item->id,
        'nombre' => $item->nombre,
        'descripcion' => $item->descripcion,
        'portada' => $helper->helpergetUri($item->portada),
        'cover' => $helper->helpergetUri($item->cover),
      ];
    }

    return [
      '#theme' => 'animes_admin_ver',
      '#data' => $data,
      '#form' => $formulario,
      // '#table' => $tabla,
    ];

  }

  public function adminEliminar($id)
  {

    $servicio = $this->animesdb->delete($id);

    return $this->redirect('nombres.animes_admin_ver');

  }

  public function getById($id,$name)
  {
//    obtener mi data
    $resultado = $this->animesdb->getById($id);
//    instancia para transformar mi id a url
    $helper = new Helper();

    $data = [];

    foreach($resultado as $item){
      $data[] = [
        'id' => $item->id,
        'nombre' => $item->nombre,
        'descripcion' => $item->descripcion,
        'portada' => $helper->helpergetUri($item->portada),
        'cover' => $helper->helpergetUri($item->cover),
      ];
    }

    return [
      '#theme' => 'animes_ver',
      '#data' => $data,
      // '#form' => $formulario,
      // '#table' => $tabla,
    ];


  }



}
