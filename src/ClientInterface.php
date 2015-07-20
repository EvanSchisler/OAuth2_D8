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

/**
 * Provides an interface defining a Client entity
 * @ingroup oauth2_server
 */

interface ClientInterface extends ContentEntityInterface, EntityOwnerInterface{

}
