<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 24/08/15
 * Time: 1:55 PM
 */

namespace Drupal\oauth2_server\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Url;

class ScopeDeleteForm extends EntityConfirmFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete this scope: @name?', array('@name' => $this->entity->name));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelRoute() {
    return new Url('scope.list');
  }
  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }
  /**
   * {@inheritdoc}
   */
  public function submit(array $form, array &$form_state) {

    // Delete and set message
    $this->entity->delete();
    drupal_set_message($this->t('The scope @label has been deleted.', array('@label' => $this->entity->name)));
    $form_state['redirect_route'] = $this->getCancelRoute();

  }
}