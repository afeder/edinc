<?php

abstract class MwTemplate {
    protected $pageTitle = "edinc";
    protected $useInlineStylesheet = false;

    abstract function execBodyContent();
    abstract function execPostScript();

    function execute() {
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?= $this->pageTitle ?></title>
<?php if ($this->useInlineStylesheet) { ?>
    <link rel="stylesheet" type="text/css" href="stylesheet/main.css">
<?php
      } else {
?>
    <style>
<?php
          readfile(__DIR__."/../stylesheet/main.css");
?>
    </style>
<?php
      }
?>
  </head>
  <body class="mediawiki ltr sitedir-ltr ns-12 ns-subject page-Help_Tool_Labs skin-vector action-view">
    <div id="content" class="mw-body">
      <h1 id="firstHeading" class="firstHeading" lang="en">edinc</h1>
      <div id="bodyContent" class="mw-body-content">
<?php $this->execBodyContent(); ?>
      </div>
    </div>
    <div id="mw-navigation">
      <h2>Navigation menu</h2>
      <div id="mw-head">
      </div>
      <div id="mw-panel">
        <div id="p-logo">
        </div>
        <div class="portal">
          <h3>Navigation</h3>
          <div class="body">
            <ul>
              <li><a href="" title="Visit the main page [alt-shift-z]" accesskey="z">Main page</a></li>
              <li><a href="" title="">Documentation</a></li>
            </ul>
          </div>
        </div>
<!--
        <div class="portal">
          <h3>Other tools</h3>
          <div class="body">
            <ul>
              <li>...</li>
            </ul>
          </div>
        </div>
-->
      </div>
    </div>
    <div id="footer">
      <ul id="footer-info">
        <li id="footer-info-lastmod">This page was generated on <?= date("j F Y")  ?>, at <?= date("H:i:s") ?>.</li>
        <li id="footer-info-copyright">Text is available under the <a href="https://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike License</a>.</li>
      </ul>
      <ul id="footer-places">
        <li id="footer-places-developers"><a href="">Developers</a></li>
      </ul>
      <ul id="footer-icons">
        <li id="footer-poweredbyico">
          <a href="http://tools.wmflabs.org/"><img src="https://tools-static.wmflabs.org/static/logos/powered-by-tool-labs.png" alt="Powered by Wikimedia Tool Labs" width="88" height="31"></a>
        </li>
      </ul>
      <div style="clear:both"></div>
    </div>
    <script>
      function prefetchResource(resource) {
        var request = new XMLHttpRequest();
        request.open("GET", resource);
        request.send(null);
      }
      prefetchResource("stylesheet/main.css");

<?php $this->execPostScript(); ?>
    </script>
  </body>
</html>
<?php
    }
}

?>
