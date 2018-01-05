$(document).ready(function()
{

	//getCounter();
	var tempValue=5000;

	$('.to-zaym').click(function(){
		sum = parseInt($('.sum-zaym .ui-slider-tip').last().text());
		//timZaym = parseInt($('.time-zaym .ui-slider-tip').last().text());
		$.ajax({
			type: "POST",
			url: "/save_data.php",
			data: {
                            'AJAX_COMAND' : 'Bank.toZaym',
				'data' : {
					'SUM' : sum,
					//'TIME' : timZaym
				}
			},
			dataType : 'json',
			success: function(data)
			{
				console.log(data)
				//yaCounter39509470.reachGoal('mainform');
				location.href="/profile/"

			},
			error : function(e){

			}
		});
	});

	$('.final__header-more').click(function() {
		$(this).toggleClass('active');
		$(this).parents('.final__item').find('.final__box').toggleClass('active');
		$(this).parents('.final__item').siblings().find('.final__box').removeClass('active');
	});

	$('.blocked__close').click(function() {
  		$(this).parent('.blocked').hide();
 	});


	$('body').on('click', '.to-credit', function(event) {
		event.preventDefault();
		var $el = $(this);
		var goal = $el.data('goal');
		yaCounter39509470.reachGoal(goal);
		location.href="/profile/";
	});

	$(".opinions__list").owlCarousel({
		nav: true,
		loop: true,
		margin: 30,
		items: 3,
	    responsive:{
	        0:{
	            items:1
	        },
	        640:{
	            items:2
	        },
	        1024:{
	            items:3
	        }
	    }
	});

	$(".compare__table").owlCarousel({
		nav: true,
		loop: false,
		margin: 0,
		items: 4,
	    responsive:{
	        0:{
	            items:1
	        },
	        640:{
	            items:2
	        },
	        1024:{
	            items:3
	        },
	        1366:{
	            items:4
	        }
	    },
		onInitialized: function(e) {
			$('.compare__count').text('1/' + this.items().length)
		}
	});

	$(".compare__table").on('changed.owl.carousel', function(e) {
		$('.compare__count').text(++e.page.index  + '/' + e.page.count)
	});

	$(".example__slider-list").owlCarousel({
		nav: true,
		loop: true,
		items: 1
	});

	$(".fancyPhoto").fancybox();

	Inputmask("+7 (999) 999 99 99").mask('.phoneMask');
	Inputmask("999999").mask('.Pas');
	Inputmask("9999 999999").mask('.seriesMask');
	Inputmask("999-999").mask('.departmentMask');
	Inputmask("dd.mm.yyyy", {placeholder:"_"}).mask('.dateMask');
	//Inputmask("yyyy.mm.dd", {placeholder:"_"}).mask('.dateMask');

	$(".enterLink").click(function(e) {
		e.preventDefault();
		$(".enterModal").arcticmodal();
	});

	$(".mLink").click(function(e) {
		e.preventDefault();
		$(".mModal").arcticmodal();
	});

	$(".regionLink").click(function(e) {
		e.preventDefault();
		$(".regionModal").arcticmodal();
	});

	$('.nav-show').click(function() {
		$('.nav').toggleClass('show');
		$(this).toggleClass('open');
		$('body').toggleClass('stop');
	});

	$.scrollIt();

	$(".select").select2({
		minimumResultsForSearch: Infinity,
		width: '100%'
	});

	$(".js-selectRegion").select2({
		width: '100%'
	});

	$(".js-selectCity").select2({
		width: '100%',
		tags: true
	});

	$(".sizeLoan")
		.slider({
			range: 'min',
			value: $("#formazaima_amount").val(),
			min: 2000,
			max: 30000,
			step: 1000,
			change:function(event,ui){
				var amount2 = ui.value;
				$("#formazaima_amount").val((amount2));
			}
    })
		.slider("float", {
			handle: true,
			pips: false,
			labels: false,
			prefix: "",
			suffix: " руб."
	});

	$(".timeLoan")
		.slider({
			range: 'min',
			min: 7,
			max: 20,
			value: 10,
			step: 1

		})
		.slider("float", {

			handle: true,
			pips: false,
			labels: false,
			prefix: "",
			suffix: ""

		});


	cSize = ($('#cSIZE').length>0)? parseInt($('#cSIZE').val()) : 15;

	$(".sizeRegistration")
		.slider({
			range: true,
			min: 1,
			max: 30,
			values: [0,cSize],
			step: 1

		})
		.slider("float", {

			handle: true,
			pips: false,
			labels: false,
			prefix: "",
			suffix: ""

		});

	$(".sizeRegistration").on( "slidestop", function( event, ui ) {
		$('#cSIZE').val(ui.value);
	} );

	$("#region_name, #duplication_region_name").on("change", function () {
		var regionId = $(this).val();

		var $parentBox = $(this).parents(".registration__box");

		$.get("/get_region_cities.php?region_id=" + regionId, function (result) {
			var html = '<option></option>';

			for (var i in result.cities) {
				if (!result.cities.hasOwnProperty(i)) continue;

				var city = result.cities[i];

                html += "<option value=" + city.id  + ">" +city.name + "</option>"
			}

			$(".js-selectCity", $parentBox).html(html);
        }, "json")
    });


});
function colored(){
	$('.counter__order').css('background', '#24b059');
}
/*function getCounter(){
	
	$.ajax({
	  	type: "POST",
	 	url: "/",
	 	data: {
	  	//'csrf_key' : csrf_key,
	  	'AJAX_COMAND' : 'Order.getCount',
	  		'data' : {
	  			
	  		}
		},
		dataType : 'json',
		success: function(data)
		{	
			//console.log(data)
			old = $('.counter__order').text();
			if(old != data.count){
				$('.counter__order').css('background', '#f8c812');
				$('.counter__order').text(data.count);	
				setTimeout('colored();', 500)
			}
			
			
			
		},
	  	error : function(e){		
	  	  	
	  	} 
	})

	//setTimeout('getCounter();', 5000);


}*/

function initSlider(name)
{
	$.each($('.sizeRegistration[name="slider_'+name+'"]'), function()
	{
		var $el = $(this);
		var value_container = $el.find('input[type="hidden"]');
		
		var min = $el.data('min');
		var max = $el.data('max');
		var step = $el.data('step');
		var preffix = $el.data('preffix');
		var value = (value_container.length && value_container.val().length) ? parseInt(value_container.val()) : max;

		$el.slider(
				
			{
				range: 'min',
		        min: min,
		        max: max,
		        value: value,
		    	step: step
		    
		    })
			.slider("float", {
		    	handle: true,
		    	pips: false,
		    	labels: false,
		    	prefix: "",
		    	suffix: " " + preffix
		    
			});

		$el.on( "slidestop", function( event, ui ) 
		{
			value_container.val(ui.value);	
			value_container.trigger('change');	
		} );

	});
}

function paymentVal(sum){
	sum += Math.ceil((sum/100)*13);
	return sum;
}

function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

$(window).on('load', function(){
	value=$("#formazaima_amount").val();
    ua = navigator.userAgent;
	
});
//************************************

$(".sizeDay")
    .slider({
		range: 'min',
		value: $("#formazaima_term").val(),
        min: 5,
        max: 365,
    	step: 1,
		change:function(event,ui){
			var term = ui.value;
			$("#formazaima_term").val((term));
		}
    })

	.slider("float", {
    	
    	handle: true,
    	pips: false,
    	labels: false,
    	prefix: "",
    	suffix: " дней."
    
	});

$(".timeLoan")
    .slider({
		range: 'min',
        min: 7,
        max: 20,
        value: 10,
    	step: 1
    
    })
	.slider("float", {
    	
    	handle: true,
    	pips: false,
    	labels: false,
    	prefix: "",
    	suffix: ""
    
	});



//*************************************
// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

$( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "-100:+0"
    });
  } );


