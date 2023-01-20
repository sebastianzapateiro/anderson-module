<?php

namespace Drupal\nombres\controller;

use Drupal\Core\Controller\ControllerBase;


use Symfony\Component\DependencyInjection\ContainerInterface;


class PortalController extends ControllerBase
{



  public function dashboard(): array
  {


    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');


    $ids = $nodeStorage->getQuery()
      ->condition('type', 'cliente')
      ->accessCheck(FALSE)
      ->execute();

    $clientes = $nodeStorage->loadMultiple($ids);

    return [
      '#theme' => 'dashboard',
      '#clientes' => $clientes,
    ];
  }


}
