<?php
$streamURL = "rtsp://192.168.1.100:554/video.mjpg"; // Replace with your camera's IP address and stream URL;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Display Video on Button Click</title>
</head>
<body>
  <video id='myvideo' width="320" height="240" autoplay src="<?php echo $streamURL ?>" type="video/x-mjpeg" controls></video>

  <!--<script>
    // Get video URL from PHP variable
    var videoUrl = '<?php echo $video; ?>';

    document.getElementById('playButton').addEventListener('click', function() {
      document.getElementById('myVideo').src = videoUrl;
      document.getElementById('myVideo').play();
    });
  </script>-->
</body>
</html>