=== OpSt ezyThick ===
Contributors: dpste
Author: Steen Andersen
Author URI: http://www.steen-andersen.org/plugin-opst-ezythick/
Donate link: http://www.steen-andersen.org/plugin-opst-ezythick/
Tags: Popup, UI, Thickbox, Wrapper, Shortcode, Modal, Inline
Stable tag: 1.1
Requires at least: 3.0.1
Tested up to: 4.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcode interface to the built in Thickbox module. Simplifies the use of Thickbox when creating popups with inline content.

== Description ==
An easy(easier)-to-remember shortcode wrapper for Thickbox' inline funcion. Uses the build-in Thickbox module.

A tool for those of us, who does not use the thickbox on a regular basis, and are having trouble remembering the syntax.

No need to worry about inclusion of libraries, construction of hrefs and hiding divs. Library and css only loaded when needed.

Just wrap your text/images/other shortcode in the [ezythick link="Sometext" ]...[/ezythick] shortcode, (don't forget the link attribute), and you're done.

**Limitations**


* Only support for TB_inline and TB_iframe. Ie. no galleries or ajax content. Yet.

== Installation ==
1. Upload and unpack the `opst-ezythick.zip` to the `/wp-content/plugins/` directory or simply upload the zip file within your wordpress installation.

1. Activate the plugin through the 'Plugins' menu in WordPress

1. Thats it. You're ready to use the shortcode in your posts and pages

== Frequently Asked Questions ==

= What are the minimum shortcode? =
You must provide text for the link - and some content to display in the box, eg:
[ezythick link="Fill in the form"] ... Your form here ... [/ezythick]

= What attributes are available =

You can use the following attributes:

* **link**: The link text displayed on the page.
* **inlineId**: A unique id for the box. Use if you need more than one thickbox on a page.
* **title**: The text for titlebar
* **show**: Set to true if you want to display the enclosed text directly on the page/post.
* **width**: The box width in pixels.
* **height**: The box height in pixels.
* **modal**: Only close box by clicking on exit button. Set to "true" if you need a modal box.
* **exitbutton**:  Text on the exit button, default: "Exit".
* **type**: One of 'inline' or 'iframe'. Default is inline.
* **src**: URL pointing to the iframe content.

= Multiple links to the same content =
You do not need to copy content. Instead you can link to the content of another shortcode.
All you need is to add the link text and the inlineid as attributes.

You will however have to copy all attributes from the original link.

Example:
[ezythick link="Fill in the form" indlineid="popup1"], displays an ordinary box with inline content.

Iframes: Since the "content" is a url contained in the link itself, it is not possible to just refer to
the "content" of another shortcode. But who knows - one day I may write a routine to keep track of things,
so this will be possible.

== Screenshots ==
1. An simple example of the use of the shortcode.

2. An example of an inline popup with all attributes set.

== Changelog ==
= 1.0 =
First release
= 1.0.1 =
Changes to readme.txt
= 1.0.2 =
* Add <p>..</p> to content. Content should start with an html tag other than <br /> og newline, otherwise
                            it is ignored by thickbox. (bug or feature in thickbox?).
* Rearranged sourcecode and added more comments.
= 1.1 =
Added support for iFrames
= 1.2 =
Added support for multiple links to open same popup box
== Upgrade Notice ==
Nothing particular
