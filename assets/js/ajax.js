jQuery(document).ready(function($) {

  $.ajax({
    url: RzAjax.ajax_url,
    method: 'POST',
    data: {
      action: 'rz_ajax_get_posts',
      per_page: 3,
      _ajax_nonce: RzAjax.ajax_nonce,
    },
    success: function(response) {
      if ( Array.isArray( response ) ) {
        var html = '<u>';

        response.forEach( function(item) {
          html += '<li>' + item.post_title + '</li>';

        });

        html += '</u>';

        $('.rz-wp-plugin-ajax').append(html);

      }
      
    }

  });
  


} );