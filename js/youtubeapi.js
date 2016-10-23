var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
var player;
var videoDuration;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}
    

function onPlayerReady(event) {
    event.target.playVideo();
    videoDuration = player.getDuration();
}
    
var done = false;



function onPlayerStateChange(event) {
    setInterval(function(){

        if (event.data == YT.PlayerState.PLAYING) 
        {
            if (nextAction != undefined)
            {
                if (player.getCurrentTime() >= nextAction.action_time)
                {
                    $('.overlay').fadeIn('slow');
                    player.pauseVideo();
                    
                }
            }
            
        }
            
    }, 1000);

}
    
