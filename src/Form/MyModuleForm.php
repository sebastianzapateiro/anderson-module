<?php

namespace Drupal\nombres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyModuleForm extends FormBase{

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
  public function buildForm(array $form, FormStateInterface $form_state){

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      /*'#default_value' => 'Nombre',*/
      /*'#size' => 60,*/
      /*'#maxlength' => 128,*/
      /*'#pattern' => 'some-prefix-[a-z]+',*/
      '#required' => TRUE,
    );


    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Descripcion'),
      '#required' => TRUE,
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this
        ->t('Add'),
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
      'descripcion' => $form_state->getValue('descripcion'),
    ];




    \Drupal::database()->insert('servicios')
      ->fields($values)->execute();




  }

}
