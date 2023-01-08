<?php

namespace Drupal\nombres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nombres\Services\CrudNombresService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NombresForm extends FormBase
{



  /**
   * Llamada al servicio.
   */
  protected $crud;

  /**
   * Crea una nueva instancia del servicio.
   * @param CrudNombresService $crud
   */
  public function __construct( CrudNombresService $crud)
  {
    $this->crud = $crud;
  }

  /**
   * @param ContainerInterface $container
   * @return NombresForm|static
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('nombres.crudNombres')
    );
  }






  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId(){
    return 'my_module_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $values = []){


    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#required' => TRUE,
      '#default_value' => $values ? $values[0]['nombre'] : '',
    );


    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $values ? 'Actualizar' : 'Agregar',
    );

    $form['nombre_id'] = array(
      '#type' => 'value',
      '#value' => $values ? $values[0]['id'] : '',
    );

    return $form;
  }

  /**
   * Form validation handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state){

  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state){

    $values = [
      'nombre' => $form_state->getValue('nombre'),
    ];

    $valores = $form_state->getValues();
//
//    dpm($valores);

    if ($valores['submit']==='Agregar'){
      /** @var CrudNombresService $servicio */
      $servicio = $this->crud;
      $data = $servicio->guardar($values);
    }else{


      /** @var CrudNombresService $servicio */
      $servicio = $this->crud;
      $data = $servicio->actualizar($valores['nombre_id'],$values);
      $form_state->setRedirect('nombres.cargar');
      \Drupal::messenger()->addMessage('Se ha actualizado correctamente el registro');
    }



  }


}
