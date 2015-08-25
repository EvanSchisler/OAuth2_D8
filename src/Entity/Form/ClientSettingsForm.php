<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\Form\ClientSettingsForm.
 */

namespace Drupal\oauth2_server\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ClientSettingsForm.
 *
 * @package Drupal\oauth2_server\Form
 *
 * @ingroup oauth2_server
 */
class ClientSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'Client_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Defines the settings form for The OAuth2 Client entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['Client_settings']['#markup'] = 'Settings form for The OAuth2 Client entities. Manage field settings here.';
    return $form;
  }

}
