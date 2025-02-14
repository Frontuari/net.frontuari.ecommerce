# PASOS PARA LA INSTALACIÓN

## Instalación inicial
* git clone https://github.com/wmcarlosv/e-commerce-bio.git
* cd e-commerce-bio
* chmod -R 777 storage
* composer install

## Configuración de la Base de datos
* cp .env.example .env
* configurar los datos de la base de datos en el archivo .env
* php artisan key:generate
* php artisan migrate

## Configuración del Voyager
* En el archivo .env Verificar la linea: APP_URL=http://localhost:8000 
* Considerar que debe poseer el puerto para que funcionen las imagenes en Voyager.
* Ejecutar: php artisan voyager:install
* Crear un usuario: php artisan voyager:admin TUCORREO --create
* Iniciar el servidor: php artisan serve
* Acceder con tu usuario y contraseña a traves de http://127.0.0.1:8000/admin

## Instalación del passport
* php artisan passport:install

## Webpack para las vistas
* npm install
* npm run dev

## Configuración del servidor

## INSTALAR ESTO SI EL VOYAGGER YA TIENE LA BASE DE DATOS IMPORTADA
php artisan vendor:publish --provider="TCG\Voyager\VoyagerServiceProvider" --tag=voyager_assets
## CREAR EL ARCHIVO STORAGE

php artisan storage:link



### si no conoce el postgresql (Windows)
* activar la extensión pdo_pgsql y pgsql en el php.ini

### si no conoce el postgresql (Linux)
* apt-get install php-pgsql

### error en el htaccess (Windows)
* activar el mod_rewrite en el httpd.conf

### error en el htaccess (Linux)
* sudo a2enmod rewrite

### SOLUCION A ERRORES

* Voyager

* Colocar => ? en :
projectfolder\vendor\tcg\voyager\routes\voyager.php
Add ? infornt of {id} as {id?} 

* Colocar => ? en :
/var/www/html/e-commerce-bio/vendor/tcg/voyager/resources/views/menus/browse.blade.php  Linea 110
$(this).data('id?')
* Reemplazar la linea por esto:
resources/views/tools/bread/edit-add.blade.php
Linea 376
 '_field_trans' => $dataRow ? get_field_translations($dataRow,'display_name') : json_encode([config('voyager.multilingual.default') => ucwords(str_replace('_', ' ', $data['field']))]),