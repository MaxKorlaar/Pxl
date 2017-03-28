<?php

return array (
  'setup' => 
  array (
    'title' => 'Instellen',
    'sharex' => 
    array (
      'heading' => 'ShareX instellen',
    ),
    'curl' => 
    array (
      'heading' => 'cURL gebruiken',
      'instructions' => 'Het is mogelijk om via cURL in de opdrachtprompt (ook wel terminal genoemd) bestanden te uploaden via cURL op Mac en Linux-systemen. Hierbij is het vereist om de parameters \'user\', \'upload-token\' en \'file\' te gebruiken, welke onder \'Aangepaste uploader\' uitgelegd staan. Ook is het belangrijk om de header \'Accept: application/json\' te sturen, zodat je een antwoord krijgt in JSON en niet de hoofdpagina als er zich een fout voordoet.',
    ),
    'data' => 
    array (
      'heading' => 'Aangepaste uploader',
      'instructions' => 'Om een aangepaste uploader te gebruiken, zijn de volgende gegevens vereist in je aanvraag:',
      'target' => 'Doel (target)',
      'target_help' => 'Gebruik de header \'Accept: application/json\' om aan te geven dat alle foutmeldingen in JSON weergegeven moeten worden. Indien het niet mogelijk is om headers in te stellen, is het mogelijk om \'?return=json\' aan het einde van de url toe te voegen. Als het gewenst is om alleen de url naar de afbeelding zelf terug te krijgen als resultaat, zonder JSON, dient \'?return=json_on_errors\' toegevoegd te worden aan de url.',
      'method' => 'HTTP-methode',
      'log_in' => 'Log in om dit te zien',
      'file' => 'Dit is de afbeelding die je wil uploaden',
      'name' => 'Dit veld is niet vereist. Indien dit veld aanwezig is, zal de waarde hiervan worden gebruikt als de originele bestandsnaam van de afbeelding. Deze waarde is te zien in de galerij en wanneer je de voorbeeldpagina-link deelt.',
    ),
  ),
);
