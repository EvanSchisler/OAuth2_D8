<?php

/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 20/07/15
 * Time: 11:59 AM
 */
namespace Drupal\oauth2_server\Entity;
use

  Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

class Client extends ContentEntityBase implements ContactInterface{

  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }


  /**
   * {@inheritdoc}
   */
  public function getChangedTime() {
    return $this->get('changed')->value;
  }


  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }


  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }


  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * @param EntityTypeInterface $entity_type
   * Field definitions
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Client entity.'))
      ->setReadOnly(TRUE);


    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Client entity.'))
      ->setReadOnly(TRUE);

    $fields['server'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Server'))
      ->setDescription(t('The {oauth2_server}.name of the parent server'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -8,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -8,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label;'))
      ->setDescription(t('The label of the client'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
        'default' => '',
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -7,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -7,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // The OAuth2 spec calls the client key "client_id", but we need that
    // for the autoincrement.
    $fields['client_key'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Client Key'))
      ->setDescription(t('The client key'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['client_secret'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Client Secret'))
      ->setDescription(t('The client secret'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['public_key'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Public Key'))
      ->setDescription(t('The public key'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['redirect_uri'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Redirect URI'))
      ->setDescription(t('The absolute URI to redirect to after authorization'))
      ->setSettings(array(
        'max_length' => 255,
        'not_null' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['automatic_authorization'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Automatic Authorization'))
      ->setDescription(t('Whether authorization should be completed without user confirmation.'))
      ->setSettings(array(
        'size' => 'tiny',
        'not_null' => TRUE,
        'default' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -2,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['settings'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Settings'))
      ->setDescription(t('Client specific settings.'))
      ->setSettings(array(
        'size' => 'big',
        'not_null' => TRUE,
        'serialize' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -1,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -1,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Client entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));


    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}