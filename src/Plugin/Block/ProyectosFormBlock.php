<?php

namespace Drupal\nombres\Plugin\Block;
use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'servicios' Block.
 *
 * @Block(
 *   id = "Bloque de formulario de articulo",
 *   admin_label = @Translation("Bloque de formulario de articulo"),
 *   category = @Translation("Bloques de formularios custom"),
 * )
 */


class ArticleFormBlock extends BlockBase
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
    $values = array('type' => 'article');

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
