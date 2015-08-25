<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientEntityInterface.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Client entities.
 *
 * @ingroup oauth2_server
 */
interface ClientEntityInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
