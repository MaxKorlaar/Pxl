<?php

return array (
  'users' => 
  array (
    'title' => 'Gebruikers',
    'id' => 'ID',
    'username' => 'Gebruikersnaam',
    'last_login' => 'Laatste login',
    'edit_user' => 'Bewerk gebruiker',
    'disabled' => 'Gebruikersaccount uitgeschakeld',
    'administrator' => 'Administrator-account. Dit account heeft meer rechten',
    'no_users' => 'Geen gebruikers',
    'deleted' => 'Gebruiker verwijderd',
    'edit' => 
    array (
      'title' => 'Gebruiker bewerken: :name',
      'account_enabled' => 'Account ingeschakeld',
      'account_disabled' => 'Account uitgeschakeld',
      '2fa_enabled' => 'Tweeledige verificatiemethode ingeschakeld',
      '2fa_disabled' => 'Tweeledige verificatiemethode uitgeschakeld',
      '2fa_warning' => 'Waarschuwing: Het uitschakelen van tweeledige verificatie (tweestapsauthenticatie) zal de geheime sleutelcode van deze gebruiker
                wissen, waardoor de authenticatie-apps van deze gebruiker opnieuw ingesteld moeten worden indien de gebruiker wenst dit opnieuw in te schakelen.',
      '2fa_user' => 'Alleen de gebruiker zelf kan de tweeledige verificatiemethode inschakelen, omdat deze ingesteld moet worden doormiddel van
                authenticatie-apps die de gebruiker zelf bezit.',
      'delete' => 'Gebruiker verwijderen',
      'delete_confirmation' => 'Weet u zeker dat u dit account wil verwijderen van :site? Dit kan niet ongedaan worden gemaakt',
      'deletion_warning' => 'Waarschuwing: Het verwijderen van het account van :user kan niet ongedaan worden gemaakt',
      'updated' => 'Gebruikersinformatie bijgewerkt',
      'errors_occurred' => 'Er is een fout opgetreden.|Er zijn meerdere fouten opgetreden.',
      'new_password_help' => 'Laat dit leeg om het wachtwoord van de gebruiker niet te wijzigen.',
      'preferences' => 
      array (
        'embed_name' => 'Weergavenaam bij ingesloten afbeeldingen',
        'embed_name_url' => 'URL gekoppeld aan ingesloten naam',
        'twitter_username' => 'Twitter-gebruikersnaam',
        'default_url_exclude_gallery_extension' => 'Standaard URL direct naar afbeelding',
        'default_url_include_gallery_extension' => 'Standaard URL naar voorvertoning van afbeelding',
        'no_domains_available' => 'Geen domeinnamen beschikbaar',
        'default_domain' => 'Standaard domeinnaam',
        'updated' => 'Voorkeuren bijgewerkt',
        'title' => 'Voorkeuren',
        'embed_name_help' => 'In verschillende chatapplicaties zoals Discord en Slack kunnen afbeeldingen al worden weergegeven in de applicatie zelf. Hierbij komt ook de naam van de auteur te staan. Deze naam is aanpasbaar.',
        'embed_name_url_help' => 'Wanneer de naam van de auteur wordt weergegeven, is het mogelijk om deze te koppelen aan een aangepaste URL voor wanneer men op deze naam klikt.',
        'twitter_username_help' => 'Het is mogelijk om links naar afbeeldingen te delen op Twitter. Deze zullen dan worden weergegeven in Twitter-cards. Het is mogelijk om deze cards te linken aan je eigen Twitter-account.',
        'save' => 'Opslaan',
        'default_url_help' => 'Het is mogelijk om na het uploaden van een afbeelding direct een URL te krijgen naar de afbeelding zelf, of naar een voorvertoningspagina welke de afbeelding bevat.',
      ),
      'save' => 'Opslaan',
      'upload_token_reset' => 'De upload-token is gereset',
      'reset_upload_token' => 'Reset upload-token',
    ),
    'new' => 
    array (
      'created' => 'Nieuwe gebruiker aangemaakt: :user, met wachtwoord \':password\'',
      'title' => 'Nieuwe gebruiker',
      'create' => 'Aanmaken',
    ),
    'new_user' => 'Nieuwe gebruiker',
  ),
  'domains' => 
  array (
    'added' => 'Domein toegevoegd',
    'deleted' => 'Domein verwijderd',
    'title' => 'Domeinnamen',
    'id' => 'ID',
    'name' => 'Naam',
    'owner' => 'Eigenaar',
    'delete_domain' => 'Verwijder domein',
    'no_domains' => 'Geen domeinnamen',
    'errors_occurred' => 'Er is een fout opgetreden.|Er zijn meerdere fouten opgetreden.',
    'domain' => 'Domein',
    'protocol' => 
    array (
      'http' => 'http',
      'https' => 'https',
      'protocol' => 'Protocol',
    ),
    'create' => 'Toevoegen',
    'delete' => 'Verwijder domein',
    'deletion_warning' => 'Het verwijderen van een domein kan niet ongedaan worden gemaakt. Domeinnamen kunnen wel op ieder moment opnieuw toegevoegd worden.',
  ),
);
