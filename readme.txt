

SPDX WordPress Specification Plugin

A wordpress plugin that would render the spec in a WordPress website as web pages. This would also need to handle the multiple versions.


== Description ==

The Linux Foundation is moving to a WordPress website, so we want to develop a WordPress plugin that would render the spec in a WordPress website as web pages.
This would also need to handle the multiple versions. A plugin of this sort will help to automatically update the website when new versions are released.
The plugin essentially will get markdown file URL like github raw content url, convert markdown to html, put it to custom post content and publish the content to a dedicated page on the WordPress website.

The plugin provides a simple solution for uploading the static HTML specifications web pages with a custom URL to the main SPDX WordPress website.


== Installation ==

1. Unzip the files and upload the plugin directory to `/wp-content/plugins/`
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Settings &rarr; SPDX Specs to begin. You must save the settings before proceeding to Tools &rarr; Import &rarr; HTML.


To-Do

1. Automate the import directly from GitHub
