var Layout = function () {
    var _isMobileDevice = function() {
        return  ((
            navigator.userAgent.match(/Android/i) ||
            navigator.userAgent.match(/BlackBerry/i) ||
            navigator.userAgent.match(/iPhone|iPad|iPod/i) ||
            navigator.userAgent.match(/Opera Mini/i) ||
            navigator.userAgent.match(/IEMobile/i)
        ) ? true : false);
    };

    var WindowWidth = $(window).width();
    var WindowHeight = $(window).height();

    var handleScrolling = function () {
        $(".scroll").on("click", function(event) {
            event.preventDefault();//the default action of the event will not be triggered
            $("html, body").animate({scrollTop:($("#"+this.href.split("#")[1]).offset().top)}, 600);
        });
    };

    var handleHeaderPosition = function () {
        var headerFix = function(){
            var CurrentWindowPosition = $(window).scrollTop();// current vertical position
            if (CurrentWindowPosition > 358) {
                $(".header").addClass("fixNav");
            } else {
                $(".header").removeClass("fixNav");
            }

            //$('#date_in_room').datepicker('hide');
            //$('#nombre_habitacion').focus();
        };

        headerFix();// call headerFix() when the page was loaded
        if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
            $(window).bind("touchend touchcancel touchleave", function(e){
                headerFix();
            });
        } else {
            $(window).scroll(function() {
                headerFix();
            });
        }
    };

    var handleGo2Top = function () {       
        var Go2TopOperation = function(){
            var CurrentWindowPosition = $(window).scrollTop();// current vertical position
            if (CurrentWindowPosition > 300) {
                $(".go2top").show();
            } else {
                $(".go2top").hide();
            }
        };

        Go2TopOperation();// call headerFix() when the page was loaded
        if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
            $(window).bind("touchend touchcancel touchleave", function(e){
                Go2TopOperation();
            });
        } else {
            $(window).scroll(function() {
                Go2TopOperation();
            });
        }
    };

    function handleBootstrap() {
        $(".carousel").carousel({
            interval: 15000,
            pause: "hover"
        });
        $(".tooltips").tooltip();
        $(".popovers").popover();
    }

    var handleFancybox = function () {
        if (!jQuery.fancybox) {
            return;
        }
        $(".zoom").fancybox();
    };

    var handleMobiToggler = function () {
        $(".mobi-toggler").on("click", function(event) {
            event.preventDefault();//the default action of the event will not be triggered
            
            $(".header").toggleClass("menuOpened");
            $(".header").find(".header-navigation").toggle(300);            
        });

        $(".mobi-togglerTop").on("click", function(event) {
            event.preventDefault();//the default action of the event will not be triggered

            $(".headerTop").toggleClass("menuOpened");
            $(".headerTop").find(".header-navigation").toggle(300);
        });

        function SlideUpMenu () {
            $(".header-navigation a").on("click", function(event) {

                if ($(window).width()<1024) {
                    //event.preventDefault();//the default action of the event will not be triggered

                    $(".header-navigation").slideUp(100);
                    $(".header").removeClass("menuOpened");
                }
            });
            $(window).scroll(function() {
                if (($(window).width()>480)&&($(window).width()<1024)) {
                    $(".header-navigation").slideUp(100);
                    $(".header").removeClass("menuOpened");
                }
            });
        }
        SlideUpMenu();
        $(window).resize(function() {
            SlideUpMenu();
        });
    };

    function valignCenterMessageFunction () {
         MessageCurrentElemHeight = $(".message-block .valign-center-elem").height();

        $(".message-block .valign-center-elem").css("position", "absolute")
            .css ("top", "50%")
            .css ("margin-top", "-"+MessageCurrentElemHeight/2+"px")
            .css ("width", "100%")
            .css ("height", MessageCurrentElemHeight);
    }

    function valignCenterPortfolioFunction () {
         PortfolioCurrentElemHeight = $(".portfolio-block .valign-center-elem").height();

        $(".portfolio-block .valign-center-elem").css("position", "absolute")
            .css ("top", "50%")
            .css ("margin-top", "-"+PortfolioCurrentElemHeight/2+"px")
            .css ("width", "100%")
            .css ("height", PortfolioCurrentElemHeight);
    }

    var valignCenterMessage = function () {
        valignCenterMessageFunction();
        $(window).resize(function() {
            valignCenterMessageFunction();
        });
    };

    var valignCenterPortfolio = function () {
        valignCenterPortfolioFunction();
        $(window).resize(function() {
            valignCenterPortfolioFunction();
        });
    };

    var handleTheme = function () {
    
        var panel = $('.color-panel');
    
        // handle theme colors
        var setColor = function (color) {
            $('#style-color').attr("href", "../../assets/frontend/onepage/css/themes/" + color + ".css");
            $('.site-logo img').attr("src", "../../assets/frontend/onepage/img/logo/" + color + ".png");
        };

        $('.icon-color', panel).click(function () {
            $('.color-mode').show();
            $('.icon-color-close').show();
        });

        $('.icon-color-close', panel).click(function () {
            $('.color-mode').hide();
            $('.icon-color-close').hide();
        });

        $('li', panel).click(function () {
            var color = $(this).attr("data-style");
            setColor(color);
            $('.inline li', panel).removeClass("current");
            $(this).addClass("current");
        });

        $('.color-panel .menu-pos').change(function(){
            if ($(this).val() == "top") {
                $('body').addClass("menu-always-on-top");
            } else {
                $('body').removeClass("menu-always-on-top");
            }
        });
    };

    return {
        init: function () {

            handleScrolling();
            handleHeaderPosition();
            handleBootstrap();
            handleGo2Top();
            handleFancybox();
            handleMobiToggler();
            //handleTwitter();
            valignCenterMessage();
            valignCenterPortfolio();

            // ir al alncla de la url
            try {
                var target = window.location.href.split('#')[1];
                if (typeof (target) != 'undefined')
                {
                    var offset = $('#'+target).offset().top;
                    offset = offset - 200;//$('.header').outerHeight()

                    $("html, body").animate({scrollTop:(offset)}, 600);
                }
            } catch (e){}
        },
        isMobileDevice: function () {
            _isMobileDevice();
        }
    };
}();