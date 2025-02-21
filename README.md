# Étterem Foglalási Rendszer

Ez az étterem foglalási rendszer lehetővé teszi az éttermek és foglalások kezelését egy egyszerű API-n keresztül. A rendszer Laravel keretrendszerben készült, és MySQL adatbázist használ az adatok tárolására.

## Tartalomjegyzék

- [Funkcionalitások](#funkcionalitások)
- [Technológiák](#technológiák)
- [Telepítés](#telepítés)
- [API Végpontok](#api-végpontok)
- [Hozzájárulás](#hozzájárulás)
- [Licenc](#licenc)

## Funkcionalitások

- Éttermek kezelése:
  - Új éttermek hozzáadása
  - Éttermek listázása
  - Egy adott étterem részleteinek lekérdezése
  - Éttermek törlése (ha nincs aktív foglalás)

- Foglalások kezelése:
  - Új foglalások létrehozása
  - Foglalások listázása
  - Egy adott foglalás részleteinek lekérdezése
  - Egy adott étterem foglalásainak listázása
  - Foglalások törlése

## Technológiák

- Laravel (PHP keretrendszer)
- MySQL (adatbázis)
- Composer (csomagkezelő)

## Telepítés

1. Klónozd a repót a helyi gépedre:
```
git clone https://github.com/KomaromiJano/ettermi_api.git
cd ettermi_api
```
2. Telepítsd a szükséges csomagokat:
```
composer install
```
3. Másold át a `.env.example` fájlt `.env` néven, majd állítsd be az adatbázis kapcsolati beállításokat:
```
cp .env.example .env
```
4. Generálj új alkalmazás kulcsot:
```
php artisan key:generate
```
5. Futtasd a migrációkat az adatbázis létrehozásához:
```
php artisan migrate
```
6. Inicializáld az adatbázist alapadatokkal:
```
php artisan db:seed
```
7. Indítsd el a fejlesztői szervert:
```
php artisan serve
```
## API Végpontok

### Éttermek kezelése (/api/restaurants)

- **GET /api/restaurants**: Összes étterem lekérdezése.
- **GET /api/restaurants/{id}**: Egy adott étterem részletei (foglalások nélkül).
- **POST /api/restaurants**: Új étterem hozzáadása.
- **DELETE /api/restaurants/{id}**: Étterem törlése (ha nincs aktív foglalás).

### Foglalások kezelése (/api/reservations)

- **GET /api/reservations**: Összes foglalás listázása.
- **GET /api/reservations/{id}**: Egy adott foglalás lekérdezése.
- **GET /api/restaurants/{id}/reservations**: Egy adott étterem foglalásainak listázása.
- **POST /api/reservations**: Új foglalás létrehozása.
- **DELETE /api/reservations/{id}**: Foglalás törlése.

## Hozzájárulás

Ha szeretnél hozzájárulni a projekthez, kérlek, nyiss egy issue-t vagy küldj egy pull requestet!

## Licenc

Ez a projekt MIT licenc alatt áll. További részletekért lásd a LICENSE fájlt.