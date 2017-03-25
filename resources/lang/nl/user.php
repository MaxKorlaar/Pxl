<?php

    return [
        'account' => [
            'title'                     => 'Mijn account',
            'current_password_invalid'  => 'Het huidige wachtwoord is incorrect.',
            'updated'                   => 'Accountinformatie bijgewerkt.',
            'username'                  => 'Gebruikersnaam',
            'email'                     => 'Email-adres',
            'current_password'          => 'Huidige wachtwoord',
            'new_password'              => 'Nieuw wachtwoord',
            'new_password_confirmation' => 'Bevestig nieuw wachtwoord',
            'save'                      => 'Opslaan',
            'delete'                    => 'Verwijder uw account',
            'delete_confirmation'       => 'Weet u zeker dat u uw account wil verwijderen van :site? Dit kan niet ongedaan worden gemaakt.',
            'deletion_warning'          => 'Waarschuwing: Het verwijderen van uw account kan NIET ongedaan worden gemaakt. Andere informatie
            op de website blijft intact, maar het zal onmogelijk zijn om nog dingen aan te passen zonder werkend account. Verwijder uw
            account NIET tenzij er nog andere accounts op het platform zijn.',
            'type'                      => 'Accounttype',
            'created_at'                => 'Account aangemaakt op',
            'last_login'                => 'Laatste login',
            'last_login_from'           => ':timestamp vanaf :ip',
            '2fa'                       => [
                'title'    => 'Tweeledige verificatie',
                'off'      => 'Uit',
                'on'       => 'Aan',
                'disabled' => 'Tweeledige verificatie (tweestapsauthenticatie) is momenteel uitgeschakeld. Schakel dit in om uw account beter te beveiligen.
                Het is hierdoor alleen mogelijk om in te loggen op uw account met uw inlognaam, wachtwoord en speciale code die om de 30 seconden verandert. Deze code
                wordt gegenereerd door een app op een van uw mobiele apparaten. Het is geheel kostenloos om dit in te schakelen en te gebruiken.',
                'enabled'  => 'Tweeledige verificatie is momenteel ingeschakeld. Uw account is goed beveiligd.',
                'enable'   => 'Inschakelen',
                'disable'  => 'Uitschakelen'
            ]
        ],
        'rank'    => [
            'member' => 'Gebruiker',
            'admin'  => 'Administrator'
        ]
    ];