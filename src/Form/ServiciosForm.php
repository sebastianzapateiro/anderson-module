<?php

namespace Drupal\nombres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form definition for the servicios form.
 */
class ServiciosForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'servicios_form';
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


    $form['id'] = array(
      '#type' => 'value',
      '#value' => $values ? $values[0]['id'] : '',
    );

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#required' => TRUE,
      '#default_value' => $values ? $values[0]['nombre'] : '',
    );

    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Descripcion'),
      '#required' => TRUE,
    );


    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $values ? 'Actualizar' : 'Agregar',
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

   

    $valores = $form_state->getValues();
//
   dpm($valores);

  //   if ($valores['submit']==='Agregar'){
  //     /** @var CrudNombresService $servicio */
  //     $servicio = $this->crud;
  //     $data = $servicio->guardar($values);
  //   }else{


  //     /** @var CrudNombresService $servicio */
  //     $servicio = $this->crud;
  //     $data = $servicio->actualizar($valores['nombre_id'],$values);
  //     $form_state->setRedirect('nombres.cargar');
  //     \Drupal::messenger()->addMessage('Se ha actualizado correctamente el registro');
  //   }



  }


}
