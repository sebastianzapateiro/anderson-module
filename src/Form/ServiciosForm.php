<?php

namespace Drupal\nombres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\nombres\Services\Serviciosdb;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form definition for the servicios form.
 */
class ServiciosForm extends FormBase {


/**
   * @var \Drupal\Core\Database\Connection $database
   */
  protected $serviciosdb;

  /**
   * Constructs a new Scoopdb object.
   * @param \Drupal\Core\Database\Connection $connection
   */
  public function __construct(Serviciosdb $serviciosdb) {
    $this->serviciosdb = $serviciosdb;
  }


  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('nombres.servicios_crud')
    );
  }


  public function getFormId() {
    return 'servicios_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $values = []){

    // dpm($values);

    $form['id'] = array(
      '#type' => 'value',
      '#value' => $values ? $values['id'] : '',
    );

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#required' => TRUE,
      '#default_value' => '',
    );

    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Descripcion'),
      '#required' => TRUE,
    );


    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Agregar',
    );

   

    return $form;
  }

 
  public function validateForm(array &$form, FormStateInterface $form_state){

  }

 
  public function submitForm(array &$form, FormStateInterface $form_state){

    $valores = $form_state->getValues();

    $values = [
      'nombre' => $form_state->getValue('nombre'),
      'nombres_id' => $form_state->getValue('id'),
      'descripcion' => $form_state->getValue('descripcion'),
    ];


//
   dpm($valores , 'Valores del formulario de servicios');

    if ($valores['submit']==='Agregar'){
      /** @var Serviciodb $servicio */
      $servicio = $this->serviciosdb;
      $data = $servicio->guardar($values);
    }
  // else{


  //     /** @var CrudNombresService $servicio */
  //     $servicio = $this->crud;
  //     $data = $servicio->actualizar($valores['nombre_id'],$values);
  //     $form_state->setRedirect('nombres.cargar');
  //     \Drupal::messenger()->addMessage('Se ha actualizado correctamente el registro');
  //   }



  }


}
