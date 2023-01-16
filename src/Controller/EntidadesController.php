<?php

namespace Drupal\nombres\controller;



use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;


class EntidadesController extends ControllerBase
{


    public function test(): array
    {




    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');

    $ids = $nodeStorage->getQuery()
    ->condition('status', 1)
    ->condition('type', 'article')
    ->accessCheck(FALSE)
    ->execute();


    $articles = $nodeStorage->loadMultiple($ids);

    $rows =[];
    foreach ($articles as $node) {
        $rows[] = [
            'data' => [
                $node->toLink(),
                $node->bundle(),
                $node->getOwner()->label(),
            ],
        ];
    }

    $headers = [
        'Titulo',
        'Tipo',
        'Autor',
    ];

    $table = [
        '#type' => 'table',
        '#header' => $headers,
        '#rows' => $rows,
    ];


    $markup = ['#markup' => $this->t('test'),];
    $build[] = $table;
    $build[] = $markup;
    return $build;
  }


    public function add()
  {

    $values = array('type' => 'page');

    try {
      $node = \Drupal::entityTypeManager()
        ->getStorage('node')
        ->create($values);
    } catch (InvalidPluginDefinitionException $e) {

    } catch (PluginNotFoundException $e) {
    }

    $form = \Drupal::entityTypeManager()
      ->getFormObject('node', 'default')
      ->setEntity($node);
      $formulario = \Drupal::formBuilder()->getForm($form);


    $markup = ['#markup' => $this->t('test'),];
    $build[] = $formulario;
    $build[] = $markup;
    return $build;
  }

}
