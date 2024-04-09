<?php
  function checkEventName($event_name){
    if (strpos($event_name, ' ') !== false) {
        $event_name = str_replace(' ', '%20', $event_name);
    }
    return $event_name;
}
