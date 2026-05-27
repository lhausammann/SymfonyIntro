# SymfonyIntro

Dieses Repository ist als Schulungsprojekt aufgebaut. Die Branches sind als Kapitel gedacht und zeigen die Entwicklung einer Symfony-Anwendung Schritt fuer Schritt.

## Lernpfad (Hauptkapitel)

### 1. `1-docker` - Projektstart mit Docker
- Ziel: lauffaehige lokale Entwicklungsumgebung als Basis fuer den Kurs.
- Fokus:
  - Symfony-Projektgeruest in Container-Setup.
  - Wiederholbare Umgebung fuer alle Teilnehmenden.
  - Grundkonfiguration fuer den weiteren Ausbau.
- Ergebnis: Das Projekt startet reproduzierbar und ist bereit fuer die ersten Features.

### 2. `2-request-response` - HTTP, Routing, Controller, Twig
- Ziel: den klassischen Symfony-Request-Flow verstehen.
- Fokus:
  - Routing und Controller (`src/Controller/NumberGuessController.php`).
  - Rendering mit Twig (`templates/base.html.twig`, `templates/index.html.twig`).
  - Grundlagen von Request/Response und Seitenaufbau.
- Ergebnis: Erste funktionierende Weboberflaeche fuer das Number-Guessing-Feature.

### 3. `3-model` - Domainmodell und testbare Fachlogik
- Ziel: Fachlogik aus der Webschicht loesen und testbar machen.
- Fokus:
  - Einfuehrung von Domain-Klassen (`src/NumberGuesserGame/*`).
  - Abstraktionen mit Interfaces fuer Guesser und Repository.
  - PHPUnit-Setup und Unit-Tests (`tests/NumberGuesserGame/*`).
  - CLI-Integration mit Kommando (`src/Command/GuessNumber.php`).
- Ergebnis: Klare Trennung zwischen Transportschicht (HTTP) und Kernlogik.

### 4. `4-doctrine` - Persistenz mit Doctrine ORM
- Ziel: vom In-Memory-Ansatz auf persistente Datenhaltung wechseln.
- Fokus:
  - Doctrine-Konfiguration (`config/packages/doctrine.yaml`).
  - Entity-Mapping (`src/Entity/Game.php`, `src/Entity/GuessResult.php`).
  - Repositories in der Infrastruktur (`src/Repository/*`).
  - Migrationen und Datenbankschema (`migrations/`).
- Ergebnis: Spiele und Guess-Ergebnisse werden in einer Datenbank gespeichert.

### 5. `5-with-history` - Historisierung und fachliche Erweiterung
- Ziel: die bestehende Logik um Verlauf/Historie erweitern.
- Fokus:
  - Neue Entitaet fuer Historie (`src/Entity/HistoryEntry.php`).
  - Anpassungen an Controller, Command und Repository.
  - Erweiterte Darstellung im Frontend (`templates/guess.html.twig`).
  - Zusatztests inkl. funktionaler Tests (`tests/Functional/NumberGuessControllerTest.php`).
- Ergebnis: Nachvollziehbare Spielhistorie und robusteres Verhalten durch mehr Testabdeckung.

### 6. `6-security` - Security mit Symfony Security-Komponenten
- Ziel: Zugriffsschutz und Benutzerkontexte integrieren.
- Fokus:
  - Security-Konfiguration (`config/packages/security.yaml`).
  - Zusatzeinstieg fuer geschuetzten Bereich (`src/Controller/AdminController.php`).
  - Eigene Route und Admin-Template (`config/routes/security.yaml`, `templates/admin/index.html.twig`).
- Ergebnis: Die Anwendung besitzt einen abgesicherten Bereich und eine saubere Sicherheitsbasis.

## Alternative/Ergaenzende Kapitel

### `4-repository`
- Alternative Auspraegung rund um Repository-Abstraktion ohne vollen Doctrine-Stack.
- Didaktisch nuetzlich, um den Unterschied zwischen In-Memory- und Persistenz-Ansatz klar zu machen.

### `6b-security-selfmade`
- Security-Variante mit eigener Listener-Logik (`src/EventListener/SecurityListener.php`).
- Zeigt, wie Authentifizierung/Autorisierung prinzipiell selbst umgesetzt werden kann mittels
- Event-Listener, ohne die volle Symfony Security-Komponente zu nutzen.

### `6c-security-selfmade-basic-auth`
- Erweiterung von `6b` um Basic-Auth in derselben Listener-Logik.
- Nuetzlich als Minimalbeispiel fuer Header-basierte Absicherung.
- Zeigt, wie man auch ohne Session/Cookie-Mechanismen einen geschuetzten Bereich realisieren kann.

## Didaktischer roter Faden

Von Kapitel 1 bis 6 entsteht eine vollstaendige, schrittweise entwickelte Symfony-Anwendung:

1. Umgebung und Projektbasis
2. Web-Flow und UI
3. Domain und Tests
4. Persistenz
5. Erweiterte Fachlichkeit
6. Sicherheit

Damit eignet sich das Repo sowohl fuer gefuehrte Workshops als auch fuer Selbststudium in klaren Etappen.

## Schnelle Kapiteluebersicht

| Branch | Lernziel | Zentrale Dateien | Uebungsidee |
| --- | --- | --- | --- |
| `1-docker` | Projekt lokal reproduzierbar starten | `docker-compose.yml`, `.env`, `config/reference.php` | Service starten, Container verstehen, ENV-Werte variieren |
| `2-request-response` | Request -> Route -> Controller -> Response nachvollziehen | `src/Controller/NumberGuessController.php`, `templates/base.html.twig`, `templates/index.html.twig` | Neue Route mit eigener Twig-Seite bauen |
| `3-model` | Fachlogik entkoppeln und testen | `src/NumberGuesserGame/*`, `tests/NumberGuesserGame/*`, `src/Command/GuessNumber.php` | Neue Regel im Game einfuehren und per Unit-Test absichern |
| `4-doctrine` | Persistenz mit Doctrine umsetzen | `config/packages/doctrine.yaml`, `src/Entity/Game.php`, `src/Repository/GameRepository.php`, `migrations/` | Entity erweitern, Migration erzeugen, Datenfluss pruefen |
| `5-with-history` | Fachlichkeit erweitern (Historie) | `src/Entity/HistoryEntry.php`, `templates/guess.html.twig`, `tests/Functional/NumberGuessControllerTest.php` | Historie nach Datum sortieren und im UI darstellen |
| `6-security` | Geschuetzten Bereich absichern | `config/packages/security.yaml`, `src/Controller/AdminController.php`, `templates/admin/index.html.twig` | Zugriff fuer Rolle differenzieren (z. B. User/Admin) |
| `4-repository` | Repository-Pattern ohne vollen ORM-Fokus vergleichen | `src/Repository/InMemoryRepository.php`, `src/NumberGuesserGame/RepositoryInterface.php` | In-Memory gegen persistente Implementierung austauschen |
| `6b-security-selfmade` | Eigene Security-Mechanik per Listener verstehen | `src/EventListener/SecurityListener.php` | Eigene Zugriffsregel fuer einen Pfad implementieren |
| `6c-security-selfmade-basic-auth` | Basic Auth als einfache Header-Absicherung einsetzen | `src/EventListener/SecurityListener.php` | Credentials-Validierung robuster machen (Fehlerfaelle testen) |

