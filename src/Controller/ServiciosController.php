<?php

namespace Drupal\nombres\controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class ServiciosController extends ControllerBase
{



  public function servicios(): array
  {

    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');


    $ids = $nodeStorage->getQuery()
      ->condition('type', 'servicios')
      ->accessCheck(FALSE)
      ->execute();

    $servicios = $nodeStorage->loadMultiple($ids);

// dpm(\Drupal::service('plugin.manager.block')->getDefinitions());

    return [
      '#theme' => 'servicios',
      '#servicios' => $servicios,
    ];

  }




}
