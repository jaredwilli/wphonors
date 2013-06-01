(function($) {
	
	$.fn.serializeForm = function() {
        data = {};
        url = 'functions/formprocess.php';
        items = this.serializeArray();
        $.each(items, function(i, item) {
            data[item['name']] = item['value'];
        });
        return data;
    }
    
    function submitHook(form, callback) {
		
        $(form).submit(function(e) {            

			//var fields = $('input, textarea, select').val();
			items = {};
            items = $(fields).serialize();
            url = $(this).attr('action'); // 'functions/formprocess.php'
            if ('' == url) { alert('Cannot submit form. No action specified'); return false; }
            callback = callback ? callback : function() { }
			
			$.post(url, items, callback);
			
			$(form).delay(1000).fadeOut('slow');
            return false;
        });
    }
    myCallback = function(data) {
       $('form').append('<div class="adminaccess"><h1 class="success">Success!!</h1><p align="center">Thank You For Your Submission!<br /><img src="http://2010.wphonors.com/wp-content/themes/wphonors/images/icons/Tick.png" alt="Success" /></p></div>', data);
	   $('form').delay(1000).fadeOut('slow');
    }
	
	//validateForm(form);
	var activetab = $('.ui-tabs-selected').find('a').text().toLowerCase();
	
	if (activetab == 'site') {
		var form = $('#new_site');
	} else if (activetab == 'plugin') {
		var form = $('#new_plugin');
	} else if (activetab == 'theme') {
		var form = $('#new_theme');
	} else if (activetab == 'personality') {
		var form = $('#new_person');
	}
	// alert(form);
	submitHook($(form).attr('id'), myCallback);
	
    
    function checkUrl(url) {
        var urlregex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        return urlregex.test(url);
    }

    function validateForm(formObj) {        
        var form = $(formObj);
        var success = true;
        
        $(form).find('input[type=text], textarea, select').keyup(function() {
    
            var field = $(this);
            var name = field.attr('name');
            var value = field.val();
            var submit = form
                .find('input[type=submit]');
            var results = {
                valid: true,
                msg: ''
            };
            
            field.parent().find('span').remove();
            
            submit.attr('disabled','disabled');
    
            switch ( name ) {
                case 'title' :
                    if ( '' == value ) {
                        results.valid = false;
                        results.msg = 'Title required';
                    }
                break;
                case 'description':
                    if ( '' == value ) {
                        results.valid = false;
                        results.msg = 'Description required';
                    }
                break;
                case 'cat' :
                    if ( value == -1 ) {
                        results.valid = false;
                        results.msg = 'Select a category';
                    }
                break;
                case 'tags' :
                    if ( '' == value ) {
                        results.valid = false;
                        results.msg = 'Enter one tag or more';
                    }
                break;
                case 'siteurl' :
                    if ( !checkUrl(value) ) {
                        results.valid = false;
                        results.msg = 'Valid Url Required';
                    }
                break;
                case 'twitname' :
                    if ( '' == value || '' == value ) {
                        results.valid = false;
                        results.msg = 'Twitter name required';
                    }
                break;
                default:
                break;
            }
            if ( results.valid === false ) {
                field.parent().append('<span class="invalid"></span>');
            }
            if ( results.valid === true ) {
                field.parent().append('<span class="isvalid" ></span>');
                
                submit.attr('disabled','');
            }
        });
    }
})(jQuery);


/* Show input url screenshots */
function siteValue(value){
	var input = $('#mshot');
	( value.length != 0 ) ? input.html('<img src="http://s.wordpress.com/mshots/v1/' + encodeURIComponent(value) + '?w=80" width="80" />') : input.html('');
}
function tshotValue(value){
	var input = $('#tshot');
	( value.length != 0 ) ? input.html('<img src="http://img.tweetimag.es/i/' + value + '_b" width="73" />') : input.html('');
}
function pshotValue(value){
	var input = $('#pshot');
	( value.length != 0 ) ? input.html('<img src="http://s.wordpress.com/mshots/v1/' + encodeURIComponent(value) + '?w=80" width="80" />') : input.html('');
}

$(function() {
		   
    var t = $('<div class="gp"></div>'),
        d = $(document);
    $('body').append(t);
    t.css({
        opacity: 0,
        position: 'absolute',
        top: 100,
        right: '2%'
    });
    t.click(function() {
        $('html,body').animate({
            scrollTop: 0
        }, 1000);
    });
    $(window).scroll(function() {
        var sv = d.scrollTop();
        if (sv < 10) {
            t.clearQueue().fadeOut(200).css('display','none');
            return;
        }
        t.css('display', '').clearQueue().animate({
            top: sv,
            opacity: 0.8
        }, 500);
    });
	
	/* Tags Suggest */
	//$('input[name="tags"]').suggest(ajaxurl + '&action=tag_search', { delay: 350, minchars: 2, multiple: true, multipleSep: ", " } );
	
	/* Equal height divs */
	function equalHeight(group) {
		var tallest = 0;
		group.each(function() {
			var thisHeight = $(this).height();
			if(thisHeight > tallest) {
				tallest = thisHeight;
			}
		});
		group.height(tallest);
	}
	equalHeight($('.finalists'));

	/* Drop Nav animation */
	$("#navigation ul.menu ul").css({ display: 'none' });
	$("#navigation ul.menu li").hover(function() {
		$(this).find('ul.sub-menu')
			.stop(true, true).delay(50).animate({ "height": "show", "opacity": "show" }, 200 );
	}, function(){
		$(this).find('ul.sub-menu')
			.stop(true, true).delay(50).animate({ "height": "hide", "opacity": "hide" }, 200 );
	});

	/* Fade in / Fade out links */
	$("#content a img").css("opacity","1"); 	
	$("#content a img").hover(function () { 	
		$(this).stop().animate({ opacity: 0.5 }, 'fast' );
	}, function () {
		$(this).stop().animate({ opacity: 1 }, 'fast' );
	});
		
	/* Dialog Link & Tabs */
	$('#tabs').tabs();
	$('#dialog_link').click(function(){ $('#dialog').dialog('open'); return false; });

	/* Fade in - Fade out */
	$(".finalists").find('a img').css("opacity","1");
	$(".finalists").find('a img').hover(function () {
		$(this).stop().animate({ opacity: 0.75 }, 500);
	}, function () { 
		$(this).stop().animate({ opacity: 1 }, 500);
	});

	/* Bobble Upwards on Hover */
	$('a').hover(function() {
		$(this).children('img').stop().animate({ "top" : "-10px"}, 200);
	}, function() {
		$(this).children('img').stop().animate({ "top" : "0px"}, 200);
		
	});

	/*
	var btn = $('.breadcrumb'),
		sites = $('.sites');
	$(sites).css({ display: 'none'});
	$(btn).live('click', function() {
		$(this).next().toggle(100);
	});
	*/

	/* Nudge Links on Click	*/
    $("#page_wrap a").click(function(){
    	$(this).stop().animate({ marginTop: "1px" }, 100); 
	}, function() {
		$(this).stop().animate({ marginTop: "0px" }, 100);
	});

	//Comments hint box
	$('#commentsform #rules-toggle').show(0);
	$('#commentsform .comment-rules').hide(0);
	$('#commentsform #rules-toggle a').toggle(
		function(){
			$('#commentsform #rules-toggle a').html("hide" );
			$('#commentsform .comment-rules').stop(true,true).slideDown(140);
			return false;
		},
		function(){
			$('#commentsform #rules-toggle a').html("show allowed tags" );
			$('#commentsform .comment-rules').stop(true,true).slideUp(130);
			return false;
		}
	);
});

/*
var Tooltips = {
	init: function() {
		var links = $('#content-main a');
		
		for (var i = 0, ii = links.length; i < ii; i++) {
			if (links[i].title && links[i].title.length > 0) {
				var tipContainer = document.createElement("span");
				tipContainer.className = links[i].className + " tipcontainer";
				
				links[i].parentNode.replaceChild(tipContainer, links[i]);
				tipContainer.appendChild(links[i]);
				
				$(links[i]).bind("mouseover", Tooltips.showTipListener);
				$(links[i]).bind("focus", Tooltips.showTipListener);
				$(links[i]).bind("mouseout", Tooltips.hideTipListener);
				$(links[i]).bind("blur", Tooltips.hideTipListener);
			}
		}
	},

	showTipListener: function(event) {
		Tooltips.showTip(this);
		event.preventDefault();
	},
	
	hideTipListener: function(event) {
		Tooltips.hideTip(this);
	},

	showTip: function(link) {
		if (!link.nextSibling) {
			var tip = document.createElement("span");
			tip.className = "tooltip";
			var tipText = document.createTextNode(link.title);
			tip.appendChild(tipText);
			link.parentNode.appendChild(tip);

			link.title = "";
		}
	},
	
	hideTip: function(link) {
		if (link.nextSibling) {
			var tip = link.nextSibling;
			link.title = tip.firstChild.nodeValue;
			link.parentNode.removeChild(tip);
		}
	}
};
Tooltips.init();
*/