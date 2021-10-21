<?php

namespace Drupal\project;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a project entity type.
 */
interface ProjectInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the project title.
   *
   * @return string
   *   Title of the project.
   */
  public function getTitle();

  /**
   * Sets the project title.
   *
   * @param string $title
   *   The project title.
   *
   * @return \Drupal\project\ProjectInterface
   *   The called project entity.
   */
  public function setTitle($title);

  /**
   * Gets the project creation timestamp.
   *
   * @return int
   *   Creation timestamp of the project.
   */
  public function getCreatedTime();

  /**
   * Sets the project creation timestamp.
   *
   * @param int $timestamp
   *   The project creation timestamp.
   *
   * @return \Drupal\project\ProjectInterface
   *   The called project entity.
   */
  public function setCreatedTime($timestamp);

}
