# Url
https://osd.thewhizkids.be/
# Goal
De toepassing die wij willen beveiligen is een dynamische website waarop studentenkringen hun evenementen kunnen aanmaken, beheren en dan tonen in een agenda. Beheerders van kringen kunnen de evenementen aanmaken, gewone gebruikers kunnen worden toegevoegd aan een kring en kringen kunnen samenwerken aan evenementen. Ook is er nog een Admin rol die de verschillende kringen en rollen van gebruikers kan beheren, deze functie is voorbehouden voor de hosts van de site.
# Acceptance criteria
- Als een bezoeker kan ik kan via het front-end alle zichtbare evenement overzichtelijk zien en in detail. Het is niet mogelijk om aan het editor panel te geraken.
- Als een editor kan ik kan ik enkel de evenementen zien in het editor panel van de groep waaraan ik ben toegevoegd. Ik kan nieuwe evenementen aanmaken en de al bestaande events van mijn groep bewerken.
- Als een viewer kan ik enkel de evenementen zien in het editor panel van de groep waaraan ik ben toegevoegd. Ik kan deze evenementen niet bewerken, mijn account kan gezien worden als disabled.
- Als een (website) admin kan ik alle evenementen, gebruikers en de FAQ beheren via het admin panel (uitbreiding op het editor panel). Het is mogelijk als website admin om nieuwe events, users en FAQ toe te voegen, updaten en verwijderen. Het is wel niet mogelijk om als website admin een user te elevaten naar admin, hiervoor dient een nieuw account aangemaakt te worden.
- Als een Combell beheerder kan ik de backend van de website en de database beheren. Zo kan ik de ook aan de logs van de website om een overzicht te kunnen houden over mogelijke gevaren en slechte intenties.

*Deze website was het project voor Web Integration van Tibo de Munck in samenwerking met de overkoepelende studentendienst van de VUB.*


# Threat model
![Software Security](https://user-images.githubusercontent.com/46536105/137717171-f577bfc0-7948-4f12-9494-bd4b201b76c4.png)


# Threats:

## STRIDE:
![image](https://user-images.githubusercontent.com/46536105/142774835-59f76504-7aa5-42fd-b94f-06fa7ba9164e.png)

## Account Vulnerabilities:

### Site Admin-account, High Risk
Risico ligt vooral in pogingen om brute-force het wachtwoord van het account te achterhalen, of indien de de eigenaar van het admin account zijn eigen computer niet goed beschermt tegen ander mogelijk gebruik.
Oplossingen:
1. Maximaal aantal login pogingen, indien overschreden timeout van 5 minuten
2. 16-character lang wachtwoord
3. "Remember me" functionaliteit uitschakelen
4. Automatisch uitloggen bij langdurige inactiviteit
5. Autocomplete van wachtwoord uitschakelen
6. Back-end waarschuwingssysteem indien er te veel gefaalde pogingen zijn om in te loggen op een admin-account
7. *Zie onder Combell admin

### Site Editor-account, Low Risk
Zelfde risico's die aanwezig zijn bij het admin-account, maar bij een doorbraak zal er een veel minder grote impact kunnen worden gemaakt omdat deze accounts tot minder in staat zijn.
Oplossingen:
1. Maximaal aantal login pogingen, indien overschreden timeout van 5 minuten
2. 8-character lang wachtwoord
3. "Remember me" functionaliteit uitschakelen
4. Automatisch uitloggen bij langdurige inactiviteit
5. Autocomplete van wachtwoord uitschakelen
6. *Zie onder Combell admin

### Combell-Admin/DB-Admin, Medium Risk
Omdat we plannen om onze webservice te hosten op [Combell](https://www.combell.com/en/), zal dit account ook automatisch de DB-admin worden. Hierom leunen we op de reeds ingebouwde beveiliging die Combell aanbiedt.

Extra voor Site Admin-, Editor-Account en Combell-account:
1. Er zal op regelmatige basis een back-up worden genomen om ervoor te zorgen dat indien er toch wordt ingebroken op één van deze accounts, niet alle data verloren zal gaan

# Deployment
*minimally, this section contains a public URL of the app. A description of how your software is deployed is a bonus. Do you do this manually, or did you manage to automate? Have you taken into account the security of your deployment process?*
# *you may want further sections*
*especially if the use of your application is not self-evident*
