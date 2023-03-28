<?php
if(isset($_POST['download'])){
    $video = $_FILES['video'];
    $video_name = $video['name'];
    $video_tmp_name = $video['tmp_name'];
    $video_size = $video['size'];

    // Verifica che il file inviato sia un video
    $allowed_extensions = array('mp4', 'avi', 'mov');
    $video_extension = pathinfo($video_name, PATHINFO_EXTENSION);
    if(!in_array($video_extension, $allowed_extensions)){
        echo "Sono consentiti solo file MP4, AVI o MOV.";
        exit();
    }

    // Crea un nome univoco per il file MP3
    $mp3_name = uniqid('', true) . '.mp3';

    // Esegue la conversione del video in formato MP3 utilizzando ffmpeg
    exec("ffmpeg -i $video_tmp_name $mp3_name");

    // Invia il file MP3 al browser per il download
    header("Content-Type: audio/mpeg");
    header("Content-Disposition: attachment; filename=$mp3_name");
    header("Content-Length: " . filesize($mp3_name));
    readfile($mp3_name);

    // Elimina il file MP3 dal server
    unlink($mp3_name);
}
?>
