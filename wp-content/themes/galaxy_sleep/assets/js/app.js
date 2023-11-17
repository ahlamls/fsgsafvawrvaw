var lastScrollTop = 0;

window.addEventListener("scroll", function(){ 
    var st = window.pageYOffset || document.documentElement.scrollTop; 
    var nav = document.querySelector('header nav');
    if(st > 100) {
        nav.classList.remove('navbar-top-position')
        nav.classList.add('is-below-navbar-position')
    } else if (st == 0) {
        nav.classList.add('navbar-top-position')
        nav.classList.remove('is-below-navbar-position')
    }

    if (st > lastScrollTop) { // bottom direction
        nav.style.top = '-110px';
    } else if (st < lastScrollTop) { // top direction
        nav.style.top = '0px';
    }
    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}, false);

function handleToggleNav() {
    var nav = document.querySelector('header nav');
    if(nav.classList.contains('navbar-open')) {
        nav.classList.remove('navbar-open');
        document.body.classList.remove('overflow-hidden');
    } else {
        nav.classList.add('navbar-open');
        document.body.classList.add('overflow-hidden');
    }
}
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function hideBanner() {
    document.getElementById('banner').classList.remove('banner-show')
    var today = new Date();
    var expire = new Date();
    var nDays=365
    expire.setTime(today.getTime() + 3600000*24*nDays);
    document.cookie = "galaxy_banner=true;expires="+expire.toGMTString() + "; path=/"; 
}

function calculateMonthlyPrice(){
    var option = $('#monthly-option').val();
    var price = $('.pi-price > ins .amount, .pi-price > .amount').first().text().replace("'","");
    price = parseInt(price);
    $('#monthly-price').text(Math.round(price/option));
}

$(document).ready(function(){
    if(getCookie('galaxy_banner') == '') {
        $('#banner').addClass('banner-show');
    }
    $('body.single-product table.variations selectx').each(function(){
        var $this = $(this);
        var $ul =  $('<ul></ul>');
        var $label = $(this).parents('tr').first().find('.label');
        $this.find('option').each(function(){
            var $option = $(this);
            var value = $option.val();
            var label = $option.text();
            if(value == '') return;
            var $li = $('<li></li>');
            $li.attr('data-val',value).text(label).data('value',value);
            $li.on('click', function(){
                $(this).parent().find('li').removeClass('active')
                $(this).addClass('active')
                $this.val($(this).data('value')).trigger('change');
                if($('.woocommerce-variation-price .amount').length) $('.summary .price').html($('.woocommerce-variation-price .amount'));
                setTimeout(function(){
                    if($('.woocommerce-variation-price .amount').length) $('.summary .price').html($('.woocommerce-variation-price .amount'));
                },500);
                setTimeout(function(){
                    if($('.woocommerce-variation-price .amount').length) $('.summary .price').html($('.woocommerce-variation-price .amount'));
                },1000);
            });
            $ul.append($li);
        });
        $label.append($ul);
    });
    $('body.single-product .product-detail-content select').each(function(){
        $(this).selectmenu({
            change: function( event, ui ) {
                $(this).trigger('change');
            }
        });
    });

    $('ul.products .mp-price').each(function(){
        var $price = $(this).parents('li.product').find('.price ins .amount, .price > .amount').first();
        if(!$price.length) return;
        price = parseInt($price.text().replace("'",""));
        $(this).text(Math.round(price/48));
    });

    var variationPrice = document.querySelector('body.single-product .woocommerce-variation.single_variation');
    if(variationPrice != null){
        var variationPriceObserver = new MutationObserver(function(mutations) {
            if($('.woocommerce-variation-price .price').length) $('.summary .pi-price').html($('.woocommerce-variation-price .price').html());
            calculateMonthlyPrice();
        });
        variationPriceObserver.observe(variationPrice, {
            attributes:    true,
            childList:     true,
            characterData: true
        });
    }

    $('#monthly-option').on('change', function(){
        calculateMonthlyPrice();
    });

    $(".fn-slider-range").each(function(){
        var $slider = $(this).find('[data-slider-range]');
        var $min = $(this).find('[data-slider-min]');
        var $max = $(this).find('[data-slider-max]');
        var min = $min.val();
        var max = $max.val();
        var maximum = $(this).attr('data-slider-maximum');
        $slider.slider({
            range: true,
            min: 0,
            max: maximum,
            values: [(min != "" ? min : 0), (max != "" ? max : maximum)],
            slide: function( event, ui ) {
                $min.val(ui.values[0]);
                $max.val(ui.values[1]);
            },
            change: function( event, ui ) {
                $min.val(ui.values[0]).trigger('change');
            }
        });
    });

    $("body").on('click','.fn-filter-control', function(){
        var fc = $(this).attr('data-fc');
        if(fc == 'all'){
            $('[data-fcv][type="checkbox"]').prop('checked',false).trigger('change');
            $('[data-fcv][type="text"]').val('').trigger('change');
        } else {
            $('[data-fcv="'+fc+'"][type="checkbox"]').prop('checked',false).trigger('change');
            $('[data-fcv="'+fc+'"][type="text"]').val('').trigger('change');
        }
        if(fc == 'filter_price' || fc == 'all'){
            var options = $('[data-slider-range]').slider('option');
            $('[data-slider-range]').slider('values',[options.min, options.max ]);
        }
    });
    window.search_request = null;
    $('#form-search').on('submit', function(e){
        if($("#search-result").length < 1){            
            return;
        }
        e.preventDefault();
        var url = $(this).attr('action')+'?'+$(this).serialize();
        history.pushState({}, null, url);
        if(window.search_request != null) window.search_request.abort();
        window.search_request = $.ajax({
            url: url,
            success: function(data) {
                $("#search-result").html($(data).find("#search-result-content"));
            }
        });
    });

    $('#form-search input').on('change',function(){
        $('#form-search').trigger('submit');
    });

    $('[data-zoho-live-chat]').on('click',function(e){
        e.preventDefault();
        $('body').toggleClass('zoho-live-chat-active',true);
        $zoho.salesiq.floatwindow.visible('show');
    });

    $('.fn-search-nav').on('click', function(){ 
        $('.fn-collapse .sf-content').removeAttr('style');
        window.scrollTo({ top: 0 });
        $('.search-filter').toggleClass('sfn-active');
        $('body').toggleClass('search-filter-opened');
        setTimeout(function(){
            $('.fn-collapse .sf-content').css('height', this.offsetHeight);
        },500);
    });

    $('.fn-collapse .sf-content').each(function(){
        $(this).css('height', this.offsetHeight);
    });

    $('.fn-collapse .sf-label').on('click', function(){
        $(this).parent().toggleClass('sf-active');
    });
});