(function() {
  let app = {
      init: function () {
        if(window.addEventListener){
            window.addEventListener("scroll", function() {
                app.animate();
            }, false);
        }else{
            window.attachEvent("scroll", function(){
                app.animate();
            });
        }

        app.checkIE();
        app.animate();
      },
      checkIE : function(){
        var nav =   window.navigator.userAgent,
            idx =   nav.indexOf("MSIE"),
            tri =   nav.indexOf("Trident/");
        if(idx > 0 || tri > 0){
            var version = (parseInt(nav.substring(idx + 5, nav.indexOf('.', idx)), 10));
            app.ie  =   true;
            document.body.classList.add('ie');
            document.body.classList.add('ie'+version);
        }
      },
      animate: function(){
        var _wa = document.querySelectorAll('.wa');
        for (var i = 0; i < _wa.length; i++) {
          var _this    = _wa[i],
              _style   = window.getComputedStyle(_this),
              _wh      = screen.height - parseInt(_style.marginTop) - parseInt(_style.marginBottom),
              _offsetT = _this.offsetTop + parseInt(_style.marginTop) + _wh * .05,
              _scroll  = window.scrollY,
              _screen  = _scroll + _wh;


        if (_screen >= _offsetT) {
          _this.classList.add("animate");
        }
      }
    },
  }

  app.init();
})()
