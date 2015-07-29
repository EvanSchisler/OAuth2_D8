<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 27/07/15
 * Time: 4:53 PM
 */

namespace Drupal\oauth2_server\Form;
use

  Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ClientSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'oauth2_server_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * Define the form used for OAuth2_Server settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['client_settings']['#markup'] = 'Settings form for OAuth2_Server. Manage field settings here.';
    return $form;
  }
}