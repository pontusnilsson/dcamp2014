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
      $item_class = 'Navigation-item Navigation-item--' . strtolower(drupal_clean_css_identifier($item['link_title']));
      // $alias = drupal_get_path_alias($item['link_path']);

      $alias = strtolower(drupal_clean_css_identifier($item['link_title']));
      $link = array('link' => l($item['link_title'], '', array('fragment' => $alias, 'attributes' => array('data-scroll' => '', 'data-speed' => "500", 'data-easing' => 'easeInOutCubic'))), 'classes' => $item_class);
      $link['link'] = str_replace('href="/#', 'href="#', $link['link']);
      $top_menu[] = $link;
      $ctools_menu_options['#' . $alias] = $item['link_title'];
    }
  }
  $vars['top_menu'] = $top_menu;

  // $form = ctools_jump_menu(array(), $form_state, $ctools_menu_options, array('choose' => t('- Menu -')));
  // $vars['jump_menu'] = drupal_render($form);

  foreach ($vars['menu'] as $item) {
    if ($item['router_path'] == 'node/%' && $item['plid'] == 0) {
      $alias = drupal_get_path_alias($item['link_path']);
      $node = menu_get_object('node', 1, $item['link_path']);
      $field_classes = field_get_items('node', $node, 'field_class');
      $css_classes = array('Section', 'Section--' . strtolower(drupal_clean_css_identifier($item['link_title'])));
      $markup = drupal_render(node_view($node));
      $sections[] = array('markup' => $markup, 'class' => implode(' ', $css_classes), 'id' => strtolower(drupal_clean_css_identifier($item['link_title'])));
    }
  }
  $vars['sections'] = $sections;

  $vars['logo'] = theme_get_setting('logo');
  $path = drupal_get_path('theme', 'dcamp');
}

function dcamp_js_alter(&$js) {
  $js['misc/jquery.js']['version'] = "1.9.1";
  $js['misc/jquery.js']['data'] = 'sites/all/themes/dcamp/js/jquery-1.9.1.min.js';
}

// Remove Query Strings from CSS filenames (CacheBuster)
function dcamp_process_html(&$variables) {
  $variables['styles'] = preg_replace('/\.css\?.*"/','.css"', $variables['styles']);
}
