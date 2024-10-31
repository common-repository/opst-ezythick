<?php
/*
Plugin Name: OpSt ezyThick
Author: Steen Andersen
Author URI: http://steen-andersen.org/plugin-opst-ezythick/
Text Domain: opst-ezythick
Version: 1.2
Description: Shortcode interface to the built in Thickbox module. Simplifies the use of Thickbox when creating popups with inline content.

*/

/**
 *  OpSt ezyThick
 *  @author Steen Andersen   <info@steen-andersen.org>
 *  @copyright OpenStone.Dk 2014
 *  @license GPL 2.0
 */

/**
 *  set some defaults for the thickbox:
 *  @global array $defaults
 */
$defaults = array(
  "link" => "Some text for the link to clik",
  "title" => "The default title",
  "show" => "none",
  "modal" => "false",
  "exitbutton" => "Exit",
  "width" => "500",
  "height" => "600",
  "inlineid" => "ezyTB",
  "type" => "inline",
  "src" => "",
);

/**
 *  When the show attrib is present with one of
 *  these values the content will be hidden
 *  @global array $noshows
 */
$noshows = array("no","none","false","0");

// Load the translations (if present)
add_action("plugins_loaded","ezyThick_load_plugin_textdomain");

// Add the shortcode(s):
add_shortcode("ezythickbox","embed_thickbox");
add_shortcode("ezythick","embed_thickbox");

/**
 *  Handle the shortcode
 *
 *  @param array $atts  Attributes from the shortcode
 *  @param string $content The content between the start and end shortcodes
 *  @return string The html containing a link and a div with the content that
 *                 the thickbox displays
 */
function embed_thickbox( $atts, $content = null ) {
  global $defaults, $noshows;

  // Error if no link text present
  if (!isset($atts['link']) ) {
    return __("You must enter a link name to display on your page!","opst-ezythick");
  }

  // Load the thickbox javascript, if not done already
  ezyThick_enqueues();

  // Extract the attributes
  $a = shortcode_atts($defaults, $atts);

  // Show text if show-attrib is present and NOT in the noshow-array
  if ( !in_array(strtolower($a['show']), $noshows  )) {
    $a['show'] = "block";
  } else {
    $a['show'] = "none";
  }

  // Make the box modal (or not!)
  if ( !in_array($a['modal'], $noshows  )) {
    $a['modal'] = "true";
    $a['remove'] = "tb_remove();";
  } else {
    $a['modal'] = "false";
    $a['remove'] = "void();";
  }

  // Make sure content is wrapped in html-tags
  //  or is zero-length string
  if ($content !== null) {
    $content = ezyThick_VrfyContent($content);
  } else {
    $content = "";
  }
  // Add default value for type, if not present
  if (!isset($a['type'])) {
    $a['type'] = 'inline';
  }

  // show the link, and add the content to the page/post
  return ezyThick_Div($a, $content);

}
/**
 *  Display both the link and the content (hidden by default)
 *  for the thickbox
 *  @param array $a The attributes from the shortcode and the added values
 *                    used to define the link, add buttons etc.
 *
 *  @param string $content The content between the shortcodes
 *  @return string The html for the link and the content in the thickbox
 */
function ezyThick_Div($a, $content) {

// Create the link
  $tpl = ezyThick_Href($a);

// Add "close"-button to content in modal mode only
  $content .= ezyThick_ExitButton($a);

// Add the content
  $tpl .= "<div style='display:".$a['show'].";' id='".
          $a['inlineid']."' >".$content."</div>";

  return $tpl;
}
/**
 *  Create a link to open the popup window
 *  @param array $a  The attributes from the shortcode and the added values
 *                    used to define the link, add buttons etc.
 */
function ezyThick_Href($a) {
  $tpl = "<a class='thickbox' href='".$a['src']."#TB_".$a['type']."?inlineId=".$a['inlineid'].
          "&width=".$a['width']."&height=".$a['height'].
          /* "&title=".$a['title']. */
          "&modal=".$a['modal']."' ".
          "title='".$a['title']."' >".
          $a['link'].
          "</a>";
  return $tpl;
}
/**
 *  Add a "close"-button that calls the thickbox TB_remove when clicked
 *
 *  @param array $a The attributes from the shortcode
 *  @return string A button <input type="button" ... />
 */
function ezyThick_ExitButton($a) {
  if ($a['modal'] == "true") {
    return "<input type='button' onclick='".$a['remove']."' value='".
            $a['exitbutton']."' />";
  } else {
    return "";
  }
}
/**
 *  Check that the content is wrapped in an html tag.
 *  Add <p> ... </p> if no tags are present.
 *  Reason: thickbox fails to display the content if not wrapped in html-tags
 *  (may be a bug in thickbox)
 *
 *  @param string $content The content between the shortcodes
 *  @return string  The content wrapped in html tags.
 *  @since 1.0.2
 */
function ezyThick_VrfyContent($content) {
  $c = substr_compare(trim($content), "<br", 0, true);
  if ( $c == 0 ) {
    return "<p>" . $content . "</p>";
  } else {
    return $content;
  }
}
/* ******* Wordpress related function ************************ */
function ezyThick_enqueues() {
  wp_enqueue_script("thickbox");
  wp_enqueue_style("thickbox");
}
function ezyThick_load_plugin_textdomain() {
  $langDir = basename(dirname(__FILE__)) . "/langs/";
  load_plugin_textdomain( "opst-ezythick", false, $langDir );
}
?>