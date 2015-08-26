<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\ClientEntity.
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\oauth2_server\ClientEntityInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Client entity.
 *
 * @ingroup oauth2_server
 *
 * @ContentEntityType(
 *   id = "oauth2_server_client",
 *   label = @Translation("Client"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\oauth2_server\ClientEntityListBuilder",
 *     "views_data" = "Drupal\oauth2_server\Entity\ClientEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\oauth2_server\Entity\Form\ClientEntityForm",
 *       "add" = "Drupal\oauth2_server\Entity\Form\ClientEntityForm",
 *       "edit" = "Drupal\oauth2_server\Entity\Form\ClientEntityForm",
 *       "delete" = "Drupal\oauth2_server\Entity\Form\ClientEntityDeleteForm",
 *     },
 *     "access" = "Drupal\oauth2_server\ClientEntityAccessControlHandler",
 *   },
 *   base_table = "oauth2_server_client",
 *   admin_permission = "administer ClientEntity entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/oauth2_server_client/{oauth2_server_client}",
 *     "edit-form" = "/admin/oauth2_server_client/{oauth2_server_client}/edit",
 *     "delete-form" = "/admin/oauth2_server_client/{oauth2_server_client}/delete"
 *   },
 *   field_ui_base_route = "oauth2_server_client.settings"
 * )
 */
class ClientEntity extends ContentEntityBase implements ClientEntityInterface {
  /**
   * {@inheritdoc}
   */
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
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Client entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Client entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Client entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

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
      ->setLabel(t('Label'))
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
        'max_length' => 255,
        'not_null' => TRUE,
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
