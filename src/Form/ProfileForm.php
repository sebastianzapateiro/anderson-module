<?php

namespace Drupal\nombres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ProfileForm extends FormBase{

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
    return 'profile_form';
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
  public function buildForm(array $form, FormStateInterface $form_state, $data = []){

//    dpm($data, 'From form');
//    dpm($data[0]->id, 'id');
////    $data ? $data[0]->portada : ''

    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => $this
        ->t('Nombre'),
      '#default_value' => $data ? $data[0]->nombre : '',
      /*'#size' => 60,*/
      /*'#maxlength' => 128,*/
      /*'#pattern' => 'some-prefix-[a-z]+',*/
      '#required' => TRUE,
      '#attributes' => array('class' => array('mb-3 border-0 border-bottom bg-light')),
    );


    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => $this
        ->t('Descripcion'),
      '#default_value' => $data ? $data[0]->descripcion : '',
      '#required' => TRUE,
      '#attributes' => array('class' => array('mb-3 border-0 border-bottom bg-light')),
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $data ? 'Actualizar' : 'Agregar',
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

    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

    $values = [
      'uid' => $user->id(),
      'nombre' => $form_state->getValue('nombre'),
      'descripcion' => $form_state->getValue('descripcion'),
    ];



    if ($form_state->getValue('op') === 'Agregar'){


       \Drupal::database()->insert('perfiles')
         ->fields($values)->execute();

      \Drupal::messenger()->addMessage('Perfil completado y actualizado ');
    }else{

      \Drupal::database()->update('perfiles')
        ->fields($values)
        ->condition('id',$user->id())
        ->execute();
      \Drupal::messenger()->addMessage('Perfil Actualizado');
    };






  }

}
