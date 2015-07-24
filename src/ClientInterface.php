<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 20/07/15
 * Time: 12:03 PM
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\user\UserInterface;

/**
 * Provides an interface defining a Client entity.
 *
 * @ingroup oauth2_server
 */

interface ClientInterface extends ContentEntityInterface, EntityOwnerInterface{

  /**
   * Gets the created time.
   *
   * @return mixed
   *   The time created.
   */
  public function getCreatedTime();

  /**
   * Gets the changed time.
   *
   * @return mixed
   *   The changed time.
   */
  public function getChangedTime();

  /**
   * Gets the owner.
   *
   * @return mixed
   *   The owner.
   */
  public function getOwner();

  /**
   * Gets the ownerID.
   *
   * @return mixed
   *   The ownerID.
   */
  public function getOwnerId();

  /**
   * Sets the ownerId.
   *
   * @param $uid
   *   Inputted OwnerId.
   *
   * @return mixed
   *   The OwnerId
   */
  public function setOwnerId($uid);

  /**
   * Sets the owner.
   *
   * @param UserInterface $account
   *   The account of the account
   *
   * @return mixed
   *   The id of the user account.
   */
  public function setOwner(UserInterface $account);

  /**
   * Gets the server name.
   *
   * @return mixed
   *   The server name.
   */
  public function getServer();

  /**
   * Sets the Client Server.
   *
   * @param $server
   *   The Client Server.
   *
   * @return $this
   */
  public function setServer($server);

  /**
   * Gets the Client label.
   *
   * @return mixed
   *   Client label.
   */
  public function getLabel();

  /**
   * Set the Client Label.
   *
   * @param $label
   *   The Client label.
   *
   * @return $this
   */
  public function setLabel($label);

  /**
   * Gets the Client Key.
   *
   * @return mixed
   *   The Client Key.
   */
  public function getClientKey();

  /**
   * Sets the Client Key.
   *
   * @param $client_key
   *   The Client Key.
   *
   * @return $this
   */
  public function setClientKey($client_key);

  /**
   * Gets the Client Secret.
   *
   * @return mixed
   *   The Client Secret.
   */
  public function getClientSecret();

  /**
   * Sets the Client Secret.
   *
   * @param $client_secret
   *   The Client Secret.
   *
   * @return $this
   */
  public function setClientSecret($client_secret);

  /**
   * Gets the Public Key.
   *
   * @return mixed
   *   The Public Key.
   */
  public function getPublicKey();

  /**
   * Sets the Public Key.
   *
   * @param $public_key
   *   The Public Key.
   *
   * @return $this
   */
  public function setPublicKey($public_key);

  /**
   * Gets the Redirect Uri.
   *
   * @return mixed
   *  The Redirect URI.
   */
  public function getRedirectUri();

  /**
   * Sets the Redirect Uri.
   *
   * @param $redirect_uri
   *   The Redirect Uri.
   *
   * @return $this
   */
  public function setRedirectUri($redirect_uri);

  /**
   * Gets the Automatic Authorization.
   *
   * @return mixed
   *   The Automatic Authorization.
   */
  public function getAutomaticAuthorization();

  /**
   * Sets the Automatic Authorization.
   *
   * @param $auto_auth
   *   The Automatic Authorization value.
   *
   * @return $this
   */
  public function setAutomaticAuthorization($auto_auth);

  /**
   * Gets the Settings.
   *
   * @return mixed
   *   The Settings.
   */
  public function getSettings();

  /**
   * Sets the Client Settings.
   *
   * @param $settings
   *   Input settings.
   *
   * @return $this
   */
  public function setSettings($settings);

  /**
   * Gets the Language.
   *
   * @return mixed
   *   The Langcode.
   */
  public function getLangcode();

  /**
   * Sets the Language.
   *
   * @param $langcode
   *   The langcode input.
   *
   * @return $this
   */
  public function setLangcode($langcode);
}
