<?php

/**
 * Implements hook_uninstall()
 */
function chardin_steps_uninstall() {
  // destroy tables and variables
  return true;
}

/**
 * Implements hook_update_version()
 */
function chardin_steps_update_1() {
  // TODO: perform any nessesary database changes when updating to this version.
  return true;
}
?>