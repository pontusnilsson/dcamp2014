<?php

/**
 * Preprocess onepage render page.
 */
function dcamp_preprocess_onepage(&$vars) {
  $top_menu = array();
  $sections = array();
  $ctools_menu_options = array();
  foreach ($vars['menu'] as $item) {
    if ($item['router_path'] == 'node/%' && $item['plid'] == 0) {
      $alias = drupal_get_path_alias($item['link_path']);
      $top_menu[] = array('link' => l($item['link_title'], '', array('fragment' => $alias)), 'classes' => $alias);
      $ctools_menu_options['#' . $alias] = $item['link_title'];
    }
  }
  $vars['top_menu'] = $top_menu;  

  $form = ctools_jump_menu(array(), $form_state, $ctools_menu_options, array('choose' => t('- Menu -')));
  $vars['jump_menu'] = drupal_render($form);

  foreach ($vars['menu'] as $item) {
    if ($item['router_path'] == 'node/%' && $item['plid'] == 0) {
      $alias = drupal_get_path_alias($item['link_path']);
      $node = menu_get_object('node', 1, $item['link_path']);
      $field_classes = field_get_items('node', $node, 'field_class');
      $css_classes = array('section-row');
      if (is_array($field_classes)) {
        foreach ($field_classes as $css_class) {
          $css_classes[] = $css_class['value'];
        }
      }
      $markup = drupal_render(node_view($node));
      $sections[] = array('markup' => $markup, 'id' => $alias, 'class' => implode(' ', $css_classes));
    }
  }
  $vars['sections'] = $sections;

  $vars['logo'] = theme_get_setting('logo');
  $path = drupal_get_path('theme', 'dcamp');
}
