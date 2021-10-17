<p>Dit werkstuk zal de site van <a href="http://shop.osdvub.be/">OSD</a> opnieuw maken. Het is niet de bedoeling deze site na te maken maar het gebruiksvriendelijk te maken voor zowel gebruikers als admins. Events creëren zou zo een pak eenvoudiger gemaakt moeten worden, contact pagina zou een bericht naar de inbox van admins moeten versturen (i.p.v. naar een mail adres) en er zou een algemeen forum/chat moeten worden aangemaakt zodat de admins onderling makkelijk kunnen communiceren. Het zal dan ook de bedoeling zijn om een bepalingsmethode te implementeren om tickets voor de event te kunnen kopen (dit zal, in overeenkomst met OSD waarschijnlijk gebeuren met Mollie).</p>
<p>Ik zou graag even willen aanhalen dat ik in plaats van een profiel pagina te maken,
    de event pagina zo heeft opgesteld dat je enkel deze enkel kan aanpassen (en zien) indien je in de groep zit
    die dit event organiseert of als je de admin rol hebt. Een profiel pagina paste niet op deze website.
</p>
<p>
    Als extra features heb ik dan het zo gemaakt dat een admin nieuwe members kan toevoegen met een bepaalde rol en deze ook toewijzen aan een groep.
    Extra groepen kunnen dan ook toegevoegd worden door een admin. De toepassing van groepen, zoals eerder vermeld,
    is om het enkel mogelijk te maken events aan te passen indien je in de groep van de organisator zit.
    <br>
    Rollen:
</p>
<ul>
    <li>Admin: toegang tot alle features.</li>
    <li>Editor: toegang tot alle events georganiseerd door de groep waar de gebruiker in zit.
        Dit wil zeggen dat de gebruiker zowel eigen events kan aanpassen als nieuwe events kan toevoegen.</li>
    <li>Viewer: een gedeactiveerd account die wel zicht heeft op alle events van de groep
        waar de gebruiker in zit maar kan geen events bewerken of toevoegen.</li>
</ul>
<p>
    Laatst zou ik ook graag even verduidelijking willen geven omtrent de aanpak van routing.
    Zoals u in de feedback heeft aangehaald, had ik best gewerkt met resource controllers.
    Maar aangezien 90% van mijn taak al was afgewerkt en
    door de examens niet genoeg tijd heb om alles te herwerken, heb ik zowel de contact controller als de
    FAQ-controller als resource controller aangemaakt om toch te laten zien dat ik hiermee ken werken
    (en ook in de toekomst zo te werk zou gaan).
</p>

<p>
    Installatie laravel: https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/ 
</p>

<p>Bronnen:</p>
<ul>
    <li><a href="https://getbootstrap.com/">Bootstrap</a></li>
    <li><a href="http://shop.osdvub.be/">Shop OSD</a></li>
    <li><a href="https://startbootstrap.com/previews/simple-sidebar">Sidebar</a></li>
    <li><a href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/">Footer</a></li>
    <li><a href="https://laravel.com/docs/8.x/validation#form-request-validation">Laravel Doc</a></li>
    <li><a href="https://itsjavi.com/bootstrap-colorpicker/index.html">Bootstrap Colorpicker</a></li>
    <li><a href="https://www.itsolutionstuff.com/post/laravel-change-password-with-current-password-validation-exampleexample.html">Change Password</a></li>
    <li><a href="https://www.webslesson.info/2018/09/simple-way-to-sending-an-email-in-laravel.html">Contact page/Mailer</a></li>
</ul>