const $ = window.jQuery;

$(document).on('click', '.post-resource .more-btn', function() {
  var $this = $(this);
  var is_thumbnail = $this.parents('.post-resource').find('.modal-html').find('.resource-thumbnail').length ? true : false;
  var classname = is_thumbnail ? '' : 'mfp-close-black';

  $.magnificPopup.open({
    items: {
      type: 'inline',
      closeBtnInside: true,
      mainClass: 'mfp-fade',
      midClick: true,
      src: '<div id="resource-modal" class="' + classname + '">' + $this.parents('.post-resource').find('.modal-html').html() + '</div>'
    }
  });
});

$(document).ready(function() {
  if ( $('.featured-posts').length ) {
    $('.featured-posts').slick({
      centerMode: false,
      dots: false,
      arrows: true,
      infinite: false,
      slidesToShow: 2.7,
      slidesToScroll: 1,
      prevArrow: $('.slider-arrows .prev'),
      nextArrow: $('.slider-arrows .next'),
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }
  
  // View options
  if ( $('.view-options').length ) {
    $('.view-options a').on('click', function(e) {
      e.preventDefault();
      
      var $this = $(this);
      var view_mode = $this.data('view');
      
      if ($this.hasClass('active')) {
        return;
      }
      
      $('.view-options a.active').removeClass('active');
      $this.addClass('active');
      
      if (view_mode == 'card') {  
        $('.resources .post-resource').removeClass('list-view').addClass('card-view');
        $('.resources .resource').removeClass('col-12').addClass('col-lg-4 col-md-6');
      } else {
        $('.resources .post-resource').removeClass('card-view').addClass('list-view');
        $('.resources .resource').removeClass('col-lg-4 col-md-6').addClass('col-12');
      }
      
    });
  }
  
  // Trigger ajax complete 
  // Reload the page to display the results count after ajax complete
  $(document).on('sf:ajaxfinish', '.searchandfilter', function(evt) {
    $('#search-results-count').html($('#ajax-found-posts').val());
    
    if ( $('.view-options').length ) {
      var view_mode = $('.view-options a.active').data('view');
      
      console.log(view_mode);
      
      if (view_mode == 'card') {  
        $('.resources .post-resource').removeClass('list-view').addClass('card-view');
        $('.resources .resource').removeClass('col-12').addClass('col-lg-4 col-md-6');
      } else {
        $('.resources .post-resource').removeClass('card-view').addClass('list-view');
        $('.resources .resource').removeClass('col-lg-4 col-md-6').addClass('col-12');
      }
    }
    
  });
  
  // Resource Load More Button
  // if ( $('.resources').length ) {
  //   let currentPage = 1;
  //   $('#resource_load_more').on('click', function(e) {
  //     e.preventDefault();
      
  //     currentPage++;
      
  //     console.log('loading more resources in page' + currentPage);
      
  //     $.ajax({
  //       type: 'POST',
  //       url: ajaxurl,
  //       dataType: 'json',
  //       data: {
  //         action: 'resource_load_more',
  //         paged: currentPage,
  //       },
  //       success: function (res) {
  //         if(currentPage >= res.max) {
  //           $('#resource_load_more').hide();
  //         }
  //         $('.resources').append(res.html);
  //       }
  //     });
  //   });
  // }
});