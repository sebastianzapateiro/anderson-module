<?php

namespace Drupal\nombres\controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ProfileController extends ControllerBase
{



  protected $database;

  public function __construct(Connection $database)
  {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('database'),
    );
  }



  public function test(): array
  {

    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

    $uid = $user->id();

     $query = $this->database->select('perfiles', 'p');
     $query->fields('p', ['id', 'nombre','descripcion']);
     $query->condition('id', $uid);
     $result = $query->execute()->fetchAll();


    $formulario = $this->formBuilder()->getForm('\Drupal\nombres\Form\ProfileForm', $result);

    return [
        '#theme' => 'perfil',
        '#form' => $formulario,
      ];

  }



}
