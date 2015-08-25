<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientEntityAccessControlHandler.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Client entity.
 *
 * @see \Drupal\oauth2_server\Entity\ClientEntity.
 */
class ClientEntityAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view client entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit client entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete client entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add client entities');
  }

}
