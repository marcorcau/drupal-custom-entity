<?php

namespace Drupal\project\Routing;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\AdminHtmlRouteProvider;

/**
 * Provides HTML routes for entities with administrative add/edit/delete pages.
 *
 * Use this class if the add/edit/delete form routes should use the
 * administrative theme.
 *
 * @see \Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider.
 */
class EditFormAsCanonicalHtmlRouteProvider extends AdminHtmlRouteProvider {

  /**
   * Gets the canonical route.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type.
   *
   * @return \Symfony\Component\Routing\Route|null
   *   The generated route, if available.
   */
  protected function getCanonicalRoute(EntityTypeInterface $entity_type) {
    return $this->getEditFormRoute($entity_type);
  }

}
