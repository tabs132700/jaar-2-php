# Acceptance test - CRUD Fietsen

## Doel
Testen of de CRUD (Create/Read/Update/Delete) werkt voor tabel `fietsen`.

## Preconditions
- Database `fietsenmaker` is geïmporteerd (phpMyAdmin)
- Tabel `fietsen` bestaat met velden: id, merk, type, prijs, foto
- Project draait in XAMPP (Apache + MySQL)
- Composer is geïnstalleerd en `vendor/` bestaat

## Test stappen + expected result
1. Open `index.php`
   - Expected: lijst met fietsen + form zichtbaar

2. Voeg een nieuwe fiets toe (merk/type/prijs/foto)
   - Expected: fiets verschijnt in de tabel

3. Klik **Edit**, pas `prijs` aan en klik opslaan
   - Expected: prijs is geupdate in de lijst

4. Klik **Delete** op dezelfde fiets en bevestig
   - Expected: fiets is weg uit de lijst

## Resultaat
- PASS / FAIL (invullen in report)
