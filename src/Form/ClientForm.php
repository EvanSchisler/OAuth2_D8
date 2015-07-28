<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 27/07/15
 * Time: 4:41 PM
 */

namespace Drupal\oauth2_server\Form;
use

  Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Language\Language;
use Drupal\Core\Form\FormStateInterface;

class ClientForm extends ClientEntityForm {

  public function buildForm(array $form, FormStateInterface$form_state) {

    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;


    $form['langcode'] = array(
      '#title' => $this->t('Language'),
      '#type' => 'language_select',
      '#default_value' => $entity->getUntranslated()->language()->getId(),
      '#languages' => Language::STATE_ALL,
    );
    return $form;
  }

  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('oauth2_server.client_list');
    $entity = $this->getEntity();
    $entity->save();
  }
}