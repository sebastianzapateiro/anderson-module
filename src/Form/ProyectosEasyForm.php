<?php

namespace Drupal\nombres\Form;


use Drupal\nombres\Services\Animesdb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

class AnimesForm extends FormBase
{


  protected Animesdb $animesdb;


  public function __construct(Animesdb $animesdb)
  {
    $this->animesdb = $animesdb;
  }


  public static function create(ContainerInterface $container): AnimesForm|static
  {
    return new static(
      $container->get('nombres.animes')
    );
  }


  public function getFormId(): string
  {
    return 'animes_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state, $data = []): array
  {


    $form['portada'] = array(
      '#type' => 'media_library',
      '#allowed_bundles' => ['image'],
      '#name' => 'custom_content_block_portada',
      '#title' => t('Portada'),
      '#size' => 40,
      '#required' => TRUE,
      '#default_value' => $data ? $data[0]->portada : '',
      '#description' => t('La portada debe ser en formato png, jpg.'),
      '#upload_location' => 'public://portada',
      '#upload_validators' => array(
        'file_validate_extensions' => array('png jpg'),

      ),
      '#attributes' => array('class' => array('mb-3')),
    );

    $form['cover'] = array(
      // '#type' => 'managed_file',
      '#type' => 'media_library',
      '#allowed_bundles' => ['image'],
      '#name' => 'custom_content_block_cover',
      '#title' => t('Cover'),
      '#size' => 40,
      '#required' => TRUE,
      '#default_value' => $data ? $data[0]->cover : '',
      '#description' => t('La imagen cover o caratula debe ser en formato png, jpg.'),
      '#upload_location' => 'public://cover',
      '#upload_validators' => array(
        'file_validate_extensions' => array('png jpg'),
      ),
      '#attributes' => array('class' => array('mb-3')),
    );

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#required' => TRUE,
      '#default_value' => $data ? $data[0]->nombre : '',
      '#attributes' => array('class' => array('mb-3')),
    );


    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Description'),
      '#required' => TRUE,
      '#default_value' => $data ? $data[0]->descripcion : '',
      '#attributes' => array('class' => array('mb-3')),
    );


    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t($data ? 'Actualizar' : 'Agregar'),
    );

    $form['id'] = array(
      '#type' => 'hidden',
      '#value' => $data ? $data[0]->id : '',
    );



    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }


  public function submitForm(array &$form, FormStateInterface $form_state, $id = NULL)
  {


    $anime = [
      'nombre' => $form_state->getValue('nombre'),
      'descripcion' => $form_state->getValue('descripcion'),
      // 'portada' => $this->getUri($form_state->getValue('portada')),
      // 'cover' => $this->getUri($form_state->getValue('cover')),
//      'portada' => $this->getUri($array[] = [$form_state->getValue('portada')]),
//      'cover' => $this->getUri($array[] = [$form_state->getValue('cover')]),
      'portada' => $form_state->getValue('portada'),
      'cover' => $form_state->getValue('cover'),
    ];


    if ($form_state->getValue('op') == 'Agregar') {

      $data = $this->animesdb->add($anime);

      // notification
      \Drupal::messenger()->addMessage('Se ha agregado correctamente el registro');
    } else {

      $id = $form_state->getValue('id');

      $data = $this->animesdb->update($id, $anime);

      \Drupal::messenger()->addMessage('Se ha actualizado correctamente');
    }


  }


}


