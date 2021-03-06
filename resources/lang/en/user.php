<?php

    return [
        'account'     =>
            [
                'title'                     => 'My account',
                'current_password_invalid'  => 'Your current password is invalid.',
                'updated'                   => 'Account updated.',
                'username'                  => 'Username',
                'email'                     => 'Email address',
                'current_password'          => 'Current password',
                'new_password'              => 'New password',
                'new_password_confirmation' => 'Confirm new password',
                'save'                      => 'Save',
                'delete'                    => 'Delete your account',
                'delete_confirmation'       => 'Are you sure you want to delete your account from :site? This cannot be undone.',
                'deletion_warning'          => 'Warning: This action cannot be undone! All data associated with your account will be permanently removed from this website.',
                'type'                      => 'Account type',
                'created_at'                => 'Account created on',
                'last_login'                => 'Last login',
                'last_login_from'           => ':timestamp from :ip',
                '2fa'                       =>
                    [
                        'disable'              => 'Disable',
                        'disable_warning'      => 'To re-enable two-factor-authentication, you will have to set up all of your authentication apps again',
                        'disabled'             => 'Two-factor-authentication is currently disabled. Enable this to better secure access to your account. Using this it will be only possible to log in to your account using your login credentials and a special code that changes every 30 seconds. This code is generated by an application on a mobile device. This can be used free of charge.',
                        'enable'               => 'Enable',
                        'enabled'              => 'Two-factor-authentication is currently enabled. Your account is secured sufficiently.',
                        'has_been_disabled'    => 'Two-factor-authentication has been disabled',
                        'instructions'         => 'Scan the QR-code using an authentication application on a mobile device in order to receive the temporary access code. This code changes every 30 seconds. When you have scanned the QR-code, enter the generated code and press validate.
Well known authentication apps are OTP Auth for iOS, Google Authenticator for Android and Authenticator for Windows Phone.',
                        'invalid_key'          => 'Invalid code',
                        'key'                  => 'Code',
                        'missing_key'          => 'Code missing',
                        'missing_secret'       => 'Secret token is missing in request',
                        'off'                  => 'Off',
                        'on'                   => 'On',
                        'success'              => 'Two-factor-authentication has been enabled',
                        'success_instructions' => 'Two-factor-authentication has successfully enabled for your account. You may scan the QR-code if you use multiple authentication applications or devices.',
                        'title'                => 'Two-factor-authentication',
                        'validate'             => 'Validate',
                    ],
                'errors_occurred'           => 'An error has occurred. Please correct this error.|Errors have occurred, please correct these errors.',
                'reset_upload_token'        => 'Reset upload token',
                'upload_token'              => 'Upload token',
                'upload_token_reset'        => 'The upload token has been reset',
                'upload_token_warning'      => 'This upload token is linked to your account and should be considered secret. Do not share this token with anyone you would not share your password with! This code is required and serves as authentication when uploading pictures via external applications or when not logged into the site.',
                'images_on_account'         => 'Images on this account',
                'images'                    => ':amount images',
            ],
        'rank'        =>
            [
                'member' => 'User',
                'admin'  => 'Administrator',
            ],
        'preferences' =>
            [
                'updated'                               => 'Preferences updated',
                'embed_name_help'                       => 'Various chat applications can preview linked images in the application itself. This also includes the name of the author in the embedded preview. This name can be changed.',
                'embed_name_url'                        => 'URL linked to embedded name',
                'embed_name_url_help'                   => 'When the name of the author is shown, it is possible to link this to a custom url, which will be opened when someone clicks on the name.',
                'save'                                  => 'Save',
                'title'                                 => 'Preferences',
                'twitter_username'                      => 'Twitter username',
                'twitter_username_help'                 => 'It is possible to share links to images on Twitter. These images will be previewed in Twitter cards, these cards can be linked to your own Twitter account.',
                'default_url_exclude_gallery_extension' => 'Direct link to image by default',
                'default_url_help'                      => 'It is possible to get the URL to an image preview page after uploading, or directly to the image itself.',
                'default_url_include_gallery_extension' => 'Link to image preview page by default',
                'embed_name'                            => 'Display name added to embedded images',
                'no_domains_available'                  => 'No domains available',
                'default_domain'                        => 'Default domain',
                'domain_not_found'                      => 'This domain cannot be found',
                'default_deletion_time'                 =>
                    [
                        'days'    => 'Days',
                        'help'    => 'It is possible to automatically delete uploaded images after a certain amount of time since they have been uploaded. If you set all fields to 0, this function will be turned off. It is possible to change the automatic deletion time per image afterwards.',
                        'hours'   => 'Hours',
                        'minutes' => 'Minutes',
                        'months'  => 'Months',
                        'name'    => 'Default deletion time',
                        'years'   => 'Years',
                    ],
            ],
    ];
