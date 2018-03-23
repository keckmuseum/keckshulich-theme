function isUndefined(value){
    // var undefined = void(0);
    return typeof value == "undefined";
}

$(document).ready(
  function() {
    $(document).foundation();

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
        $.removeCookie('current-theme', { path: '/' });
        rebuildExhibitGrid(
          false,
          true
        );
        returnFocus=$(this);
      }
    );
    $('.exhibits-filters a[href="#clear"]').click(
      function(e) {
        e.preventDefault();
        resetFilters();
      }
    );

    $(document).on('click','.exhibit-images .transcription-link a',
      function(e){
        e.preventDefault();
        target = $(this).attr('href');
        if($(target).hasClass('show')){
          $(target).removeClass('show');
          $(this).parent().parent().find('img').show();
          $(this).html('Transcription');
        } else {
          $(target).addClass('show');
          $(this).parent().parent().find('img').hide();
          $(this).html('Image');
        }
      }
    );


    $('.exhibit-themes a').click(
      function(e) {
        e.preventDefault();
        $.removeCookie('filter-theme', { path: '/' });
        $.removeCookie('filter-date-range', { path: '/' });
        $.removeCookie('filter-region', { path: '/' });
        rebuildExhibitGrid(
          $(this).data('theme-id'),
          true
        );
        $.cookie('current-theme',$(this).data('theme-id'),{ path: '/' });
        returnFocus=$(this);
      }
    );

    // $('a[href="#exhibit-browser"]').on('click',
    //   function(e){
    //     e.preventDefault();
    //     exhibitBrowserOverlay();
    //     //exhibits.flipster('index');
    //   }
    // );



    $('.exhibit-browser').on('click',
      function(e){
        console.log(e.target);
        if($(e.target).parents('.swiper-container').length === 0) {
          exhibitBrowserOverlay('close');
          $(returnFocus).focus();
        }
      }
    );
    $('.exhibit-browser a[href="#back-to-library"]').on('keydown',
      function(e){
          if(e.which == 13){//Enter key pressed
              e.preventDefault();
              $('.exhibit-browser').click();//Trigger close dialog click event
          }
      }
    );
    $('.exhibit-browser, .exhibit-browser *').on('keydown',
      function(e){
          if(e.which == 27){//Enter key pressed
              e.preventDefault();
              $('.exhibit-browser').click();//Trigger close dialog click event
          }
      }
    );
    // $('.exhibit-browser .swiper-slide h2').on('keydown',
    //   function(e){
    //     console.log('keydown');
    //       if(e.which == 13){//Enter key pressed
    //           $(this).parent().find('.view-detail').click();//Trigger search button click event
    //       }
    //   }
    // );

    // $('.exhibit-browser .back-to-listing').attr('href','http://google.com/').click(
    //   function(e){
    //     e.preventDefault();
    //     exhibitBrowserOverlay('close');
    //   }
    // );

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

    $(document).on('click', '.view-detail',
      function(e){
        e.preventDefault();
        console.log($(this).parents('li').index());
        $.cookie('slider-position',$(this).parents('li').index(),{ path: '/' });
        window.location.href = $(this).attr('href');
      });

      $('.back-to-listing').click(
        function(e) {
          e.preventDefault();
          $.cookie('back-to-listing',1,{ path: '/' });
          window.location.href='/bonds/';
        }
      );

      var pathname = window.location.pathname;
      var backToListing = $.cookie('back-to-listing');
      var sliderPosition = $.cookie('slider-position');
      var currentTheme = $.cookie('current-theme');

      var filterTheme = $.cookie('filter-theme');
      var filterDateRange = $.cookie('filter-date-range');
      var filterRegion = $.cookie('filter-region');

      if(typeof pathname != "undefined"
        && pathname === '/bonds/'
        && typeof backToListing != "undefined"
        && backToListing === '1'
        && typeof sliderPosition != "undefined"
      ) {
        $.removeCookie('back-to-listing', { path: '/' });
        $.removeCookie('slider-position', { path: '/' });
        if(typeof currentTheme != "undefined") {
          rebuildExhibitGrid(
            currentTheme,
            true,
            sliderPosition
          );
        } else if(typeof filterTheme != "undefined"
          && typeof filterDateRange != "undefined"
          && typeof filterRegion != "undefined") {
            $('.exhibits-filters select#theme option[name="'+filterTheme+'"]').prop('selected', true);
            $('.exhibits-filters select#date-range option[name="'+filterDateRange+'"]').prop('selected', true);
            $('.exhibits-filters select#region option[name="'+filterRegion+'"]').prop('selected', true);

            rebuildExhibitGrid(
              false,
              true,
              sliderPosition
            );
        }
      }


});

function exhibitBrowserInit(sliderPosition=false) {
  if(swiper===false) {
    swiper = new Swiper('.swiper-container', swiperArgs );
    console.log('init at '+sliderPosition);
  } else {
    swiper = new Swiper('.swiper-container', swiperArgs );

    // swiper.update();
    // swiperDelay = window.setTimeout(function(){
    //   swiper.update();console.log('reindex');
    // }, 5000);
  }
  if(sliderPosition) {
    swiper.slideTo(sliderPosition);
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
      $('#exhibit-browser').focus();
      // console.log('?');
  } else {
    console.log('open');
    $('.exhibit-browser-overlay').fadeIn('fast');

    $('.exhibit-browser').show();
    $('.exhibit-browser').css('opacity',0.001);
  }
}
function rebuildExhibitGrid(themeId=false,openCarousel=false,sliderPosition=false) {
  if(themeId) {
    argumentString = '?per_page=100&theme=' + themeId;
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
          if(sliderPosition===false) {
            exhibitBrowserInit();
            exhibitBrowserOverlay('open');
          } else {
            exhibitBrowserInit(sliderPosition);
            exhibitBrowserOverlay('open');
          }

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
      $.cookie('filter-'+name,value,{ path: '/' });
      if(value>0){
        filterArguments.push( Array(
          name,
          value
        ) );
      }
    }
  );

  var argumentString = '?per_page=100&';
  filterArguments.forEach( function(argument) {
    if(argumentString != '?per_page=100&') {
      argumentString += '&';
    }
    argumentString += argument[0]+'='+argument[1];
  });

  if(argumentString === '?per_page=100&') {
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
      '<li tabindex="0" class="swiper-slide"><div class="query-error"><p>No results. Try changing the filter options.</p></div></li>'
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
  // if(i==0){
  //   expanded='true'
  // }
  // else{
  //   expanded='false'
  // }
  $( '.exhibit-browser .exhibits > ul' ).append('\
    <li tabindex="0" id="exhibit-'+i+'" class="swiper-slide" aria-labelledby="'+item.slug+'-title">\
        <div class="exhibit">\
          <div class="inner">\
            <h2 id="'+item.slug+'-title">'+item.title.rendered+'</h2>\
            <div class="exhibit-meta">\
              <div>\
                <div tabindex="0" class="date-issued" aria-labelled-by="'+item.slug+'-date-title">\
                  <h3 id="'+item.slug+'-title">Date</h3>\
                  <p>'+item.date+'</p>\
                </div>\
              \
                <div tabindex="0" class="location" aria-labelled-by="'+item.slug+'-location-title">\
                  <h3 id="'+item.slug+'-location-title">Location</h3>\
                  <p>'+item.location+'</p>\
                </div>\
              \
                <div tabindex="0" class="amount" aria-labelled-by="'+item.slug+'-amount-title">\
                  <h3 id="'+item.slug+'-amount-title">Amount</h3>\
                  <p>$'+item.amount+'</p>\
                </div>\
              \
                '+metaList(item.signature, 'signature', 'signatures', 'Signatures', i, 'getTaxonomyName')+'\
              \
              </div>\
              <a aria-label="More details about this bond" tabindex="0" class="view-detail" href="'+item.link+'" title="'+item.title.rendered+'">Explore Further</a>\
            </div>\
            <div class="exhibit-images">\
                <div tabindex="0" aria-labelled-by="'+item.slug+'-bond-image">\
                  <h3 id="'+item.slug+'-bond-image-title">Bond Image</h3>\
                  <img src="placeholder.png" alt="Loading..." aria-labelled-by="'+item.slug+'-bond-image-title" />\
                </div>\
                <p aria-hidden="true" class="transcription-link">\
                  <a tabindex="-1" href="#'+item.slug+'-transcription">Transcription</a>\
                </p>\
                <div class="transcription" id="'+item.slug+'-transcription">\
                  <h3 id="'+item.slug+'-transcription-title">Bond Transcription</h3>\
                  <p tabindex="0" aria-labelledby="'+item.slug+'-transcription-title">'+item.transcription+'</p>\
                </div>\
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
  console.log(item);
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
    <div tabindex="0" class="'+slug+'" aria-labelled-by="'+slug+'-signatures-title">\
      <h3 id="'+slug+'-signatures-title">'+label+'</h3>\
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

function setupInterchange(data, imgSelector, interchangeSize, wpimageSize) {
  if( !isUndefined(data.media_details.sizes[wpimageSize].source_url) || data.media_details.sizes[wpimageSize].source_url==='' ) {
    rules='';
    if(!isUndefined(interchange)){
      rules=interchange.rules+',';
    }

    if($.isArray(imgSelector)) {
      imgSelector.forEach (
        function(item, index){
          var interchange = new Foundation.Interchange($(item).find('img'), {
            rules: [
              rules+"["+data.media_details.sizes[wpimageSize].source_url+", "+interchangeSize+"]"
            ]
           });
         }
        );
      }
      else {
        var interchange = new Foundation.Interchange($(imgSelector).find('img'), {
          rules: [
            rules+"["+data.media_details.sizes[wpimageSize].source_url+", "+interchangeSize+"]"
          ]
         });
         console.log($(imgSelector).find('img'));
         console.log( interchange.rules) ;
      }
    }
}

function setImages(data, i, imgSelector) {
  if( !isUndefined(data.media_details.sizes['s'].source_url) || data.media_details.sizes['s'].source_url==='' ) {
    $( imgSelector ).find('img').attr('src',data.media_details.sizes['s'].source_url);
  }
  setupInterchange(data, imgSelector, 'small', 'xs');
  setupInterchange(data, imgSelector, 'medium', 's');


  if( !isUndefined(data.alt_text) || data.alt_text==='' ) {
    $( imgSelector ).find('img').attr('alt',data.alt_text);
  }
  return 0;
}
