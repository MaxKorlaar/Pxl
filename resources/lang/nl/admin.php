<?php

    return [
        'users'   =>
            [
                'title'         => 'Gebruikers',
                'id'            => 'ID',
                'username'      => 'Gebruikersnaam',
                'last_login'    => 'Laatste login',
                'edit_user'     => 'Bewerk gebruiker',
                'disabled'      => 'Gebruikersaccount uitgeschakeld',
                'administrator' => 'Administrator-account. Dit account heeft meer rechten',
                'no_users'      => 'Geen gebruikers',
                'deleted'       => 'Gebruiker verwijderd',
                'edit'          =>
                    [
                        'title'               => 'Gebruiker bewerken: :name',
                        'account_enabled'     => 'Account ingeschakeld',
                        'account_disabled'    => 'Account uitgeschakeld',
                        '2fa_enabled'         => 'Tweeledige verificatiemethode ingeschakeld',
                        '2fa_disabled'        => 'Tweeledige verificatiemethode uitgeschakeld',
                        '2fa_warning'         => 'Waarschuwing: Het uitschakelen van tweeledige verificatie (tweestapsauthenticatie) zal de geheime sleutelcode van deze gebruiker
                wissen, waardoor de authenticatie-apps van deze gebruiker opnieuw ingesteld moeten worden indien de gebruiker wenst dit opnieuw in te schakelen.',
                        '2fa_user'            => 'Alleen de gebruiker zelf kan de tweeledige verificatiemethode inschakelen, omdat deze ingesteld moet worden doormiddel van
                authenticatie-apps die de gebruiker zelf bezit.',
                        'delete'              => 'Gebruiker verwijderen',
                        'delete_confirmation' => 'Weet u zeker dat u dit account wil verwijderen van :site? Dit kan niet ongedaan worden gemaakt',
                        'deletion_warning'    => 'Waarschuwing: Het verwijderen van het account van :user kan niet ongedaan worden gemaakt',
                        'updated'             => 'Gebruikersinformatie bijgewerkt',
                        'errors_occurred'     => 'Er is een fout opgetreden.|Er zijn meerdere fouten opgetreden.',
                    ],
            ],
        'domains' =>
            [
                'added'           => 'Domein toegevoegd',
                'deleted'         => 'Domein verwijderd',
                'title'           => 'Domeinnamen',
                'id'              => 'ID',
                'name'            => 'Naam',
                'owner'           => 'Eigenaar',
                'delete_domain'   => 'Verwijder domein',
                'no_domains'      => 'Geen domeinnamen',
                'errors_occurred' => 'Er is een fout opgetreden.|Er zijn meerdere fouten opgetreden.',
                'domain'          => 'Domein',
                'protocol'        =>
                    [
                        'http'     => 'http',
                        'https'    => 'https',
                        'protocol' => 'Protocol',
                    ],
                'create'          => 'Toevoegen',
            ],
    ];
