<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Form\ScopeEntityForm.
 */

namespace Drupal\oauth2_server\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ScopeEntityForm.
 *
 * @package Drupal\oauth2_server\Form
 */
class ScopeEntityForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $oauth2_server_scope = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $oauth2_server_scope->label(),
      '#description' => $this->t("Label for the Scope."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $oauth2_server_scope->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\oauth2_server\Entity\ScopeEntity::load',
      ),
      '#disabled' => !$oauth2_server_scope->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $oauth2_server_scope = $this->entity;
    $status = $oauth2_server_scope->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Scope.', [
          '%label' => $oauth2_server_scope->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Scope.', [
          '%label' => $oauth2_server_scope->label(),
        ]));
    }
    $form_state->setRedirectUrl($oauth2_server_scope->urlInfo('collection'));
  }

}
