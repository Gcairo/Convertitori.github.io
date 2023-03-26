<?php
if(isset($_POST["download"])){
  $videoName = uniqid() . ".mp3";
  move_uploaded_file($_FILES["video"]["tmp_name"], "video/$videoName");
  
  echo
  "
  <script> window.location.href = 'dl.php?fl=$videoName'; </script
  "
}
?>
