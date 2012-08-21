var sf = {
 
  url_for: function(route, params)
  {
    if (typeof sf.routes[route] === 'undefined')
      return false;
 
      var url = '<?php echo $new_str = preg_replace('/\/home$/', '', url_for2('home', array(), true)); ?>' + sf.routes[route].pattern;
 
    if ($.isArray(params) || $.isPlainObject(params))
    {
      $.each(params, function(i, v)
      {
        url = url.replace(':'+i, encodeURIComponent(v));
      });
    }
 
    return url;
  },
 
  routes: <?php echo json_encode($sf_data->getRaw('routes')) ?>
};