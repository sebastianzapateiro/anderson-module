<?php

namespace Drupal\nombres\controller;


// mis imports 
use Drupal\nombres\Services\Animesdb;

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
    $markup = ['#markup' => $this->t('home'),];

    $build[] = $formulario;
    $build[] = $tabla;
    $build[] = $markup;
    return $build;
  }

  public function add()
  {
    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];
    $build[] = $markup;
    return $build;
  }

  public function getById()
  {
    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];
    $build[] = $markup;
    return $build;
  }

  public function getAll()
  {
    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];
    $build[] = $markup;
    return $build;
  }

  public function update()
  {
    
    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];
    $build[] = $markup;
    return $build;
  }

  public function delete()
  {
    $markup = ['#markup' => $this->t('esta es la pagina con el formulario'),];
    $build[] = $markup;
    return $build;
  }

  

}
