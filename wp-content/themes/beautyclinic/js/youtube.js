      var tag = document.createElement('script');       tag.src = "https://www.youtube.com/iframe_api";       var firstScriptTag = document.getElementsByTagName('script')[0];       firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);       var player;       var _width = (window.innerWidth > 0) ? window.innerWidth : screen.width;       var _height = (window.innerHeight > 0) ? window.innerHeight : screen.height;       var index_play = -1;       var maxmodal;       var maxHeightvideo;       var h_list_video = 0;       var _e_list_video = document.getElementsByClassName('list-video')[0];          if(_e_list_video){         _e_h_list_video = _e_list_video.getBoundingClientRect();         h_list_video = _e_h_list_video.height;       }       console.log("h_list_video="+h_list_video.height);      if(_width > _height ) {        if( h_list_video > 0){           maxHeightvideo = h_list_video;         } else if (_width > 996 && _width <= 1366) {           maxHeightvideo = _height*0.9;           console.log(maxHeightvideo);         }else{          maxHeightvideo = _height*0.7;        }      } else{         maxHeightvideo = _width*0.7;                 maxmodal = _width*0.9;      }        var previousIndex = 0;       function onPlayerReady(event) {         index_play = 0;       }             var done = false;       function onPlayerStateChange(event) {         if (event.data == YT.PlayerState.PLAYING && !done) {           setTimeout(stopVideo, 1000);           done = true;         }         if(event.data == -1 || event.data == 0) {                     var index = player.getPlaylistIndex();                     var le = player.getPlaylist().length-1;                     if(player.getPlaylist().length != playlist.length) {                         player.loadPlaylist(playlist, previousIndex+1);                     }                                         previousIndex = index;                 }     }       function stopVideo() {         player.stopVideo();       }     function play_index(index) {         player.playVideoAt(index);            }  function scrollplay(){         if(index_play < 0 ){             return false;         }            var element = document.getElementById("player");            var rect = element.getBoundingClientRect();         var height = window.innerHeight;          if(rect.top > 0 && rect.bottom < height){              play_index(index_play);         }else{             stopVideo();         } } $(document).ready(function() {     $(".video-bg").find("a.btn-video").click(function(event){       event.preventDefault();       var href = $(this).attr('href');       index_play = href.substring(1, 2);       play_index(index_play);   }); $(".video-bg").find("a.link-video").click(function(event){       event.preventDefault();       var href = $(this).attr('href');       index_play = href.substring(1, 2);            play_index(index_play);   });   });       