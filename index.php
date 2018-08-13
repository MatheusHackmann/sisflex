<?php
require_once("header.php");

if (!isset($_GET['p'])) {
  require_once("novo_alimento.php");
}
elseif (file_exists($_GET['p'] . ".php")) {
  require_once($_GET['p'] . ".php");
}
else {
  echo "
  <div class=\"container-fluid\">
  <div class=\"row\">
  <div class=\"col-12\">

  <h3 class=\"text-center\"><i>PÁGINA INEXISTENTE</i></h3>

  </div>
  </div>
  </div>  
  ";
}

require_once("footer.php"); ?>