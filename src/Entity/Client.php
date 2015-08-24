<?php

/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 20/07/15
 * Time: 11:59 AM
 */
namespace Drupal\oauth2_server\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\oauth2_server\ClientInterface;
use Drupal\user\UserInterface;

/**
 * Defines the client entity class
 *
 * @ContentEntityType(
 *  id = "oauth2_server_client",
 *  label = @Translation("Client"),
 *  handlers = {
 *    "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *    "list_builder" = "Drupal\oauth2_server\ClientListBuilder",
 *     "form" = {
 *       "add" = "Drupal\oauth2_server\Form\ClientForm",
 *       "edit" = "Drupal\oauth2_server\Form\ClientForm",
 *       "delete" = "Drupal\oauth2_server\Form\ClientDeleteForm",
 *     },
 *     "access" = "Drupal\oauth2_server\ClientAccessControlHandler",
 *   },
 *   base_table = "oauth2_server_client",
 *   admin_permission = "administer client entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/oauth2_server/oauth2_server_client/{oauth2_server_client}",
 *     "edit-form" = "/admin/oauth2_server/oauth2_server_client/{oauth2_server_client}/edit",
 *     "delete-form" = "/admin/oauth2_server/oauth2_server_client/{oauth2_server_client}/delete",
 *     "collection" = "/oauth2_server/list"
 *   },
 *   field_ui_base_route = "oauth2_server.client_settings",
 * )
 *
 */
class Client extends ContentEntityBase implements ClientInterface {

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
  public function getServer(){
    return $this->get('server')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setServer($server){
    $this->set('server', $server);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel(){
    return $this->get('label')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setLabel($label){
    $this->set('label', $label);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getClientKey(){
    return $this->get('client_key')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setClientKey($client_key){
    $this->set('client_key', $client_key);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getClientSecret(){
    return $this->get('client_secret')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setClientSecret($client_secret){
    $this->set('client_secret', $client_secret);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getPublicKey(){
    return $this->get('public_key')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPublicKey($public_key){
    $this->set('public_key', $public_key);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRedirectUri(){
    return $this->get('redirect_uri')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setRedirectUri($redirect_uri){
    $this->set('redirect_uri', $redirect_uri);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getAutomaticAuthorization(){
    return $this->get('automatic_authorization')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setAutomaticAuthorization($auto_auth){
    $this->set('auto_authorization', $auto_auth);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getSettings(){
    return $this->get('settings')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setSettings($settings){
    $this->set('settings', $settings);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getLangcode(){
    return $this->get('langcode')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setLangcode($langcode){
    $this->set('langcode', $langcode);
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