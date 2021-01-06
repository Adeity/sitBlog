<?php
session_start();
include_once("reload_cookie.php");
include("db_operations.php");
include("topbar.php");
?>

<main class="container">
    <div class="row">
        <div class="col" id="documentation">
            <h2>Popis úlohy</h2>
            <h3>Zadání</h3>
            <p>Webová aplikace sitBlog má sloužit jako blog, do kterého příhlášení uživatelé mohou psát články do dvou podkategorií 'blog' a 'bug'. Při brouzdání sitBlogu by si uživatel měl moc vybrat, zda chce procházet mezi články z podsekce blog, bug, nebo oboje zároveň. K tomu budou sloužit filtry, které uživatel může nastavit a aplikovat.
                Jestliže uživatel napíše článek, který by chtěl později ze sitBlogu vymazat, může tak učinit. Musí k tomu být ale přihlašený.
                Každý uživatel, který se přihlašuje pomocí emailové adresy a hesla bude mít svůj vlastní jedinečný username.</p>

            <h3>Akceptační podmínky</h3>
            <ul>
                <li>Formuláře jsou dobře validované, aby nedocházelo k útokům</li>
                <li>Web musí být použitelný i bez JavaScriptu, aby ho mohli používat i lidi se starými prohlížeči.</li>
                <li>Web bude odolný proti zlým uživatelům</li>
                <li>Uživatel si bude moct přepínat mezi světlým a temným režimem vzhledu</li>
            </ul>
<hr>
            <h2>Popis implementace</h2>
            <p>K vytvoření serverové strany webové aplikace jsem využíval čistě vlastní napsaný kód v PHP bez frameworku. Na frontendu jsem k HTML a CSS využíval frameworku Bootstrap a k psání JavaScriptu jsem využíval nástavby JQuery.</p>

            <h3>PHP</h3>
            <p>Když načtu hlavní stránku a PHP nenajde get parametry, tak se nastaví defaultní hodnoty stránkování na první stŕanku. Stejně tak filtr kategorií není aktivní.</p>
            <p>Kliknutím na čislo ve stránkování se zapomocí AJAXu asynchronně odešle dotaz na php soubor, který vrací POUZE vytisknuté články. Práce s filtry v něm funguje stejně.</p>
            <p>Aby se ve formulářích neztrácela vyplněná políčka, tak si je vždy na začátku PHP kódu uložím do proměnných, pokud projdou validací, vypíšuje ji. V PHP kódu také nastavuju různe buď chybové nebo success zprávy, jejich obsahem je třeba právě uživatelský email, avšak ihned po výpisu je mažu. Zajišťuji tak správné chování, kde po opětovném reloadu stránky se uživatelské hodnoty dále nepředvypisují a stejně tak se formulář znova neodesílá.</p>

            <h3>HTML a CSS</h3>
            <p>Používal jsem framework Bootstrap, který zajištujě snadnou práci s flexboxem. Nejčastější jsou Bootstrap komponenty card, které poznáte podle classy.
                Bootstrap také classu "d-print-none", díky které se v print media nezobrazí to, co tuto classu má. K psaní css jsem používal scss syntaxi a následně kompilátorem překompiloval do css.</p>

            <h3>JS</h3>
            <p>V JS/JQuery jsem napsal rotujícího se červa, AJAX, skinovatelnost a cookie s tím spojený. Rotace červa spočívá v tom, že červovy po různých časových úsecích přenastavuju classy. O animaci už se starají CSS animace.</p>

            <hr>

            <h2>Uživatelská příručka</h2>
            <h3>Hlavní stránka</h3>
            <p>Na hlavní stránce jsou můžete nalézt všechny články.</p>
            <img src="docimgs/1_mainpage.png" alt="">
            <p>Pokud chce prohledávat články podle podsekce, využijte možnosti filtrování v okně Filtry. Vyberte si podsekci, klikněte na ni a zmáčkněte tlačítko aplikovat. Pokud chce opět procházet v obou podsekcích zároveň, kliknětě na tlačítko Smazat filtr</p>
            <img src="docimgs/2_filtr.png" alt="">
            <p>Hlavní stránka využívá možnosti stránkování. Na jedné straně se vypíše 10 článků, pokud je jich více, pak na konci stránky najdete stránkovou navigaci.</p>
            <img src="docimgs/3_pagination.png" alt="">
            <p>Pokud si nastavíte barevný mód na temný, pak se změní i rozvržení hlavní stránky. Ve světlém módu jsou vypsané články nalevo a kartička s filtry napravo. V temném módu je tomu naopak.</p>
            <img src="docimgs/4_darkmode.png" alt="">
            <p>Temný mód přepnete v patičce aplikace. A to nás dostává k hlavnímu layoutu sitBlogu.</p>

            <h3>Hlavní layout</h3>
            <p>Hlaví layout se skláda z hlavičky, hlavního obsahu a patičky.</p>
            <h3>Hlavička</h3>
            <p>V hlavičce najdete logo sitBlogu na které když kliknete, dostanete se na domovskou stránku.
                Dále pokud jste přihlášení, v hlavičce uvidíte svoje uživatelské jméno, odkaz na stránku, kde můŽete vytvořit článek a tlačítko, které vás odhlásí. Pokud přihlášení nejste, najdete v hlavičce pouze logo sitBlogu a odkaz na přihlašovací stránku.</p>
            <img src="docimgs/5_hlavicka.png" alt="">
            <h3>Hlavní obsah</h3>
            <p>Část hlavního obsahu je jediná část, která se mění podle toho, na jaké stránce se právě nacházíte. Na domovské stránce jsou vypsané články a kartička s filtry, na stránce pro přihlášení naleznete formulář pro příhlášení atd.</p>
            <h3>Patička</h3>
            <p>Patička je nejzábavnější část layoutu stránky. V levém rohu naleznete brouka. Když na něj kliknete, začne se točit.
                V pravém rohu je přepínač temného režimu. Klikněte na něj a změníte barevný režim celé stránky.</p>
            <img src="docimgs/6_footer.png" alt="">

            <h3>Přihlašovací a registrační stránka</h3>
            <p>Na přihlašovácí a registrační stránce naleznete formulář, kde pro registraci muset vložit váš email, username a heslo. V případě přihlášení stačí zadat email a heslo.</p>
            <p>Pozor, uživatelské jméno může obsahovat pouze znaky a-b, A-B, 0-9. Heslo musí být alespoň 8 znaků dlouhé, mít alespoň jedno velké a malé písmeno, čislo a speciální znak.</p>
            <img src="docimgs/7_login.png" alt="">
            <img src="docimgs/8_register.png" alt="">

            <h3>Stránka pro vytvoření článku</h3>
            <p>Na stránce pro vytvoření článku naleznete formulář, kde jsou dvě povinné pole: Nadpis článku a obsah článku. Můžete si vybrat, zda článek bude pod kategorií bug nebo blog. Pokud si nevyberete, članek bude přiřazen do kategorie blog.</p>
            <img src="docimgs/9_createarticle.png" alt="">

            <h3>Stránka pro jednotlivý článek</h3>
            <p>Na výpís jednotlivého článku se dostanete tak, že ho najdete na hlavní stránce a kliknete visit article. A zde už pak máte možnost vidět, kdo článek vytvořil a v případě, že autorem jste vy jako přihlášený uživatel, můžete článek smazat.</p>
            <img src="docimgs/10_articleview.png" alt="">
        </div>
    </div>
</main>
<?php include("footer.php");?>
