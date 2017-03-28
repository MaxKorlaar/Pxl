<?php

return array (
  'setup' => 
  array (
    'sharex' => 
    array (
      'heading' => 'Setting up ShareX',
    ),
    'title' => 'Setting up',
    'curl' => 
    array (
      'heading' => 'Using cURL',
      'instructions' => 'It is possible to upload files using cURL in your terminal on Mac and Linux systems. For this it is required to use the parameters \'user\', \'upload-token\' and \'file\', which are explained under the heading \'Custom uploader\'. It is also important to use the \'Accept: application/json\' header, because otherwise you will be redirected to the home page if an error occurs.',
    ),
    'data' => 
    array (
      'heading' => 'Custom uploader',
      'instructions' => 'To use a custom uploader, the following data will be required in your request:',
      'file' => 'This is the image that you are uploading',
      'log_in' => 'Log in to view this',
      'method' => 'HTTP method',
      'name' => 'This field is not required. If this field is present, its value will be used for naming the image instead of the original filename. The name of the image can be seen in the gallery and when sharing the preview page of the image.',
      'target' => 'Target',
      'target_help' => 'Use the header \'Accept: application/json\' to retrieve all errors in JSON. If it is not possible to set headers, you may append \'?return=json\' to the url. If it is not desired to receive the link to the image in a JSON response, add \'?return=json_on_errors\' to receive only a link to the image on success.',
    ),
  ),
);
