/**
 * @file
 * Google Custom Search Engine fetch results.
 *
 * @ignore
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  function gcseCallback() {
    if (document.readyState !== 'complete') {
      return google.setOnLoadCallback(gcseCallback, true);
    }
    google.search.cse.element.render({
      gname: 'gsearch',
      div: 'gcs-results',
      tag: 'search',
      attributes: {
        linkTarget: ''
      }
    });
    var element = google.search.cse.element.getElement('gsearch');
    element.execute(drupalSettings.gcsSettings.gcsKey);
  }

  if (drupalSettings.gcsSettings.hasOwnProperty('gcsCX') && drupalSettings.gcsSettings.gcsCX != null) {
    if (drupalSettings.gcsSettings.hasOwnProperty('gcsKey') && drupalSettings.gcsSettings.gcsKey != null) {
      window.__gcse = {
        parsetags: 'explicit',
        callback: gcseCallback
      };
    }
    var cx = drupalSettings.gcsSettings.gcsCX;
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  }
})(jQuery, Drupal, drupalSettings);
