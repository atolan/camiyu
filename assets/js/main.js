var trigger = document.getElementById("trigger");
function menuTrigger() {
    trigger.classList.toggle('change');
    document.querySelector('.menu_sp').classList.toggle("is-show");
    document.querySelector('body').classList.toggle("menu_open");
}
var staffLink = document.querySelector('.navigation-menu.pc ul li.menu-staff');
staffLink.onclick = function() {
	if(document.querySelector('.navigation-menu.pc ul li.menu-company').classList.contains('active')) {
		document.querySelector('.navigation-menu.pc ul li.menu-company').classList.remove('active');
	};
	document.querySelector('.navigation-menu.pc ul li.menu-staff').classList.add('active');
} 
var topBtn = document.getElementById("topBtn");
var scrollHeight = window.innerHeight / 2;

window.onscroll = function() {scrollFunction()};
var lastScrollTop = 180;
function scrollFunction() {
    if (document.body.scrollTop > scrollHeight || document.documentElement.scrollTop > scrollHeight) {
        topBtn.classList.add("showBtn");
        } 
    else {
        if(topBtn.classList.contains("showBtn")){
            topBtn.classList.remove("showBtn");
        }
    }
	var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
    if (st > lastScrollTop){
        var header = document.getElementById('header');
        header.classList.add('is-close');
    } else {
        var header = document.getElementById('header');
        header.classList.remove('is-close');
    }
    lastScrollTop = st <= 180 ? 180 : st; 
}
	var ppp = 6; // Post per page
	var pageNumber = 2;
	
	function load_posts(){ 
		var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&newsPage=' + newsPage + '&performPage=' + performPage + '&eventPage=' + eventPage + '&myyear=' + myyear + '&search_cat=' + activeCategories + '&action=more_post_ajax';
		$.ajax({
			type: "POST",
			dataType: "html",
			url: adminurl,
			data: str,
			success: function(data){
				$data = $(data);
				console.log("Ajax is successful.");
				if($data.length){
					if(!newsPage && !performPage && !eventPage) {
						$("#ajax-posts").append($data);
					}
					else {
						if(newsPage) {
							$("#ajax-posts-news").append($data);
						}
						if(performPage) {
							$("#ajax-posts-perform").append($data);
						}
						if(eventPage) {
							$("#ajax-posts-event").append($data);
						}
					}
					if(activeCategories) {
						$("#ajax-posts-category").append($data);
					}
					$("#more_posts").attr("disabled",false);
					pageNumber++;
				
				} else{
					console.log("data length is none.");
					document.getElementById("more_posts").style.display = "none";
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				// $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				console.log("Server Error");
			}

		});
		return false;
	}

	
	$("#more_posts").on("click",function(){
		$("#more_posts").attr("disabled",true); 
		load_posts();
		if(!newsPage && !performPage && !eventPage) {
			$(this).insertAfter('#ajax-posts');
		}
		else {
			if(newsPage) {
				$(this).insertAfter('#ajax-posts-news');
			}
			if(performPage) {
				$(this).insertAfter('#ajax-posts-perform');
			}
			if(eventPage) {
				$(this).insertAfter('#ajax-posts-event');
			}
		}
		if(activeCategories) {
			$(this).insertAfter('#ajax-posts-category');
		}
	});

	$( document ).ready(function() {
		var cur_url = window.location.href;
		if(cur_url.includes("company/#staff")){
			document.querySelector('.navigation-menu.pc ul li.menu-staff').classList.add('active');
		} else if(cur_url.includes("company")){
			document.querySelector('.navigation-menu.pc ul li.menu-company').classList.add('active');
		}
	});

