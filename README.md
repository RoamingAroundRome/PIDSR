## Installation Guide
You will be installing Laravel (folder: api) & Nuxt js (folder: pwa)

<b><u>Step 1</u></b>
<p>Clone the project repo using Git</p>

```
git clone https://github.com/carlomigueldy/PIDSR.git
```

<p>Navigate to the project's dirctory after cloning</p>

```
cd PIDSR
```

<b><u>Step 2</u></b>
<p>Install the dependencies on both folders</p>

<b>(folder: pwa)</b>
<p>You'll have to be in the folder directory</p>

```
cd pwa
```

<p>Then execute the command below to install dependencies</p>

```
npm install
```

<b>(folder: api)</b>

<p>Go to the Laravel folder dir, but have to go out from the current dir. Just execute the command below.</p>

```
cd .. && cd api
```

<p>Run the command and let it finish installing dependencies</p>

```
composer install
```

<b><u>Step 3</u></b>
<p>Copy the example env to create and .env file</p>

```
cp .env.example .env
```

<p>Then set it up as follows</p>

```
DB_CONNECTION=sqlite

(remove) DB_HOST=127.0.0.1
(remove) DB_PORT=3306
(remove) DB_DATABASE=laravel
(remove) DB_USERNAME=root
(remove) DB_PASSWORD=
```

<b><u>Step 4</u></b>
<p>Set a key in Laravel folder</p>

```
php artisan generate:key
```

<b><u>Step 5</u></b>
<p>Set up SQLite database. The command below creates a file in your database dir inside the Laravel proj folder</p>

```
touch api/database/database.sqlite
```

<b><u>Step 6</u></b>
<p>Run the migrations with seed</p>

```
php artisan migrate:fresh --seed
```

<b><u>Step 7</u></b>
<p>You can now open the Nuxt js front end by executing the command. But be sure you have to be in the /pwa dir. If you are still in the Laravel dir, run this command in terminal <code>cd .. && cd pwa</code></p>

```
npm run start
```

<p>You can start serving the Laravel API for the Cross Origin requests it will make</p>

```
php artisan serve
```
