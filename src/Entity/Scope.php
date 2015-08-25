<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\Scope.
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\oauth2_server\ScopeInterface;

/**
 * Defines the The OAuth2 Scope entity.
 *
 * @ConfigEntityType(
 *   id = "scope",
 *   label = @Translation("The OAuth2 Scope"),
 *   handlers = {
 *     "list_builder" = "Drupal\oauth2_server\ScopeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\oauth2_server\Form\ScopeForm",
 *       "edit" = "Drupal\oauth2_server\Form\ScopeForm",
 *       "delete" = "Drupal\oauth2_server\Form\ScopeDeleteForm"
 *     }
 *   },
 *   config_prefix = "scope",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/scope/{scope}",
 *     "edit-form" = "/admin/structure/scope/{scope}/edit",
 *     "delete-form" = "/admin/structure/scope/{scope}/delete",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class Scope extends ConfigEntityBase implements ScopeInterface {
  /**
   * The The OAuth2 Scope ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The The OAuth2 Scope label.
   *
   * @var string
   */
  protected $label;

}
