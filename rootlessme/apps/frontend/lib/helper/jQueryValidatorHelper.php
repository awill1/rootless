<?php
// From http://jnotes.jonasfischer.net/2010/03/smyfony-helper-for-jquerys-excellen-form-validation-plugin/

function jquery_validate_form(sfForm $form, $attributes = array(), $rules = array())
{
  $attrs = array_keys($attributes);
  $form_name = $form->getName();
  if (array_key_exists('id', $attributes)) {
  	$form_name = $attributes['id'];
  }

  $widgetSchema = $form->getWidgetSchema();
	foreach ($form->getValidatorSchema()->getFields() as $field_name => $field)
	{
		$fieldName = $widgetSchema->generateName($field_name);
		$rules[$fieldName] = array('options' => $field->getOptions(), 'messages' => $field->getMessages());
		switch(get_class($field)) {
      case 'sfValidatorEmail':
      	$rules[$fieldName]['options']['email'] = true;
		}	  
	}

  $jsRules = '';
  $jsMessages = '';
	foreach ($rules as $fieldName => $rule) {
		$options = $rule['options'];
		$messages = $rule['messages'];
	  
		$jsRules .= "\t'$fieldName': { ";
    if(!empty($options['required'])) { $jsRules .= 'required: true, '; }
	  if(!empty($options['email'])) { $jsRules .= 'email: true, '; }
	  $jsRules .= "}, \n";

    $jsMessages .= "\t$field_name: { ";
    if(!empty($messages['required'])) { $jsMessages .= "required: '{$messages['required']}', "; }
    if(!empty($messages['invalid'])) {$jsMessages .= "\t'$field_name': '{$messages['invalid']}', \n"; }
	  if(!empty($messages['max_length'])) { $jsMessages .= "maxlength: 'Please enter at most {$options['max_length']} characters.', "; }
    if(!empty($messages['min_length'])) { $jsMessages .= "minlength: 'Please enter at least {$options['min_length']} characters.', "; }
    $jsMessages .= "}, \n";
	}
	
	// construct the validator
	$errorPlacement = ((in_array("error_placement", $attrs)) ? ", errorPlacement: function(error, element) { ".$attributes['error_placement'] ." } " : "  ");
	$errorElement   = ", errorElement: ".((in_array("error_element", $attrs)) ? $attributes['error_element'] : " 'label'");
  $validator =
<<<EOF
<script type="text/javascript">
	$().ready(function() {
		$("#{$form_name}").validate({
		  rules: {
		    {$jsRules} 
		  },
		  messages: {
		    {$jsMessages} 
		  }
		  {$errorPlacement}
		  {$errorElement}		  
		});
	});
</script>
EOF;

  return $validator;
}


