<?php

    return [
        'setup' =>
            [
                'sharex' =>
                    [
                        'heading'         => 'Setting up ShareX',
                        'log_in'          => 'Log in to view the custom uploader configuration for ShareX.',
                        'instructions'    => 'Support for the application ShareX (Windows only) is directly built into Pxl. It is a very advanced and free application which works great when used together with Pxl. It is easy to set this application up to use Pxl.',
                        'custom_uploader' => 'In order to set up ShareX in combination with Pxl, the following instructions will have to be followed:<ol>
<li>Open ShareX and choose destinations on the left hand side of the window</li>
<li>Choose destination settings</li>
<li> Scroll down in the list on the left and select \'Custom uploaders\'</li>
<li>Click the \'Import\' button and select \'From URL...\'</li>
<li>Paste the url from beneath these instructions and click on OK</li>
<li>Check and see if the selected image uploader is \':uploader_name\' and close the window</li>
<li>In the main window of ShareX select destinations on the left hand side of the window, then select image uploader and click on \'Custom image uploader\'</li></ol>',
                    ],
                'title'  => 'Setting up',
                'curl'   =>
                    [
                        'heading'      => 'Using cURL',
                        'instructions' => 'It is possible to upload files using cURL in your terminal on Mac and Linux systems. For this it is required to use the parameters \'user\', \'upload-token\' and \'file\', which are explained under the heading \'Custom uploader\'. It is also important to use the \'Accept: application/json\' header, because otherwise you will be redirected to the home page if an error occurs.',
                    ],
                'data'   =>
                    [
                        'heading'      => 'Custom uploader',
                        'instructions' => 'To use a custom uploader, the following data will be required in your request:',
                        'file'         => 'This is the image that you are uploading',
                        'log_in'       => 'Log in to view this',
                        'method'       => 'HTTP method',
                        'name'         => 'This field is not required. If this field is present, its value will be used for naming the image instead of the original filename. The name of the image can be seen in the gallery and when sharing the preview page of the image.',
                        'target'       => 'Target',
                        'target_help'  => 'Use the header \'Accept: application/json\' to retrieve all errors in JSON. If it is not possible to set headers, you may append \'?return=json\' to the url. If it is not desired to receive the link to the image in a JSON response, add \'?return=json_on_error\' to receive only a link to the image on success.',
                    ],
            ],
    ];
