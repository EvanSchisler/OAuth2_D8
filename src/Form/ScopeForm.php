<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Form\ScopeForm.
 */

namespace Drupal\oauth2_server\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ScopeForm.
 *
 * @package Drupal\oauth2_server\Form
 */
class ScopeForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $scope = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $scope->label(),
      '#description' => $this->t("Label for the The OAuth2 Scope."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $scope->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\oauth2_server\Entity\Scope::load',
      ),
      '#disabled' => !$scope->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $scope = $this->entity;
    $status = $scope->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label The OAuth2 Scope.', [
          '%label' => $scope->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label The OAuth2 Scope.', [
          '%label' => $scope->label(),
        ]));
    }
    $form_state->setRedirectUrl($scope->urlInfo('collection'));
  }

}
