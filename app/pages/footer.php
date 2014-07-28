  </div>  

<div class="footer"></div>

<script src="//www.youtube.com/player_api"></script>
<script>
var player;
var playButton = document.getElementById("play-button");
var pauseButton = document.getElementById("pause-button");

function showPlay(){
  playButton.setAttribute("class",playButton.getAttribute("class").replace(/hide/g,""));
  if ( !(" " + pauseButton.className + " ").replace(/[\n\t]/g, " ").indexOf("hide") > -1 ) {
    pauseButton.setAttribute("class",pauseButton.getAttribute("class")+" hide");
  }

}
function showPause(){
  pauseButton.setAttribute("class",pauseButton.getAttribute("class").replace(/hide/g,""));
  if ( !(" " + playButton.className + " ").replace(/[\n\t]/g, " ").indexOf("hide63") > -1 ) {
    playButton.setAttribute("class",playButton.getAttribute("class")+" hide");
  }
}

function loadVideo(id){
  showPause();
  play_link = document.getElementById(id);
  $url = play_link.getAttribute("href");
  console.log("Loading from youtube "+ $url);
  player.loadVideoByUrl( $url );
}

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('video', {
    events: { 
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  console.log("player loaded");
  playButton.addEventListener("click", function() {
    showPause();
    player.playVideo();
  });
  pauseButton.addEventListener("click", function() {
    showPlay();
    player.pauseVideo();
  });
  
}

// analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1301980-42', 'auto');
  ga('send', 'pageview');


</script>

<div>

</div>  
  </body>
</html>
