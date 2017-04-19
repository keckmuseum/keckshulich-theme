$(document).ready(
  function() {
    $(document).foundation();

    //var menu = new Foundation.ResponsiveToggle('#menu');
    var slideShow = $('.slideshow');
    var slideShow = new Foundation.Orbit(slideShow,
      {
          containerClass: 'slideshow-container',
          slideClass: 'slide',
          nextClass: 'slide-next',
          prevClass: 'slide-previous'
      }
    );

  }
);
