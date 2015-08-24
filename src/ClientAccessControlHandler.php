<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 27/07/15
 * Time: 8:58 AM
 */

namespace Drupal\oauth2_server;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class ClientAccessControlHandler extends EntityAccessControlHandler {

  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {
    switch($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view client entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'configure client entity');

      case 'delete':
        return AccessResult::allowedIfHadPermission($account, 'delete client entity');
    }
    return AccessResult::allowed();
  }

  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add client entity');
  }
}