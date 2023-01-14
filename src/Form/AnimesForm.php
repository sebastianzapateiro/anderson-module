<?php

namespace Drupal\nombres\Form;




use Drupal\nombres\Services\Animesdb;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;


use Symfony\Component\DependencyInjection\ContainerInterface;

class AnimesForm extends FormBase
{


  protected $animesdb;

  
  public function __construct( Animesdb $animesdb)
  {
    $this->animesdb = $animesdb;
  }

 
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('nombres.animes')
    );
  }


  public function getFormId(){
    return 'animes_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state){


    $form['portada'] = array(
      '#type' => 'managed_file',
      '#name' => 'custom_content_block_portada',
      '#title' => t('Portada'),
      '#size' => 40,
      '#required' => TRUE,
      // '#description' => t('La portada debe ser en formato png, jpg.'),
      '#upload_location' => 'public://portada',
      '#upload_validators' => array(
        'file_validate_extensions' => array('png jpg'),
        
      ),
      '#attributes' => array('class' => array('mb-3')), 
    );

    $form['cover'] = array(
      '#type' => 'managed_file',
      '#name' => 'custom_content_block_cover',
      '#title' => t('Cover'),
      '#size' => 40,
      '#required' => TRUE,
      // '#description' => t('La imagen cover o caratula debe ser en formato png, jpg.'),
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
      '#default_value' => '',
      '#attributes' => array('class' => array('mb-3')), 
    );


    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Description'),
      '#required' => TRUE,
      '#default_value' => '',
      '#attributes' => array('class' => array('mb-3')), 
    );


    


    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
    );
    $form['actions']['delete'] = array(
      '#type' => 'button',
      '#value' => t('Delete'),
    );
    $form['actions']['cancel'] = array(
      '#markup' => "<a href='./' class='btn btn-danger'>Regresar</a>",
    );



    return $form;
  }

  
  public function validateForm(array &$form, FormStateInterface $form_state){

  }

 
  public function submitForm(array &$form, FormStateInterface $form_state){



    $anime = [
      'nombre' => $form_state->getValue('nombre'),
      'descripcion' => $form_state->getValue('descripcion'),
      'portada' => $this->getUri($form_state->getValue('portada')),
      'cover' => $this->getUri($form_state->getValue('cover')),
    ];


    $data = $this->animesdb->add($anime);
      
    dpm($data);

  }

// funcion para obtener la url del servicio de load 
  public function getUri($uri){

    $file = File::load(reset($uri));
    $file->setPermanent();
    $file->save();
    $url = $file->createFileUrl($file->getFileUri());
    return $url;
  }

}


