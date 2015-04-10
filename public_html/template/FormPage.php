<?php
require_once(__DIR__."/MwTemplate.php");
require_once(__DIR__."/../../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../../backend/Editor/Username.php");

class FormPage extends MwTemplate {
    function execBodyContent() {
?>
          <form action="request.php" method="GET">
            Userpage:<br/>
            <input type="text" name="userpage"/><br/>
            <p><i>or</i></p>
            Site:<br/>
            <input type="text" name="site"/><br/>
            Username:<br/>
            <input type="text" name="username"/><br/>
            <p/>
            <input type="submit">
          </form>
<?php
    }

    function execPostScript() {
?>
      function prefetchResource(resource) {
        var request = new XMLHttpRequest();
        request.open("GET", resource);
        request.send(null);
      }
      prefetchResource("stylesheet/main.css");
<?php
    }
}
?>
