/*
 * jQuery spritely 0.6.7
 * http://spritely.net/
 *
 * Documentation:
 * http://spritely.net/documentation/
 *
 * Copyright 2010-2011, Peter Chater, Artlogic Media Ltd, http://www.artlogic.net/
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 */
(function(e){e._spritely={instances:{},animate:function(t){var n=e(t.el);var r=n.attr("id");if(!e._spritely.instances[r]){return this}t=e.extend(t,e._spritely.instances[r]||{});if(t.type=="sprite"&&t.fps){if(t.play_frames&&!e._spritely.instances[r]["remaining_frames"]){e._spritely.instances[r]["remaining_frames"]=t.play_frames+1}else if(t.do_once&&!e._spritely.instances[r]["remaining_frames"]){e._spritely.instances[r]["remaining_frames"]=t.no_of_frames}var i;var s=function(n){var s=t.width,o=t.height;if(!i){i=[];total=0;for(var u=0;u<t.no_of_frames;u++){i[i.length]=0-total;total+=s}}if(e._spritely.instances[r]["current_frame"]==0){if(t.on_first_frame){t.on_first_frame(n)}}else if(e._spritely.instances[r]["current_frame"]==i.length-1){if(t.on_last_frame){t.on_last_frame(n)}}if(t.on_frame&&t.on_frame[e._spritely.instances[r]["current_frame"]]){t.on_frame[e._spritely.instances[r]["current_frame"]](n)}if(t.rewind==true){if(e._spritely.instances[r]["current_frame"]<=0){e._spritely.instances[r]["current_frame"]=i.length-1}else{e._spritely.instances[r]["current_frame"]=e._spritely.instances[r]["current_frame"]-1}}else{if(e._spritely.instances[r]["current_frame"]>=i.length-1){e._spritely.instances[r]["current_frame"]=0}else{e._spritely.instances[r]["current_frame"]=e._spritely.instances[r]["current_frame"]+1}}var a=e._spritely.getBgY(n);n.css("background-position",i[e._spritely.instances[r]["current_frame"]]+"px "+a);if(t.bounce&&t.bounce[0]>0&&t.bounce[1]>0){var f=t.bounce[0];var l=t.bounce[1];var c=t.bounce[2];n.animate({top:"+="+f+"px",left:"-="+l+"px"},c).animate({top:"-="+f+"px",left:"+="+l+"px"},c)}};if(e._spritely.instances[r]["remaining_frames"]&&e._spritely.instances[r]["remaining_frames"]>0){e._spritely.instances[r]["remaining_frames"]--;if(e._spritely.instances[r]["remaining_frames"]==0){e._spritely.instances[r]["remaining_frames"]=-1;delete e._spritely.instances[r]["remaining_frames"];return this}else{s(n)}}else if(e._spritely.instances[r]["remaining_frames"]!=-1){s(n)}}else if(t.type=="pan"){if(!e._spritely.instances[r]["_stopped"]){var o=t.speed||1,u=e._spritely.instances[r]["l"]||parseInt(e._spritely.getBgX(n).replace("px",""),10)||0,a=e._spritely.instances[r]["t"]||parseInt(e._spritely.getBgY(n).replace("px",""),10)||0;if(t.do_once&&!e._spritely.instances[r].remaining_frames||e._spritely.instances[r].remaining_frames<=0){switch(t.dir){case"up":case"down":e._spritely.instances[r].remaining_frames=Math.floor((t.img_height||0)/o);break;case"left":case"right":e._spritely.instances[r].remaining_frames=Math.floor((t.img_width||0)/o);break}e._spritely.instances[r].remaining_frames++}else if(t.do_once){e._spritely.instances[r].remaining_frames--}switch(t.dir){case"up":o*=-1;case"down":if(!e._spritely.instances[r]["l"])e._spritely.instances[r]["l"]=u;e._spritely.instances[r]["t"]=a+o;if(t.img_height)e._spritely.instances[r]["t"]%=t.img_height;break;case"left":o*=-1;case"right":if(!e._spritely.instances[r]["t"])e._spritely.instances[r]["t"]=a;e._spritely.instances[r]["l"]=u+o;if(t.img_width)e._spritely.instances[r]["l"]%=t.img_width;break}var f=e._spritely.instances[r]["l"].toString();if(f.indexOf("%")==-1){f+="px "}else{f+=" "}var l=e._spritely.instances[r]["t"].toString();if(l.indexOf("%")==-1){l+="px "}else{l+=" "}e(n).css("background-position",f+l);if(t.do_once&&!e._spritely.instances[r].remaining_frames){return this}}}e._spritely.instances[r]["options"]=t;e._spritely.instances[r]["timeout"]=window.setTimeout(function(){e._spritely.animate(t)},parseInt(1e3/t.fps))},randomIntBetween:function(e,t){return parseInt(rand_no=Math.floor((t-(e-1))*Math.random())+e)},getBgUseXY:function(){try{return typeof e("body").css("background-position-x")=="string"}catch(t){return false}}(),getBgY:function(t){if(e._spritely.getBgUseXY){return e(t).css("background-position-y")||"0"}else{return(e(t).css("background-position")||" ").split(" ")[1]}},getBgX:function(t){if(e._spritely.getBgUseXY){return e(t).css("background-position-x")||"0"}else{return(e(t).css("background-position")||" ").split(" ")[0]}},get_rel_pos:function(e,t){var n=e;if(e<0){while(n<0){n+=t}}else{while(n>t){n-=t}}return n},_spStrip:function(e,t){while(e.length){var n,r,i=false,s=false;for(n=0;n<t.length;n++){var o=e.slice(0,1);r=e.slice(1);if(t.indexOf(o)>-1)e=r;else i=true}for(n=0;n<t.length;n++){var u=e.slice(-1);r=e.slice(0,-1);if(t.indexOf(u)>-1)e=r;else s=true}if(i&&s)return e}return""}};e.fn.extend({spritely:function(t){var n=e(this),r=n.attr("id"),t=e.extend({type:"sprite",do_once:false,width:null,height:null,img_width:0,img_height:0,fps:12,no_of_frames:2,play_frames:0},t||{}),i=new Image,s=e._spritely._spStrip(n.css("background-image")||"",'url("); ');if(!e._spritely.instances[r]){if(t.start_at_frame){e._spritely.instances[r]={current_frame:t.start_at_frame-1}}else{e._spritely.instances[r]={current_frame:-1}}}e._spritely.instances[r]["type"]=t.type;e._spritely.instances[r]["depth"]=t.depth;t.el=n;t.width=t.width||n.width()||100;t.height=t.height||n.height()||100;i.onload=function(){t.img_width=i.width;t.img_height=i.height;t.img=i;var n=function(){return parseInt(1e3/t.fps)};if(!t.do_once){setTimeout(function(){e._spritely.animate(t)},n(t.fps))}else{setTimeout(function(){e._spritely.animate(t)},0)}};i.src=s;return this},sprite:function(t){var t=e.extend({type:"sprite",bounce:[0,0,1e3]},t||{});return e(this).spritely(t)},pan:function(t){var t=e.extend({type:"pan",dir:"left",continuous:true,speed:1},t||{});return e(this).spritely(t)},flyToTap:function(t){var t=e.extend({el_to_move:null,type:"moveToTap",ms:1e3,do_once:true},t||{});if(t.el_to_move){e(t.el_to_move).active()}if(e._spritely.activeSprite){if(window.Touch){e(this)[0].ontouchstart=function(t){var n=e._spritely.activeSprite;var r=t.touches[0];var i=r.pageY-n.height()/2;var s=r.pageX-n.width()/2;n.animate({top:i+"px",left:s+"px"},1e3)}}else{e(this).click(function(t){var n=e._spritely.activeSprite;e(n).stop(true);var r=n.width();var i=n.height();var s=t.pageX-r/2;var o=t.pageY-i/2;n.animate({top:o+"px",left:s+"px"},1e3)})}}return this},isDraggable:function(t){if(!e(this).draggable){return this}var t=e.extend({type:"isDraggable",start:null,stop:null,drag:null},t||{});var n=e(this).attr("id");if(!e._spritely.instances[n]){return this}e._spritely.instances[n].isDraggableOptions=t;e(this).draggable({start:function(){var t=e(this).attr("id");e._spritely.instances[t].stop_random=true;e(this).stop(true);if(e._spritely.instances[t].isDraggableOptions.start){e._spritely.instances[t].isDraggableOptions.start(this)}},drag:t.drag,stop:function(){var t=e(this).attr("id");e._spritely.instances[t].stop_random=false;if(e._spritely.instances[t].isDraggableOptions.stop){e._spritely.instances[t].isDraggableOptions.stop(this)}}});return this},active:function(){e._spritely.activeSprite=this;return this},activeOnClick:function(){var t=e(this);if(window.Touch){t[0].ontouchstart=function(n){e._spritely.activeSprite=t}}else{t.click(function(n){e._spritely.activeSprite=t})}return this},spRandom:function(t){var t=e.extend({top:50,left:50,right:290,bottom:320,speed:4e3,pause:0},t||{});var n=e(this).attr("id");if(!e._spritely.instances[n]){return this}if(!e._spritely.instances[n].stop_random){var r=e._spritely.randomIntBetween;var i=r(t.top,t.bottom);var s=r(t.left,t.right);e("#"+n).animate({top:i+"px",left:s+"px"},t.speed)}window.setTimeout(function(){e("#"+n).spRandom(t)},t.speed+t.pause);return this},makeAbsolute:function(){return this.each(function(){var t=e(this);var n=t.position();t.css({position:"absolute",marginLeft:0,marginTop:0,top:n.top,left:n.left}).remove().appendTo("body")})},spSet:function(t,n){var r=e(this).attr("id");e._spritely.instances[r][t]=n;return this},spGet:function(t,n){var r=e(this).attr("id");return e._spritely.instances[r][t]},spStop:function(t){this.each(function(){var n=e(this),r=n.attr("id");if(e._spritely.instances[r]["options"]["fps"]){e._spritely.instances[r]["_last_fps"]=e._spritely.instances[r]["options"]["fps"]}if(e._spritely.instances[r]["type"]=="sprite"){n.spSet("fps",0)}e._spritely.instances[r]["_stopped"]=true;e._spritely.instances[r]["_stopped_f1"]=t;if(t){var i=e._spritely.getBgY(e(this));n.css("background-position","0 "+i)}});return this},spStart:function(){e(this).each(function(){var t=e(this).attr("id");var n=e._spritely.instances[t]["_last_fps"]||12;if(e._spritely.instances[t]["type"]=="sprite"){e(this).spSet("fps",n)}e._spritely.instances[t]["_stopped"]=false});return this},spToggle:function(){var t=e(this).attr("id");var n=e._spritely.instances[t]["_stopped"]||false;var r=e._spritely.instances[t]["_stopped_f1"]||false;if(n){e(this).spStart()}else{e(this).spStop(r)}return this},fps:function(t){e(this).each(function(){e(this).spSet("fps",t)});return this},goToFrame:function(t){var n=e(this).attr("id");if(e._spritely.instances&&e._spritely.instances[n]){e._spritely.instances[n]["current_frame"]=t-1}return this},spSpeed:function(t){e(this).each(function(){e(this).spSet("speed",t)});return this},spRelSpeed:function(t){e(this).each(function(){var n=e(this).spGet("depth")/100;e(this).spSet("speed",t*n)});return this},spChangeDir:function(t){e(this).each(function(){e(this).spSet("dir",t)});return this},spState:function(t){e(this).each(function(){var r=(t-1)*e(this).height()+"px";var i=e._spritely.getBgX(e(this));var s=i+" -"+r;e(this).css("background-position",s)});return this},lockTo:function(t,n){e(this).each(function(){var r=e(this).attr("id");if(!e._spritely.instances[r]){return this}e._spritely.instances[r]["locked_el"]=e(this);e._spritely.instances[r]["lock_to"]=e(t);e._spritely.instances[r]["lock_to_options"]=n;e._spritely.instances[r]["interval"]=window.setInterval(function(){if(e._spritely.instances[r]["lock_to"]){var t=e._spritely.instances[r]["locked_el"];var n=e._spritely.instances[r]["lock_to"];var i=e._spritely.instances[r]["lock_to_options"];var s=i.bg_img_width;var o=n.height();var u=e._spritely.getBgY(n);var a=e._spritely.getBgX(n);var f=parseInt(a)+parseInt(i["left"]);var l=parseInt(u)+parseInt(i["top"]);f=e._spritely.get_rel_pos(f,s);e(t).css({top:l+"px",left:f+"px"})}},n.interval||20)});return this},destroy:function(){var t=e(this);var n=e(this).attr("id");if(e._spritely.instances[n]&&e._spritely.instances[n]["timeout"]){window.clearTimeout(e._spritely.instances[n]["timeout"])}if(e._spritely.instances[n]&&e._spritely.instances[n]["interval"]){window.clearInterval(e._spritely.instances[n]["interval"])}delete e._spritely.instances[n];return this}})})(jQuery);try{document.execCommand("BackgroundImageCache",false,true)}catch(err){}