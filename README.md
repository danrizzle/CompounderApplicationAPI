# Aufgabenstellung

-   Einfacher Bewerbungsprüfservice, der über API (/api/applications) angesprochen wird
-   Leicht erweiterbar, um neue Regeln zur Prüfung eingereichter Dokumente und Daten
-   Unit- und Feature-Tests
-   Keine UI

## Vorgehensweise

Als Allererstes habe ich (natürlich) ein neues Laravel 12 Projekt erstellt über Composer. Dann habe ich Laravel Sail initialisiert, um das Projekt der Einfachheit und Übersichtlichkeit wegen bei mir lokal im Docker-Container laufen zu lassen.

Danach habe ich die routes/web.php entfernt und eine routes/api.php Datei erstellt, um sichtbar die API zu definieren. Diese habe ich dann in der bootstrap/app.php eingebunden. Um eine JSON-Antwort immer zu garantieren, habe ich dort auch eine globale Middleware "App/Http/Middleware/EnforceJsonResponse" eingebunden.

Für eine Struktur im Kopf habe ich dann erstmal folgende Gedanken gehabt:

-   Neues Rule-Interface nötig, um konkrete Daten durch die Validierung zurückzugeben. Für den Return-Type "array" habe ich mich entschieden, um die Möglichkeit bestehen zu lassen, dass mehrere fehlende Dokumente aus einer gebrochenen Regel kommen können.

-   Dadurch leicht erweiterbar, automatisiertes Erkennen neuer Regeln und Einbinden in die ValidateDocumentsAction, wenn die Datei im Ordner UND das neue Interface implementiert (siehe app/Providers/AppServiceProvider.php)

-   In der app/Actions/Application/ValidateDocumentsAction wird dann der im Controller übergebene DTO auf fehlende Dokumente validiert.

Prozedere ist wie folgt:

-   /api/applications bekommt einen Request mit allen Feldern

-   Dieser Request wird zuerst über die StoreApplicationRequest auf fehlende Felder und Typen validiert

-   Wenn erfolgreich, wird daraus ein DTO erstellt mit den richtigen Typen, was dann dem ApplicationValidationService übergeben wird

-   In diesem Service wird die ValidateDocumentsAction ausgeführt mit allen Regeln, die sich im Ordner App/Rules/Application/ befinden und vom Typ das neue Interface App/Rules/Interfaces/ApplicationRuleInterface implementieren

-   Diese Action validiert jede Regel, die ich im ServiceProvider manuell injected habe über die oben genannten Bedingungen

-   Zurückkommt ein Array mit allen fehlenden Dokumenten, die dann in die ApplicationValidationResource übergeben werden

-   Damit Laravel-Magic nicht ein Array zurückgibt, der unsere Response an einen "data"-Key anhängt (['data' => ['status'=> ...]]) als Key beginnt, haben wir in der boot()-Funktion im ServiceProvider die JsonResource::withoutWrapping(); benutzt

Am Ende habe ich die Test-Cases erstellt, um folgende Sachen sicherzustellen:

-   Einen Test, dass die API immer JSON zurückgibt

-   Zwei Tests, um sicherzustellen, dass sowohl bei ['status'=> 'reject'] als auch bei ['status'=> 'accept'] ein JSON-Response zurückkommt, der immer denselben Aufbau hat

-   Einen Test, um sicherzustellen, dass auch Validierungsfehler, wenn Felder fehlen, in JSON zurückgegeben werden

-   Drei Unit-Tests, um jede einzelne Beispielregel zu testen

-   Einen Unit-Test, um die Request-Validation zu testen, wenn alle Felder fehlen

Am Ende bin ich nochmal durch alle PHPStan Stufen gegangen bis Stufe 10 und habe alles nachgebessert und gepusht.
