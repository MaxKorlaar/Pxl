<?php

    return [
        'users'   =>
            [
                'administrator' => 'Administrator account. This account has more privileges',
                'deleted'       => 'User deleted',
                'disabled'      => 'User account disabled',
                'edit_user'     => 'Edit user',
                'edit'          =>
                    [
                        '2fa_disabled'        => 'Two-factor-authentication disabled',
                        '2fa_enabled'         => 'Two-factor-authentication enabled',
                        '2fa_user'            => 'Only the user can enable two-factor-authentication, because this has to be set up using authentication apps owned by the user.',
                        '2fa_warning'         => 'Warning: Disabling two-factor-authentication will clear the secret token for this user. The user will have to set up their authentication apps again if they wish to re-enable two-factor-authentication.',
                        'account_disabled'    => 'Account disabled',
                        'account_enabled'     => 'Account enabled',
                        'delete'              => 'Delete user',
                        'delete_confirmation' => 'Are you certain you want to delete this account from :site? This cannot be undone',
                        'deletion_warning'    => 'Warning: The deletion of :user\'s account cannot be undone',
                        'errors_occurred'     => 'An error has occurred. Please correct this error.|Errors have occurred, please correct these errors.',
                        'title'               => 'Edit user: :name',
                        'updated'             => 'User information updated',
                        'new_password_help'   => 'Leave this empty in order to not change the user\'s password.',
                        'save'                => 'Save',
                        'preferences'         =>
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
                        'reset_upload_token'  => 'Reset upload token',
                        'upload_token_reset'  => 'The upload token has been reset',
                    ],
                'id'            => 'ID',
                'last_login'    => 'Last login',
                'no_users'      => 'No users',
                'title'         => 'Users',
                'username'      => 'Username',
                'new_user'      => 'New user',
                'new'           =>
                    [
                        'create'  => 'Create',
                        'created' => 'New user added: :user, with password \':password\'',
                        'title'   => 'New user',
                    ],
            ],
        'domains' =>
            [
                'added'            => 'Domain added',
                'create'           => 'Add',
                'delete_domain'    => 'Remove domain',
                'deleted'          => 'Domain removed',
                'domain'           => 'Domain',
                'errors_occurred'  => 'An error has occurred. Please correct this error.|Errors have occurred, please correct these errors.',
                'id'               => 'ID',
                'name'             => 'Name',
                'no_domains'       => 'No domains',
                'owner'            => 'Owner',
                'protocol'         =>
                    [
                        'http'     => 'http',
                        'https'    => 'https',
                        'protocol' => 'Protocol',
                    ],
                'title'            => 'Domains',
                'delete'           => 'Remove domain',
                'deletion_warning' => 'The removal of a domain cannot be undone. Domains may be added again at any time.',
            ],
    ];
