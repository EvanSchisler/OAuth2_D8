<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientAccessControlHandler.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the The OAuth2 Client entity.
 *
 * @see \Drupal\oauth2_server\Entity\Client.
 */
class ClientAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view the oauth2 client entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit the oauth2 client entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete the oauth2 client entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add the oauth2 client entities');
  }

}
