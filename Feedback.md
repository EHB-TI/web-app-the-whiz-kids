
# Feedback

- [Legende](#Legende)
- [Acceptance criteria](#Acceptance-criteria)
- [User Management](#User-Management)
- [Sensitive data exposure](#Sensitive-data-exposure)
- [HTTPS](#Https)
- [OWASP Vulnerability check Using SonarQube](#OWASP-Vulnerability-check-Using-SonarQube)
- [Headers](#headers)
- [GDPR](#GDPR)

&nbsp; 

&nbsp;

&nbsp;

## Legende
| Symbool | Betekenis     |
| :-----: | ------------- |
| :thumbsup:| Niet geslaagd |
| :-1: | Geslaagd      |
|   ---   | ---           |
|   :red_circle:    | Critical      |
|   :large_orange_diamond:    | High          |
|   :large_blue_circle:    | Medium        |
|   :white_circle:     | Low           |

&nbsp;



## Acceptance Criteria


| Passed | Criteria                                                                              | Notes                                | Severity |
| :----: | ------------------------------------------------------------------------------------- | ------------------------------------ | :------: |
|   :thumbsup:   | Als een bezoeker kan ik kan via het front-end alle zichtbare evenementen overzichtelijk zien en in detail. Het is niet mogelijk om aan het editor panel te geraken.| We krijgen geen bevestigingsmail toe |      |
|   :thumbsup:  | Als een editor kan ik kan ik enkel de evenementen zien in het editor panel van de groep waaraan ik ben toegevoegd. Ik kan nieuwe evenementen aanmaken en de al bestaande events van mijn groep bewerken.| Zelfde als bij teacher               |      |
|   :thumbsup:   | Als een viewer kan ik enkel de evenementen zien in het editor panel van de groep waaraan ik ben toegevoegd. Ik kan deze evenementen niet bewerken, mijn account kan gezien worden als disabled.                             |                                      |          |
|   :-1:    |Als een (website) admin kan ik alle evenementen, gebruikers en de FAQ beheren via het admin panel (uitbreiding op het editor panel). Het is mogelijk als website admin om nieuwe events, users en FAQ toe te voegen, updaten en verwijderen. Het is wel niet mogelijk om als website admin een user te elevaten naar admin, hiervoor dient een nieuw account aangemaakt te worden. | Als admin kan ik iedereen elevaten en deleten ook super_admin                                     |   :red_circle:       |
|   ---   |Als een Combell beheerder kan ik de backend van de website en de database beheren. Zo kan ik de ook aan de logs van de website om een overzicht te kunnen houden over mogelijke gevaren en slechte intenties.| Dit konden we niet testen         | 
&nbsp;

&nbsp;

                    

## User Management


| Issue                                                                                                                                         | Severity |
| --------------------------------------------------------------------------------------------------------------------------------------------- | :------: |
 | Paswoord 16 karakters is niet gebruiksvriendelijk, het aanvaardt blijkbaar niet alle tekens, enkel '$' en het paswoord dat werd doorgestuurd voldoet zelf niet aan de 'rules'| :white_circle: 
 |Ik kan zelf geen account aanmaken| :white_circle: 
 |Na twintig mislukte login pogingen kon ik nog altijd gewoon inloggen met Admin account. Er is geen sprake van een timeout  =>Brute force attack wel mogelijk| :red_circle:   
 |Ik kan mijn passwoord niet aanpassen|:red_circle: 
 |Ik kan mijn account niet deleten nog beheren| :large_orange_diamond: 
 |Ik kan 2FA niet activeren| :large_orange_diamond: 
 |Ik kan als admin alle groepen deleten zelf groepen aangemaakt door andere admins of door super user| :large_orange_diamond: 
 |Ik kan andere admins accounts deleten en ook de super_admin| :red_circle:
 |Nieuwe gebruikers moeten een nieuw paswoord aanmaken na eerste login, maar bij account kenny.passenier@student.ehb.be was dit niet het geval, deze heeft nog altijd hetzelfde paswoord als in de registratie email.|:red_circle:
 |Gebruikers met “viewer” rechten worden naar de admin pagina doorgestuurd na login|:large_orange_diamond:

&nbsp;

## Sensitive data Exposure
   * Gitleaks scan resultaat  => :thumbsup:
   * In de repo zijn de users aanwezig in de database seeds ( deze werden wss gebruikt om de database te seeden) => :red_circle:

&nbsp;


## Https

 * SSl Labs geeft een A+ resultaat => :thumbsup:
 * responses bevatten STS Header (getest met curl) => :thumbsup: 
 * https://hstspreload.org/?domain=thewhizkids.be  => still pending HSTS preload list. => :thumbsup:

&nbsp;
## OWASP Vulnerability check Using SonarQube
 * SonarQube geeft overal een A op OWASP vulnerabilities 
 * enkele false positives werden wel aangegeven in het rapportje

&nbsp;
## Headers
https://observatory.mozilla.org/analyze/osd.thewhizkids.be
 * geen csp header aanwezig 
 * geen X-Content-Type-Options header => Risk MIME-sniffing attack
 * geen X-Frame-Options XFO header
 * geen x-xss-Protection header

 #### Recomandation : 
 - CSP Header Laravel example => https://github.com/spatie/laravel-csp
 - X-Frame-Options XFO Header in Laravel => https://stackoverflow.com/questions/62059386/how-to-set-x-frame-options-in-laravel-project
 - x-xss-Protection header example => https://danieldusek.com/enabling-security-headers-for-your-website-with-php-and-laravel.html

&nbsp;
 ## GDPR
  * u eigen account kan niet ge-delete worden
  * je kan u eigen data niet opvragen

