<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" href="css/videoPlayerMain.css" type="text/css">
  <link rel="stylesheet" href="css/videoPlayer.theme1.css" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
  <script src="js/IScroll4Custom.js" type="text/javascript"></script>
  <script src='js/THREEx.FullScreen.js'></script>
  <script src="js/videoPlayer.js" type="text/javascript"></script>
  <script src="js/Playlist.js" type="text/javascript"></script>

  <script type="text/javascript" charset="utf-8">
  $(document).ready(function($)
  {
      videoPlayer = $("#video").Video({
          autoplay:false,
          autohideControls:4,
          videoPlayerWidth:1100,
          videoPlayerHeight:640,
          posterImg:"images/videoposetr.jpg",
          fullscreen_native:true,
          fullscreen_browser:false,
          restartOnFinish:false,
          spaceKeyActive:true,
          rightClickMenu:true,
		  hideVideoSource:false,						 
          share:[{
              show:false,
              facebookLink:"https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.player.pageflip.com.hr%2FplayerFB%2Findex.html",
              twitterLink:"https://twitter.com/intent/tweet?source=webclient&text=Responsive+HTML5+video+player+with+Advertising+by+zac+http%3A%2F%2Fwww.player.pageflip.com.hr%2FplayerFB%2Findex.html",
              youtubeLink:"http://www.youtube.com/watch?v=sAFt_cb-Z7I",
              pinterestLink:"http://pinterest.com/pin/create/bookmarklet/?media=http%3A%2F%2Fwww.player.pageflip.com.hr%2FimgFB%2F%2Fpreview.png&url=http%3A%2F%2Fwww.player.pageflip.com.hr%2FplayerFB%2F&description=ResponsiveHTML5VideoPlayerWithAdvertising",
              linkedinLink:"http://www.linkedin.com/cws/share?url=http%3A%2F%2Fwww.player.pageflip.com.hr%2FplayerFB%2F&original_referer=http%3A%2F%2Fwww.pageflip.com.hr%2FplayerFB%2F&token=&isFramed=true&lang=en_US&_ts=1378818194488.6047",
              googlePlusLink:"https://plus.google.com/share?url=http://www.player.pageflip.com.hr/playerFB/index.html",
              deliciousLink:"https://delicious.com/post?url=http://www.pageflip.com.hr/playerFB/&title=Responsive%20HTML5%20Video%20Player%20with%20Advertising%20by%20zac",
              mailLink:"mailto:codecanyon@codecanyon.net"
          }],
          logo:[{
              show:true,
              clickable:true,
              path:"http://interviewxp.com/images/logo.png",
              goToLink:"http://interviewxp.com/",
              position:"top-right"
          }],
          embed:[{
              show:false,
              embedCode:''
          }],
          videos:[{
                  id:0,
                  title:"Interviewxp",
                  mp4:"http://interviewxp.com/uploads/real_time_attachment/<?=$_GET['video'];?>",
                  info:"interviewxp",

               
              }]
      });
  });
</script>
</head>

<body>
  <div id="video"></div>
</body>

</html>