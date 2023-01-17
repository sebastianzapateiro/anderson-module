<?php

namespace Drupal\nombres\Form;


use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\nombres\Services\Animesdb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ProyectosEasyForm extends FormBase
{


  public function getFormId(): string
  {
    return 'proyectos_easy_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state, $data = []): array
  {

//    dpm($data, 'data from form');

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#required' => TRUE,
      '#default_value' => '',
      '#attributes' => array('class' => array('mb-3')),
    );

    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Agregar',
    );

    $form['id'] = array(
      '#type' => 'hidden',
      '#value' => $data ? $data : '',
    );



    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }


  public function submitForm(array &$form, FormStateInterface $form_state, $id = NULL)
  {


    $nombre = $form_state->getValue('nombre');

    $node = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->create([
        'type' => 'proyectos',
        'title' => $nombre,
        'field_article_id' => $form_state->getValue('id'),
      ]);

    $node->save();

    $nid = $node->id();

    \Drupal::messenger()->addMessage("Se ha agregado correctamente la entidad $nombre");

//    $form_state->setRedirect('entity.node.canonical', ['node' => $nid]);

dpm($nid, 'Las node created by custom form');


  }


}


