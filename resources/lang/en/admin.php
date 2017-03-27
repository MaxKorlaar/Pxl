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
                    ],
                'id'            => 'ID',
                'last_login'    => 'Last login',
                'no_users'      => 'No users',
                'title'         => 'Users',
                'username'      => 'Username',
            ],
        'domains' =>
            [
                'added'           => 'Domain added',
                'create'          => 'Add',
                'delete_domain'   => 'Remove domain',
                'deleted'         => 'Domain removed',
                'domain'          => 'Domain',
                'errors_occurred' => 'An error has occurred. Please correct this error.|Errors have occurred, please correct these errors.',
                'id'              => 'ID',
                'name'            => 'Name',
                'no_domains'      => 'No domains',
                'owner'           => 'Owner',
                'protocol'        =>
                    [
                        'http'     => 'http',
                        'https'    => 'https',
                        'protocol' => 'Protocol',
                    ],
                'title'           => 'Domains',
            ],
    ];
