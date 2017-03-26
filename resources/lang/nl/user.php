<?php

    return [
        'account' =>
            [
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
                'errors_occurred'           => 'Er is een fout opgetreden.|Er zijn meerdere fouten opgetreden.',
                '2fa'                       =>
                    [
                        'title'                => 'Tweeledige verificatie',
                        'off'                  => 'Uit',
                        'on'                   => 'Aan',
                        'disabled'             => 'Tweeledige verificatie (tweestaps authenticatie) is momenteel uitgeschakeld. Schakel dit in om uw account beter te beveiligen.
Het is hierdoor alleen mogelijk om in te loggen op uw account met uw inlognaam, wachtwoord en speciale code die om de 30 seconden verandert. Deze code wordt gegenereerd door een app op een van uw mobiele apparaten. Het is geheel kosteloos om dit in te schakelen en te gebruiken.',
                        'enabled'              => 'Tweeledige verificatie is momenteel ingeschakeld. Uw account is goed beveiligd.',
                        'enable'               => 'Inschakelen',
                        'disable'              => 'Uitschakelen',
                        'missing_key'          => 'Code ontbreekt',
                        'key'                  => 'Code',
                        'validate'             => 'Valideren',
                        'instructions'         => 'Scan de QR-code met een authenticatie-app op een mobiel apparaat om vervolgens de tijdelijke toegangscodes te verkrijgen.
Deze code verandert elke 30 seconden. Als je de QR-code hebt gescand, voer dan de gegenereerde code in en druk op valideren.
Bekende authenticatie-apps zijn OTP Auth voor iOS, Google Authenticator voor Android en Authenticator voor Windows Phone.',
                        'success'              => 'Tweeledige verificatie ingeschakeld',
                        'success_instructions' => 'Tweeledige verificatie is succesvol ingesteld voor uw account. U kan nu nog de QR-code scannen voor gebruik op meerdere apparaten of apps.',
                        'has_been_disabled'    => 'Tweeledige verificatie is nu uitgeschakeld',
                        'disable_warning'      => 'Om tweeledige verificatie opnieuw in te schakelen, zal u al uw apparaten opnieuw moeten instellen',
                        'missing_secret'       => 'Geheime sleutel mist in aanvraag',
                        'invalid_key'          => 'Code ongeldig',
                    ],
            ],
        'rank'    =>
            [
                'member' => 'Gebruiker',
                'admin'  => 'Administrator',
            ],
    ];
