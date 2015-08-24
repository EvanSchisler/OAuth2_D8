<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 24/08/15
 * Time: 1:42 PM
 */

namespace Drupal\oauth2_server\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Url;

class ScopeForm extends EntityForm
{

  public function form(array $form, array &$form_state)
  {

    $form = parent::form($form, $form_state);

    $scope = $this->entity;

    // Change page title for the edit operation
    if ($this->operation == 'edit') {
      $form['#title'] = $this->t('Edit Scope: @name', array('@name' => $scope->name));
    }

    // The flower name.
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 255,
      '#default_value' => $scope->name,
      '#description' => $this->t("Scope name."),
      '#required' => TRUE,
    );

    // The unique machine name of the flower.
    $form['id'] = array(
      '#type' => 'machine_name',
      '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
      '#default_value' => $scope->id,
      '#disabled' => !$scope->isNew(),
      '#machine_name' => array(
        'source' => array('name'),
        'exists' => 'scope_load'
      ),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, array &$form_state)
  {

    $scope = $this->entity;

    $status = $scope->save();

    if ($status) {
      // Setting the success message.
      drupal_set_message($this->t('Saved the scope: @name.', array(
        '@name' => $scope->name,
      )));
    } else {
      drupal_set_message($this->t('The @name scope was not saved.', array(
        '@name' => $scope->name,
      )));
    }
    $url = new Url('scope.list');
    $form_state['redirect'] = $url->toString();
  }
}