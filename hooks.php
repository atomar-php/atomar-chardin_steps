<?php
/**
 * Implements hook_permission()
 */
function chardin_steps_permission() {
  return array(
    'administer_chardin_steps',
    'access_chardin_steps'
  );
}

/**
 * Implements hook_menu()
 */
function chardin_steps_menu() {
  return array();
}

/**
 * Implements hook_model()
 */
function chardin_steps_model() {
  return array();
}

/**
 * Implements hook_url()
 */
function chardin_steps_url() {
  return array(
    '/!/chardin_steps/(?P<api>[a-zA-Z\_-]+)/?(\?.*)?'=>'CChardinStepsAPI'
  );
}

/**
 * Implements hook_libraries()
 */
function chardin_steps_libraries() {
  return array(
    'ChardinStepsAPI.php'
  );
}

/**
 * Implements hook_cron()
 */
function chardin_steps_cron() {
  // execute actions to be performed on cron
}

/**
 * Implements hook_twig_function()
 */
function chardin_steps_twig_function() {
  // return an array of key value pairs.
  // key: twig_function_name
  // value: actual_function_name
  // You may use object functions as well
  // e.g. ObjectClass::actual_function_name  
  return array();
}

/**
 * Implements hook_preprocess_page()
 */
function chardin_steps_preprocess_page() {
  S::$css[] = '/includes/extensions/chardin_steps/css/chardinsteps.css';
  S::$js[] = '/includes/extensions/chardin_steps/js/chardinsteps.js';
  S::$js_onload[]=<<<JAVASCRIPT
var chardinstepsNextBtn = $('<div id="chardin-next" class="btn btn-default btn-xs chardin-button" title="Proceed to the next tip" style="display:none;">next tip <span class="glyphicon glyphicon-chevron-right"></span></div>')
  , chardinstepsPrevBtn = $('<div id="chardin-previous" class="btn btn-default btn-xs chardin-button" title="Return to the previous tip" style="display:none;"><span class="glyphicon glyphicon-chevron-left"></span> previous tip</div>')
  , chardinstepsInstructions = $('<div id="chardin-instructions" style="display:none;">Use the arrow buttons to move between tips</div>')
  , startTutorialButton = $('<div id="chardin-tutorial" class="btn btn-info">Quick Help</div>');

if ($('.chardinstep').length > 0) {
  $('body').prepend(chardinstepsInstructions);
  $('body').prepend(chardinstepsPrevBtn);
  $('body').prepend(chardinstepsNextBtn);
  $('body').prepend(startTutorialButton);

  var stepsController = $('body').chardinstepsjs({
      click_to_dismiss: false,
      reset_on_resume: true
    });
  $('body').on('chardinStepsJs:start', function() {
    chardinstepsNextBtn.show();
    chardinstepsPrevBtn.show();
    chardinstepsInstructions.show();
    startTutorialButton.hide();
  });
  $('body').on('chardinStepsJs:stop', function() {
    chardinstepsNextBtn.hide();
    chardinstepsPrevBtn.hide();
    chardinstepsInstructions.hide();
    startTutorialButton.show();
  });
  if($('.chardinstep').length) {
    startTutorialButton.on('click', function(e) {
      e.preventDefault();
      stepsController.start();
    }).show();
  }
  else startTutorialButton.parent().remove();
  chardinstepsNextBtn.on('click', function(e) {
    e.preventDefault();
    stepsController.next();
  });
  chardinstepsPrevBtn.on('click', function(e) {
    e.preventDefault();
    stepsController.prev();
  });
}
JAVASCRIPT;
}