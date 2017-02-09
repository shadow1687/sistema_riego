<?php
  if(count($js_to_load)>0){
    foreach ($js_to_load as  $js) {
      echo	"<script src="{$js}"></script>"
    }
  }
 ?>
