/*
 * Constructor for radio form styling
 * jQuery is a dependency.
 * @param <jQuery Object> formElem Form being styled
 */

function radioFormStyle(formElem) {
  var elemArray = formElem.find('li').has('input[type="radio"]');
  var count = elemArray.length;
  
  for (var i = 0; i < count; i++) {
    $(elemArray[i]).css({
      'float':'left'
    });
    $(elemArray[i]).find('input').hide();
    $(elemArray[i]).find('label').css({
      'cursor': 'pointer',
      'float': 'left'
        
    });
  }
  
  $('ul.radio_list').find('label').click(function() {
    if($(this).parent().siblings().hasClass('selectedLabel')) {
      $(this).parent().siblings().removeClass('selectedLabel');
    }
      $(this).parent().addClass('selectedLabel');
      
  });
}


