<?php

namespace Drupal\nombres\Plugin\Block;
use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'servicios' Block.
 *
 * @Block(
 *   id = "Bloque de formulario de Proyectos simple",
 *   admin_label = @Translation("Bloque de formulario de Proyectos simple"),
 *   category = @Translation("Bloques de formularios custom"),
 * )
 */


class ProyectosEasyFormBlock extends BlockBase
{

  /**
   * Builds and returns the renderable array for this block plugin.
   *
   * If a block should not be rendered because it has no content, then this
   * method must also ensure to return no content: it must then only return an
   * empty array, or an empty array with #cache set (with cacheability metadata
   * indicating the circumstances for it being empty).
   *
   * @return array
   *   A renderable array representing the content of the block.
   *
   * @see \Drupal\block\BlockViewBuilder
   */
  public function build(){

    $nid = '';

    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
      // You can get nid and anything else you need from the node object.
      $nid = $node->id();

//      dpm($nid, 'get current node iD');
    }


    $formulario = \Drupal::formBuilder()->getForm('\Drupal\nombres\Form\ProyectosEasyForm',$nid);

    $markup = ['#markup' => $this->t('test'),];
    $build[] = $formulario;
    $build[] = $markup;
    return $build;
  }
}
