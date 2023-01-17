<?php

namespace Drupal\my_module\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'servicios' Block.
 *
 * @Block(
 *   id = "Servicios Block",
 *   admin_label = @Translation("Servicios Block"),
 *   category = @Translation("Servicios Block"),
 * )
 */


class ServiciosBlock extends BlockBase
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
    $formulario = \Drupal::formBuilder()->getForm('\Drupal\my_module\Form\MyModuleForm');



    $markup = ['#markup' => $this->t('Este es el markup de mi bloque personalizado'),];

    $build[] = $markup;
    $build[] = $formulario;
    return $build;
  }
}
