# ABUY

Lietoto automašīnu tirdzniecības platforma. Kvalifikācijas darbs Rīgas Valsts tehnikumā.

**Production:** https://web-production-9b4b6.up.railway.app

## Funkcijas

**Lietotājiem:**
- Reģistrācija un autentifikācija
- Sludinājumu pārlūkošana ar filtriem (marka, modelis, cena, gads, dzinējs, kuzov, ātrumkārba)
- Sludinājumu izveide ar fotoattēliem
- Favoriti
- Tērzēšana ar administratoru
- Pirkuma pieprasījumi un atsauksmes

**Administratoriem:**
- Statistikas dashboard ar diagrammām
- Lietotāju pārvaldība (bloķēšana, dzēšana)
- Sludinājumu un atsauksmju moderācija
- Tērzēšanas pārvaldība

## Tehnoloģijas

**Backend:**
- PHP 8.3
- Laravel 12
- MySQL 8.0
- Eloquent ORM
- Laravel Sanctum (token-based auth)

**Frontend:**
- React 19
- Vite 7
- Tailwind CSS 3
- React Router 7
- Axios
- Recharts (diagrammas)
- browser-image-compression

**Infrastruktūra:**
- Railway (hosting + MySQL + persistent storage)
- GitHub (version control)

## Lokāla palaišana

### Priekšnosacījumi
- PHP 8.3+ ar `pdo_mysql` un `gd` paplašinājumiem
- MySQL 8.0+
- Composer 2
- Node.js 18+

### 1. Klonēt repo

```bash
git clone https://github.com/Killa930/my-project.git
cd my-project
```

### 2. Backend

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Izveidot MySQL datubāzi `auto_salon` un norādīt tās datus `.env` failā:

```env
DB_DATABASE=auto_salon
DB_USERNAME=root
DB_PASSWORD=
```

Palaist migrācijas un sākotnējos datus:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Backend: `http://localhost:8000`

### 3. Frontend

```bash
npm install
npm run dev
```

Frontend: `http://localhost:5173`

## Testa lietotāji

| Loma | E-pasts | Parole |
|---|---|---|
| Administrators | admin@abuy.lv | password |
| Lietotājs | user@abuy.lv | password |

## Datubāze

9 tabulas, normalizētas līdz 3NF:

- `users` — lietotāji
- `manufacturers` — ražotāji
- `car_models` — modeļi
- `cars` — sludinājumi
- `car_images` — sludinājumu attēli
- `favorites` — favoriti
- `transactions` — pirkuma pieteikumi
- `reviews` — atsauksmes
- `messages` — tērzēšanas ziņas

## Projekta struktūra

```
my-project/
├── app/
│   ├── Http/Controllers/Api/   # 9 kontrolieri
│   ├── Models/                 # Eloquent modeļi
│   └── Helpers/                # ProfanityFilter
├── database/
│   ├── migrations/             # DB shēma
│   └── seeders/                # Sākotnējie dati
├── resources/
│   ├── js/                     # React aplikācija
│   │   ├── api/axios.js        # HTTP klients
│   │   ├── components/
│   │   ├── context/
│   │   └── pages/
│   └── css/app.css
├── routes/api.php              # API maršruti
└── .env.example
```

## Drošība

- Paroles glabājas ar bcrypt (12 raundi)
- SQL injection aizsardzība caur Eloquent parametrizāciju
- XSS aizsardzība ar React auto-escape
- CSRF aizsardzība ar Sanctum
- Mass Assignment aizsardzība ar `$fillable`
- Role-Based Access Control (RBAC) administratīvajām funkcijām
- HTTPS production režīmā

## Autors

D. Tumanovs, Rīgas Valsts tehnikums, 2026
