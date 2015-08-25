<?php

/**
 * @file
 * Contains oauth2_server_client.page.inc.
 *
 * Page callback for Client entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Client templates.
 *
 * Default template: oauth2_server_client.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_oauth2_server_client(array &$variables) {
  // Fetch ClientEntity Entity Object.
  $oauth2_server_client = $variables['elements']['#oauth2_server_client'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
