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
      ->pager(5)
      ->execute();

    $clientes = $nodeStorage->loadMultiple($ids);

    $pager = [ '#type' => 'pager' ];

    return [
      '#theme' => 'dashboard',
      '#clientes' => $clientes,
      '#paginador' => $pager,
    ];
  }


  public function clientes(): array
  {
// dpm(\Drupal::service('plugin.manager.block')->getDefinitions());


    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');


    $ids = $nodeStorage->getQuery()
      ->condition('type', 'cliente')
      ->accessCheck(FALSE)
      ->pager(5)
      ->execute();

    $clientes = $nodeStorage->loadMultiple($ids);

    $pager = [ '#type' => 'pager' ];

    return [
      '#theme' => 'clientes',
      '#clientes' => $clientes,
      '#paginador' => $pager,
    ];
  }


}
