$(window).resize(setGarbage);

function setGarbage()
{
	$(".fullScreen.carousel .item").height($(window).height());
	$(".distanceMe").css("margin-top", $(".the-fixed .navbar").height());	
}

$(document).ready(function() {
	
	setGarbage();
	
	$('.carousel').carousel({
		interval: 3000
	})
	
	$(".carousel .item").on("swipe", function (event)
		{
			var carousel = $(event.target).closest(".carousel");
			var current = carousel.find(".carousel-indicators li.active").index();
			var diff = 0;
			if(event.swipestart.coords[0] > event.swipestop.coords[0])
				diff = +1;
			else
				diff = -1;
			current = (current+diff)%(carousel.find(".carousel-indicators li").length);
			if(current == -1)
				current = carousel.find(".carousel-indicators li").length -1;
			carousel.find(".carousel-indicators li:eq("+(current)+")").click();
		}
	);
	
	
	$(document).scroll(function(){
		if(($(document).scrollTop() > ($(".up-the-fixed").height())) || ($(".up-the-fixed").length == 0))
		{
			$("body").addClass("fixedMenu");
		}
		else
		{
			$("body").removeClass("fixedMenu");
		}
	});
	
	$(".scrollLink").click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname)
			{
		  		var $target = $(this.hash);
		  		$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
		  		if ($target.length) {
		  			var targetOffset = $target.offset().top - $(".the-fixed .navbar").height();
		  			$('html,body').animate({scrollTop: targetOffset}, 1000);
		  			return false;
				}
		  	}
		 });	
});

function setScroll()
{	
	if(window.location.hash != "")
	{
		var targetOffset = $(window.location.hash).offset().top - $(".the-fixed .navbar").height();
		$('html,body').animate({scrollTop: targetOffset}, 1000);
	}
}

String.prototype.trunc =
     function(n,useWordBoundary){
         var toLong = this.length>n,
             s_ = toLong ? this.substr(0,n-1) : this;
         s_ = useWordBoundary && toLong ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
         return  toLong ? s_ + '&hellip;' : s_;
      };

function ajax(urlReq, functionSuccess)
{
	//jQuery.support.cors = true;
	if (false)//$.browser.msie && window.XDomainRequest)
	{
		// Use Microsoft XDR
		var xdr = new XDomainRequest();
		xdr.open("get", urlReq);
		xdr.onerror = function(){};
		xdr.onprogress = function(){};
		xdr.onreadystatechange = function(){};
		xdr.ontimeout = function(){};
		xdr.onload = function() {
			// XDomainRequest doesn't provide responseXml, so if you need it:
			var dom = new ActiveXObject("Microsoft.XMLDOM");
			dom.async = false;
			dom.loadXML(xdr.responseText);
			functionSuccess(xdr.responseText);
		};
		xdr.send();
	} else {
		jQuery.ajax({
		url: urlReq,
		dataType: 'text',
		success: function(data){
					functionSuccess(data);
				},
		error: function(xhr, status, error) {
				  var err = eval("(" + xhr.responseText + ")");
				  alert("jQuery error: "+error);
				}
		});
	}
}