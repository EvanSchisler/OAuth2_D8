<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 27/07/15
 * Time: 4:44 PM
 */

namespace Drupal\oauth2_server\Form;
use

  Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ClientDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete entity %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   *
   * If the delete command is canceled, return to the contact list.
   */
  public function getCancelURL() {
    return new Url('entity.oauth2_server_client.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   *
   * Delete the entity and log the event. log() replaces the watchdog.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();

    Drupal::logger('oauth2_server')->notice('@type: deleted %title.',
        array(
          '@type' => $this->entity->bundle(),
          '%title' => $this->entity->label(),
        ));
    $form_state->setRedirect('entity.oauth2_server_client.collection');
  }
}