# Goal
De toepassing die wij willen beveiligen is een dynamische website waarop studentenkringen hun evenementen kunnen aanmaken, beheren en dan tonen in een agenda. Beheerders van kringen kunnen de evenementen aanmaken, gewone gebruikers kunnen worden toegevoegd aan een kring en kringen kunnen samenwerken aan evenementen. Ook is er nog een Admin rol die de verschillende kringen en rollen van gebruikers kan beheren, deze functie is voorbehouden voor de hosts van de site.
# Acceptance criteria
Onze beveiliging zal zich op verschillende delen focussen. Het eerste waarop we zullen focussen is dat gebruikers niet buiten hun toegelaten functionaliteiten zullen treden en ook dat bezoekers zonder account geen acties kunnen ondernemen die enkel zijn voorbestemd voor gebruikers. Hoewel er geen grote hoeveelheden sensitieve data wordt verstuurd van en naar onze webserver, zal er een extra moeite worden gedaan om deze extra te beveiligen. Ook zal er een beveiliging worden ingebouwd dat de authenticatie niet overbelast kan worden. We zullen ervoor zorgen dat evenementen enkel van betrouwbare bronnen (beheerders) kunnen worden toegevoegd, zodat er geen bezoekers naar gevaarlijke plaatsen gelokt kunnen worden met valse evenementen. Er zal een achterliggend systeem worden geïmplementeerd die actief alle kritieke activiteiten (eg. logins, registraties, aanmaken evenementen, etc.) zal bijhouden. Als laatste zullen we de reeds bestaande beveiliging updaten naar de laatste standaarden indien deze bestaan (applicatie ontwikkeld 2020).

Deze website was het project voor Web Integration van Tibo de Munck in samenwerking met de overkoepelende studentendienst van de VUB

# Threat model
![Software Security](https://user-images.githubusercontent.com/46536105/137717171-f577bfc0-7948-4f12-9494-bd4b201b76c4.png)


## Threats:

### Site Admin-account, High Risk
Risico ligt vooral in pogingen om brute-force het wachtwoord van het account te achterhalen, of indien de de eigenaar van het admin account zijn eigen computer niet goed beschermt tegen ander mogelijk gebruik.
Oplossingen:
1. Maximaal aantal login pogingen, indien overschreden timeout van 5 minuten
2. 32-character lang wachtwoord
3. "Remember me" functionaliteit uitschakelen
4. Automatisch uitloggen bij langdurige inactiviteit
5. Autocomplete van wachtwoord uitschakelen
6. Back-end waarschuwingssysteem indien er te veel gefaalde pogingen zijn om in te loggen op een admin-account
7. *Zie onder Combell admin

### Site Editor-account, Low Risk
Zelfde risico's die aanwezig zijn bij het admin-account, maar bij een doorbraak zal er een veel minder grote impact kunnen worden gemaakt omdat deze accounts tot minder in staat zijn.
Oplossingen:
1. Maximaal aantal login pogingen, indien overschreden timeout van 5 minuten
2. 32-character lang wachtwoord
3. "Remember me" functionaliteit uitschakelen
4. Automatisch uitloggen bij langdurige inactiviteit
5. Autocomplete van wachtwoord uitschakelen
6. *Zie onder Combell admin

### Combell-Admin/DB-Admin, Medium Risk
Omdat we plannen om onze webservice te hosten op [Combell](https://www.combell.com/en/), zal dit account ook automatisch de DB-admin worden. Hierom leunen we op de reeds ingebouwde beveiliging die Combell aanbiedt.

Extra voor Site Admin-, Editor-Account en Combell-account:
1. Er zal op regelmatige basis een back-up worden genomen om ervoor te zorgen dat indien er toch wordt ingebroken op één van deze accounts, niet alle data verloren zal gaan

### External DB injection, Low Risk
Omdat er toch een aantal forms worden gebruikt op de website wordt dit gezien als een threat, hoewel het [Laravel-Framework](https://laravel.com/) reeds een goede beveiliging aanbiedt hiervoor.

Oplossingen:
1. Forms beveiligen
2. Login beveiligen

# Deployment
*minimally, this section contains a public URL of the app. A description of how your software is deployed is a bonus. Do you do this manually, or did you manage to automate? Have you taken into account the security of your deployment process?*
# *you may want further sections*
*especially if the use of your application is not self-evident*
