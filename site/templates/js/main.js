/**
 * Created by 23rd and Walnut
 * www.23andwalnut.com
 * User: Saleem El-Amin
 * Date: Aug 23, 2010
 * Time: 5:33:36 AM
 */
$(document).ready(function()
{

    var playItem = 0, clearAudio = false;



    var MusicBox = function(callback)
    {
        if (myPlayList.length > 0)
        {
            $.post('../../explorer.php', {'dispatch':'get_meta', 'data':myPlayList}, function(data)
            {
                myPlayList = $.parseJSON(data);

                $("#jquery_jplayer").jPlayer({
                    ready: function()
                    {
                        displayPlayList();
                        playListInit(false); // Parameter is a boolean for autoplay.
                    },
                    oggSupport: true,
                    swfPath: 'jPlayer/js',
                    volume:50,
                    errorAlerts:true,
                    warningAlerts:true
                }).jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime)
                {
                    jpPlayTime.text($.jPlayer.convertTime(playedTime));
                    jpTotalTime.text($.jPlayer.convertTime(totalTime));
                }).jPlayer("onSoundComplete", function()
                {
                    playListNext();
                });

                if (typeof(callback) == 'function')
                    callback();
                //$('a img[title]').tooltip();

            });
        }
        else alert('There are no items in this playlist');
    }





    function setPlaylist()
    {
        if (musicBoxClass != 'favorites')
        {
            myPlayList = playListItems;
        }
        else setFavoritesAsPlaylist();
    }


     function addFavorite(song)
    {
        var favorites = localStorage.getObject('musicBoxFavs');
        favorites = (favorites != null) ? favorites : [];

        var exists = false;

        $.each(favorites, function(key, value)
        {
            if (value == song)
                exists = true;
        });

        if (!exists)
            favorites.push(song);

        localStorage.setObject('musicBoxFavs', favorites);
    }





    function removeFavorite(song)
    {
        var favorites = localStorage.getObject('musicBoxFavs');
        favorites = (favorites != null) ? favorites : [];

        $.each(favorites, function(key, value)
        {
            if (value == song)
                favorites.splice(key, 1);
        });

        setFavoritesAsPlaylist();
        setPlaylist();

        localStorage.setObject('musicBoxFavs', favorites);
    }





    function setFavoritesAsPlaylist()
    {
        var favorites = localStorage.getObject('musicBoxFavs');
        favorites = (favorites != null) ? favorites : false;

        if (favorites)
        {
            myPlayList = [];
            $.each(favorites, function(key, value)
            {
                var ogg = (value.substr(0, value.length - 3)) + 'ogg';
                myPlayList.push({'mp3':value, 'ogg':ogg});
            });
        }

    }





    /**HTML5 Checks **/
    function localStorageSupport()
    {
        return ('localStorage' in window) && window['localStorage'] !== null;
    }



    function displayPlayList()
    {
        var playlistClass = $('#main').attr('class');
        $("#jplayer_playlist ol").empty();

        for (i = 0; i < myPlayList.length; i++)
        {

            var listItem = (i == myPlayList.length - 1) ? "<li id='" + myPlayList[i].mp3 + "' class='jplayer_playlist_item_last'>" : "<li id='" + myPlayList[i].mp3 + "'>";
            var src = '../../cover.php?filename=' + myPlayList[i].mp3;

            if(playlistClass!= 'favorites'){
                if(playlistClass != 'thumb-wall')
                    var fav = '<a  title="Add to favorites" class="favorite show-tooltip" href="#" >&hearts;</a>';
                else var fav = '<a  title="Add to favorites" class="favorite" href="#" >&hearts;</a>';
            }
            else var fav = '';
            //var fav = (playlistClass != 'favorites') ? ('<a  title="Add to favorites" class="favorite" href="#" >&hearts;</a>') : '';
            var removeFav = (playlistClass == 'favorites') ? '<span class="remove-favorite">x</span>' : '';

            if (playlistClass != 'thumb-wall')
            {
                listItem += "<a href='#' id='jplayer_playlist_item_" + i + "' tabindex='1'>" + myPlayList[i].name + "</a> - " + myPlayList[i].artist + removeFav + fav + "<span class='track-length'>" + myPlayList[i].play_length + "</span></li>";
            }
            else
            {
                var thumb_image = '';


                if (myPlayList[i].cover == 1)
                {
                    thumb_image = ('<img id="thumb-image-' + i + '" class="thumb-image" src="' + src + '" title="'+myPlayList[i].name+'<br/>'+myPlayList[i].artist+'"/>');
                }

                listItem += "<a href='#' id='jplayer_playlist_item_" + i + "' tabindex='1'><span class='thumb-wall-inner'>" + myPlayList[i].name + "<span class='artist'>" + myPlayList[i].artist + "</span>" + thumb_image + "<span class='thumb-title'><strong>"+myPlayList[i].name+"</strong><br/>"+myPlayList[i].artist+"</span></span></a>" + fav + "</li>";
            }

            $("#jplayer_playlist ol").append(listItem);

            $("#jplayer_playlist_item_" + i).data("index", i).click(function()
            {
                var index = $(this).data("index");
                if (playItem != index)
                {
                    playListChange(index);
                } else
                {
                    $("#jquery_jplayer").jPlayer("play");
                }
                $(this).blur();
                return false;
            });
        }
        preloadImages();

        $('.thumb-wall-inner').hover(function(){
           var title = $(this).find('.thumb-title');
           title.css('top',((230-title.height())/2)).show();
        }, function(){
            $(this).find('.thumb-title').hide();
        });

        $('.show-tooltip[title]').tooltip({
            position:'center right',
            offset:[0,18]
        });
    }



     /** Playlist Stuff **/
    function playListInit(autoplay)
    {
        if (autoplay)
        {
            playListChange(playItem);
        } else
        {
            playListConfig(playItem);
        }
        preloadImages();
        $('.jplayer_playlist_current .thumb-title').css('top',((230-$('.jplayer_playlist_current .thumb-title').height())/2)+'px');

    }





    function playListConfig(index)
    {
        $("#jplayer_playlist_item_" + playItem).removeClass("jplayer_playlist_current").parent().removeClass("jplayer_playlist_current");
        $("#jplayer_playlist_item_" + index).addClass("jplayer_playlist_current").parent().addClass("jplayer_playlist_current");
        playItem = index;
        $("#jquery_jplayer").jPlayer("setFile", myPlayList[playItem].mp3, myPlayList[playItem].ogg);

        $('.info-thumb img').addClass('old-image');
        if (myPlayList[playItem].cover == 1)
        {
            $('.info-thumb').append('<img class="thumb-image" src="../../cover.php?filename=' + myPlayList[playItem].mp3 + '"/>');
            $('.info-thumb img.old-image').remove();
        }
    }





    function playListChange(index)
    {
        playListConfig(index);
        $("#jquery_jplayer").jPlayer("play");
        preloadImages();

        $('.jplayer_playlist_current .thumb-title').css('top',((230-$('.jplayer_playlist_current .thumb-title').height())/2)+'px');
    }





    function playListNext()
    {
        var index = (playItem + 1 < myPlayList.length) ? playItem + 1 : 0;
        playListChange(index);
    }





    function playListPrev()
    {
        var index = (playItem - 1 >= 0) ? playItem - 1 : myPlayList.length - 1;
        playListChange(index);
    }





    function preloadImages()
    {
        $('img.thumb-image').load(function()
        {
            $(this).fadeIn('slow');
            return false; // cancel event bubble
        }).each(function()
        {
            if ($(this).get(0) != undefined)
            {
                if ($(this).get(0).complete && $(this).get(0).naturalWidth !== 0)
                {
                    $(this).trigger('load');
                }
            }
        });
    }

    /** Local Storage **/
    if (localStorageSupport())
    {
        Storage.prototype.setObject = function(key, value)
        {
            this.setItem(key, JSON.stringify(value));
        }

        Storage.prototype.getObject = function(key)
        {
            return this.getItem(key) && JSON.parse(this.getItem(key));
        }
    }



    $('#menu a').live('click', function()
    {
        var href = $(this).attr('href');
        var main = $('#main');
        var linkClass = $(this).attr('class');

        if(linkClass == 'fav-link')
        {
            $('#jquery_jplayer').jPlayer( "clearFile" );
        }


        $('.tmp').load(href+' .content', function(){
            $('.content').html($('.tmp .content').html());

            musicBoxClass = $('#main').attr('class');
            setPlaylist();

            MusicBox(function()
            {
                displayPlayList();

                if(linkClass != 'fav-link')
                    $("#jplayer_playlist_item_" + playItem).addClass("jplayer_playlist_current").parent().addClass("jplayer_playlist_current");

                $('.info-thumb img').remove();
                if (myPlayList[playItem].cover == 1)
                {
                    $('.info-thumb').append('<img class="thumb-image" src="../../cover.php?filename=' + myPlayList[playItem].mp3 + '"/>');
                }
                preloadImages();
            });

        });

        return false;
    });

    $('.fav-link').click(function(){
        $('#menu a.continue').removeClass('continue');
    });


    /** MusicBox Favorites **/
    $('.favorite').live('click', function()
    {
        if (localStorageSupport())
            addFavorite($(this).parent('li').attr('id'));
    });

    $('.remove-favorite').live('click', function()
    {
        if (localStorageSupport())
        {
            removeFavorite($(this).parent('li').attr('id'));
            $(this).parent('li').remove();
        }

    });





    /** Playlist Stuff **/

    var jpPlayTime = $("#jplayer_play_time");
    var jpTotalTime = $("#jplayer_total_time");


    $("#jplayer_previous").click(function()
    {
        playListPrev();
        $(this).blur();
        return false;
    });

    $("#jplayer_next").click(function()
    {
        playListNext();
        $(this).blur();
        return false;
    });







    var myPlayList;

    setPlaylist();
    MusicBox();

});

(function(f){function p(a,b,c){var h=c.relative?a.position().top:a.offset().top,e=c.relative?a.position().left:a.offset().left,i=c.position[0];h-=b.outerHeight()-c.offset[0];e+=a.outerWidth()+c.offset[1];var j=b.outerHeight()+a.outerHeight();if(i=="center")h+=j/2;if(i=="bottom")h+=j;i=c.position[1];a=b.outerWidth()+a.outerWidth();if(i=="center")e-=a/2;if(i=="left")e-=a;return{top:h,left:e}}function u(a,b){var c=this,h=a.add(c),e,i=0,j=0,m=a.attr("title"),q=a.attr("data-tooltip"),r=n[b.effect],l,s=
a.is(":input"),v=s&&a.is(":checkbox, :radio, select, :button, :submit"),t=a.attr("type"),k=b.events[t]||b.events[s?v?"widget":"input":"def"];if(!r)throw'Nonexistent effect "'+b.effect+'"';k=k.split(/,\s*/);if(k.length!=2)throw"Tooltip: bad events configuration for "+t;a.bind(k[0],function(d){clearTimeout(i);if(b.predelay)j=setTimeout(function(){c.show(d)},b.predelay);else c.show(d)}).bind(k[1],function(d){clearTimeout(j);if(b.delay)i=setTimeout(function(){c.hide(d)},b.delay);else c.hide(d)});if(m&&
b.cancelDefault){a.removeAttr("title");a.data("title",m)}f.extend(c,{show:function(d){if(!e){if(q)e=f(q);else if(m)e=f(b.layout).addClass(b.tipClass).appendTo(document.body).hide().append(m);else if(b.tip)e=f(b.tip).eq(0);else{e=a.next();e.length||(e=a.parent().next())}if(!e.length)throw"Cannot find tooltip for "+a;}if(c.isShown())return c;e.stop(true,true);var g=p(a,e,b);d=d||f.Event();d.type="onBeforeShow";h.trigger(d,[g]);if(d.isDefaultPrevented())return c;g=p(a,e,b);e.css({position:"absolute",
top:g.top,left:g.left});l=true;r[0].call(c,function(){d.type="onShow";l="full";h.trigger(d)});g=b.events.tooltip.split(/,\s*/);e.bind(g[0],function(){clearTimeout(i);clearTimeout(j)});g[1]&&!a.is("input:not(:checkbox, :radio), textarea")&&e.bind(g[1],function(o){o.relatedTarget!=a[0]&&a.trigger(k[1].split(" ")[0])});return c},hide:function(d){if(!e||!c.isShown())return c;d=d||f.Event();d.type="onBeforeHide";h.trigger(d);if(!d.isDefaultPrevented()){l=false;n[b.effect][1].call(c,function(){d.type="onHide";
h.trigger(d)});return c}},isShown:function(d){return d?l=="full":l},getConf:function(){return b},getTip:function(){return e},getTrigger:function(){return a}});f.each("onHide,onBeforeShow,onShow,onBeforeHide".split(","),function(d,g){f.isFunction(b[g])&&f(c).bind(g,b[g]);c[g]=function(o){f(c).bind(g,o);return c}})}f.tools=f.tools||{version:"1.2.4"};f.tools.tooltip={conf:{effect:"toggle",fadeOutSpeed:"fast",predelay:0,delay:30,opacity:1,tip:0,position:["top","center"],offset:[0,0],relative:false,cancelDefault:true,
events:{def:"mouseenter,mouseleave",input:"focus,blur",widget:"focus mouseenter,blur mouseleave",tooltip:"mouseenter,mouseleave"},layout:"<div/>",tipClass:"tooltip"},addEffect:function(a,b,c){n[a]=[b,c]}};var n={toggle:[function(a){var b=this.getConf(),c=this.getTip();b=b.opacity;b<1&&c.css({opacity:b});c.show();a.call()},function(a){this.getTip().hide();a.call()}],fade:[function(a){var b=this.getConf();this.getTip().fadeTo(b.fadeInSpeed,b.opacity,a)},function(a){this.getTip().fadeOut(this.getConf().fadeOutSpeed,
a)}]};f.fn.tooltip=function(a){var b=this.data("tooltip");if(b)return b;a=f.extend(true,{},f.tools.tooltip.conf,a);if(typeof a.position=="string")a.position=a.position.split(/,?\s/);this.each(function(){b=new u(f(this),a);f(this).data("tooltip",b)});return a.api?b:this}})(jQuery);
