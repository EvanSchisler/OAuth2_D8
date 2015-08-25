<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientInterface.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining The OAuth2 Client entities.
 *
 * @ingroup oauth2_server
 */
interface ClientInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
