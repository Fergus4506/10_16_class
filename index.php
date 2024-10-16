<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?><!DOCTYPE html>
<html>
  <head>
  <title>自我介紹</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

  	<div class="row">
  		<div class="col-md-12">

      <?php include('menu.php'); ?>
      <div class="jumbotron">
      <p>
      <?php include("get-index-meta-data.php"); ?>

      <hr />

      <?php include('get-cpu-load.php'); ?>
			</p>
      <p>
      </p>
    </div>
    </div>
    </div>
    </div>
    <div class="container">
        <header>
            <h1>我的自我介紹</h1>
        </header>

        <section class="introduction">
            <img src="myPh.jpg" alt="我的照片" class="profile-photo">
            <p>大家好，我是楊敦傑，一名充滿熱情的資工系學生。我很愛打電動和打牌，尤其是打牌，WS、PTCG、YGO、UA等等我都有。

                我喜愛挑戰自我，並樂於學習新事物，這讓我在工作中不斷進步，並且能夠靈活應對各種問題。

                我也喜歡與人交流，分享我的想法和經驗，並從他人的故事中學習更多。
                
                希望透過這個網站，讓你們更了解我，也期待有機會與你們進行更多的交流與合作！</p>
        </section>

        <section class="media">
            <div class="video-section">
                <h2>介紹影片</h2>
                <video controls>
                    <source src="myVideo.mp4" type="video/mp4">
                    您的瀏覽器不支援影片播放。
                </video>
            </div>

            <div class="audio-section">
                <h2>聲音介紹</h2>
                <audio controls>
                    <source src="myVoice.mp3" type="audio/mpeg">
                    您的瀏覽器不支援音頻播放。
                </audio>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 楊敦傑. All rights reserved.</p>
            <div class="contact-info">
                <h2>聯絡方式</h2>
                <ul>
                    <li>Email: fergus45065211@gmail.com</li>
                    <li>電話: 0921821136</li>
                </ul>
            </div>
        </footer>
    </div>
    <script src="script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

  </body>
</html>
