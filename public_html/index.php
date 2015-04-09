<html>
  <head>
    <title>edinc</title>
    <style>
<?php readfile(__DIR__."/stylesheet/main.css"); ?>
    </style>
  </head>
  <body>
    <div id="content" class="mw-body">
      <div id="bodyContent" class="mw-body-content">
        <form action="request.php" method="GET">
          <input type="text" name="target"/>
          <input type="submit">
        </form>
      </div>
    </div>
    <script>
      function prefetchResource(resource) {
        var request = new XMLHttpRequest();
        request.open("GET", resource);
        request.send(null);
      }
      prefetchResource("stylesheet/main.css");
    </script>
  </body>
</html>
