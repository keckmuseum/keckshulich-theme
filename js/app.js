function isUndefined(value){
    // var undefined = void(0);
    return typeof value == "undefined";
}

$(document).ready(
  function() {

    swiperArgs = {
    	effect: 'coverflow',
    	// loop: true,
      simulateTouch: false,
    	centeredSlides: true,
    	slidesPerView: 'auto',
    	initialSlide: 0,
    	keyboardControl: true,
    	preventClicks: true,
    	preventClicksPropagation: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      mousewheel: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
    	coverflowEffect: {
    		rotate: 10,
    		stretch: 400,
    		depth: 250,
    		modifier: 1,
    		// slideShadows : true,
    	},
      on: {
        init: function(){

          var swiperWrapper = document.getElementById("exhibit-0");

          var observer = new MutationObserver(function(mutations) {
            console.log('styles changed');
            exhibitBrowserOverlay('loaded');
          });
          observer.observe(swiperWrapper, {
            attributes: true,
            attributeFilter: ['style'] });

          swiperWrapper.dataset.selectContentVal = 1;
        },
      }
    }
    // var swiper = new Swiper('.exhibit', swiperArgs });

    swiper = false;
    itemsError = false;

    // init with options
    $('.exhibit .images').photoswipe({
        bgOpacity: 0.5,
        loop: true
    });

    // $('.exhibit-thumbnails').on('click', 'a',
    //   function(e){
    //     e.preventDefault();
    //     i = parseInt($(this).attr('href').replace('#exhibit-',''));
    //     exhibits.flipster('jump', i);
    //   }
    // );

    // $('.exhibits-filters select').each(
    //   function() {
    //     $(this).on('change',
    //       function(e) {
    //         // rebuildExhibitGrid();
    //       }
    //     );
    //   }
    // );
    $('.exhibits-filters a[href="#search"]').click(
      function(e) {
        e.preventDefault();
        rebuildExhibitGrid(
          false,
          true
        );
      }
    );
    $('.exhibits-filters a[href="#clear"]').click(
      function(e) {
        e.preventDefault();
        resetFilters();
      }
    );


    $('.exhibit-themes a').click(
      function(e) {
        e.preventDefault();
        rebuildExhibitGrid(
          $(this).data('theme-id'),
          true
        );
        $.cookie('current-theme',$(this).data('theme-id'));
      }
    );

    // $('a[href="#exhibit-browser"]').on('click',
    //   function(e){
    //     e.preventDefault();
    //     exhibitBrowserOverlay();
    //     //exhibits.flipster('index');
    //   }
    // );

    $('.exhibit-browser, .exhibit-browser .back-to-listing').on('click',
      function(e){
        console.log(e.target);
        if($(e.target).parents('.swiper-container').length === 0) {
          // e.preventDefault();
          exhibitBrowserOverlay('close');
        }
      }
    );

    //temporarily disable these links.
    $('#bond-details.meta a, a[href="https://www.unr.edu"]').click(
      function(e){
        e.preventDefault();
      }
    );
    $('#site-title a').click(
      function(e){
        e.preventDefault();
        window.location.href='/bonds/';
      }
    );

    // $('.view-detail').on('click',
    //   function(e){
    //     e.preventDefault();
    //     $.cookie('slider-position',$(this).parents('li').index());
    //     // window.location.href = $(this).attr('href');
    //   });

});

function exhibitBrowserInit() {
  if(swiper===false) {
    swiper = new Swiper('.swiper-container', swiperArgs )
    console.log('init');
  } else {
    swiper = new Swiper('.swiper-container', swiperArgs )
    // swiper.update();
    // swiperDelay = window.setTimeout(function(){
    //   swiper.update();console.log('reindex');
    // }, 5000);
  }


  if( $('.exhibits-carousel > ul > li').length === 1 ) {
    $('.exhibits-carousel > ul').addClass('one-item');
  } else {
    $('.exhibits-carousel > ul').removeClass('one-item');
  }

    // $('.exhibits').removeClass('flipster--active');
    // exhibits = $('.exhibits').flipster(flipsterArgs);
    // exhibits.flipster('jump', 0);

    // swiper.enableMousewheelControl();
  if( $('.exhibits-carousel > ul > li').length === 1 ) {
    $('.exhibits-carousel > ul').addClass('one-item');
  } else {
    $('.exhibits-carousel > ul').removeClass('one-item');
  }
}

function exhibitBrowserOverlay(action) {
  if(action === 'close') {
    console.log('close')
    $('.exhibit-browser').fadeTo( "slow" , 0.001);
    $('.exhibit-browser').hide();
    $('.exhibit-browser-overlay').fadeOut('fast');
    $('.exhibit-browser-overlay .loading').fadeIn('slow');
    if(itemsError===false){
      swiper.destroy();
    } else {
      $('body').removeClass('items-error');
      itemsError=false;
    }
  } else if(action === 'loaded') {
    console.log('loaded');
      $('.exhibit-browser').css('opacity',1);
      console.log('?');
  } else {
    console.log('open');
    $('.exhibit-browser-overlay').fadeIn('fast');

    $('.exhibit-browser').show();
    $('.exhibit-browser').css('opacity',0.001);

  }
}
function rebuildExhibitGrid(themeId=false,openCarousel=false) {
  if(themeId) {
    argumentString = '?theme=' + themeId;
  } else {
    argumentString = buildArgumentString();
  }

  if(argumentString != 0) {
    $.ajax({
      url:'/wp-json/wp/v2/bonds/'+argumentString,
      context: document.body
    }).done(function(data) {
      console.log('ajax done: '+data);
      // gridBuild(data);
      browserBuild(data);
      if(openCarousel){
        console.log('opencarousel true');
        if(itemsError===false){
          exhibitBrowserInit();
          exhibitBrowserOverlay();
        } else {
          exhibitBrowserOverlay();
          exhibitBrowserOverlay('loaded');
        }


      }
    }); // Ajax Bonds done
  } else {
    return 0
  }
}
function resetFilters() {
  $('.exhibits-filters select').each(
    function() {
      var initVal=$(this).find('option:first-child').html();
      console.log(initVal);
      $(this).val(initVal).change();
    }
  );
}
function buildArgumentString() {
  var filterArguments = [];
  $('.exhibits-filters select').each(
    function() {
      name = $(this).attr('id');
      value = $(this).find('option:selected').attr('name');
      if(value>0){
        filterArguments.push( Array(
          name,
          value
        ) );
      }
    }
  );

  var argumentString = '?';
  filterArguments.forEach( function(argument) {
    if(argumentString != '?') {
      argumentString += '&';
    }
    argumentString += argument[0]+'='+argument[1];
  });

  if(argumentString === '?') {
    argumentString='';
  }

  if(lastArgumentString && lastArgumentString == argumentString) {
    return 0
  }

  var lastArgumentString = argumentString;

  return argumentString;
}

function gridBuild(data) {
  $('.exhibits-grid').replaceWith('<div class="exhibits-grid"><ul></ul></div>');

  if(data.length > 0) {

    $.each(data,function(i){

      setGridItems(this);

      image=this.image[0][0];

      if( !isUndefined(image) || image==='' ) {
        getImage(i, image, '.exhibits-grid ul li:eq('+i+')' );
      }

    }); // Each Ajax Bond

  } else {
    $('.exhibits-grid').replaceWith(
      '<div class="exhibits-grid"><div class="query-error"><p>No results. Try changing the filter options above.</p></div></div>'
    );
  }
}

function browserBuild(data) {
  $( '.exhibit-browser .exhibits > ul' ).html('');
  // $( '.exhibit-browser .exhibit-thumbnails > ul' ).html('');
  console.log('browserbuilding');
  if(data.length > 0) {
    console.log('items found');
    $.each(data,function(i){
      setBrowserItems(this, i);
    }); // Each Ajax Bond
    console.log('broserBuild done');
  } else {
    console.log('no items found');
    itemsError=true;
    $('body').addClass('items-error');
    $('.exhibit-browser .swiper-wrapper').html(
      '<li class="swiper-slide"><div class="query-error"><p>No results. Try changing the filter options.</p></div></li>'
    );
  }
}

function setGridItems(item) {
  $( '.exhibits-grid ul' ).append('<li>\
      <a href="'+item.link+'" title="'+item.title.rendered+'">\
        <img src="placeholder.png" alt="" />\
      </a>\
    </li>'
  );
}
function setBrowserItems(item, i) {
  $( '.exhibit-browser .exhibits > ul' ).append('\
    <li id="exhibit-'+i+'" class="swiper-slide">\
        <div class="exhibit">\
          <div class="inner">\
            <h2>'+item.title.rendered+'</h2>\
            <div class="exhibit-meta">\
              <div>\
                <div class="date-issued" aria-labelled-by="h3">\
                  <h3>Date</h3>\
                  <p>'+item.date+'</p>\
                </div>\
              \
                <div class="location" aria-labelled-by="h3">\
                  <h3>Location</h3>\
                  <p>'+item.location+'</p>\
                </div>\
              \
                <div class="amount" aria-labelled-by="h3">\
                  <h3>Amount</h3>\
                  <p>$'+item.amount+'</p>\
                </div>\
              \
                '+metaList(item.signature, 'signature', 'signatures', 'Signatures', i, 'getTaxonomyName')+'\
              \
              </div>\
              <a class="view-detail" href="'+item.link+'" title="'+item.title.rendered+'">Explore Further</a>\
            </div>\
            <div class="exhibit-images">\
              <a class="view-detail" href="'+item.link+'">\
                <img src="placeholder.png" alt="Loading..." />\
              </a>\
            </div>\
          </div>\
        </div></li>'
  );

  // $( '.exhibit-browser .exhibit-thumbnails > ul' ).append('\
  // <li>\
  //   <a href="#exhibit-'+i+'" title="'+item.title.rendered+'">\
  //     <img src="placeholder.png" alt="Loading...">\
  //   </a>\
  // </li>');

  getImage(i, item.image[0][0], [
    // '.exhibit-browser .exhibit-thumbnails [href="#exhibit-'+i+'"]',
    '.exhibit-browser .exhibits #exhibit-'+i+' .exhibit-images'
  ]);

  return 0;
}

function getTaxonomyName(taxonomy, id, liSelector) {
  // /wp-json/wp/v2/signature/10
  $.ajax({
    url:'/wp-json/wp/v2/'+taxonomy+'/'+id,
    context: document.body
  }).done(function(data) {
    $(liSelector).html(data.name);
  }); // Ajax Image

}

function metaList(object, taxonomySlug, slug, label, parentIndex, itemCallback) {
  list = '';
  i = 0;
  object.forEach(
    function(listItem){
      liSelector = '.exhibit-browser .exhibits #exhibit-'+parentIndex+' .exhibit-meta .'+slug+' > ul > li:eq('+i+')';
      if(itemCallback){
        list += '<li>Loading...</li>';
        eval(itemCallback+"('"+taxonomySlug+"', '"+listItem+"', '"+liSelector+"');");
      } else {
        list += '<li>'+listItem+'</li>';
      }
      i++;
    }
  );
  if(list != '') {
    list = '\
    <div class="'+slug+'" aria-labelled-by="h3">\
      <h3>'+label+'</h3>\
      <ul>\
        '+list+'\
      </ul>\
    </div>'
  }
  return list;
}
function getImage(i, image, imgSelector) {
  $.ajax({
    url:'/wp-json/wp/v2/media/'+image,
    context: document.body
  }).done(function(data) {
    if($.isArray(imgSelector)) {
      imgSelector.forEach (
        function(item, index){
          setImages(data, i, item);
        }
      );
    } else {
      setImages(data, i, imgSelector);
    }
  }); // Ajax Image
  return 0;
}

function setImages(data, i, imgSelector) {
  if( !isUndefined(data.media_details.sizes['bond-listing-large'].source_url) || data.media_details.sizes['bond-listing-large'].source_url==='' ) {
    $( imgSelector ).find('img').attr('src',data.media_details.sizes['bond-listing-large'].source_url);
    if( !isUndefined(data.alt_text) || data.alt_text==='' ) {
      $( imgSelector ).find('img').attr('alt',data.alt_text);
    }
  }
  return 0;
}


$(document).foundation();
