## Instalación
1. Ir al directorio raiz y ejecutar `composer install`
1. Ejecutar `php init` desde el directorio raiz  del proyecto y escoger el ambiente de desarrollo o producción, independientemente de que ambiente se escoja no inicializar los siguientes arcchivos:
    ```
    codeception-local.php
    main-local.php
    params-local.php
    ```
1. Abrir el archivo `common/config/main-local.php` y configurar las credenciales de la base de datos.
1. Crear los Hosts Virtuales para los directorios `frontend/web` y `backend/web` 
    ```
    <VirtualHost *:80>
        ServerName yii2-ecommerce.localhost
        DocumentRoot "/path/to/ecommerce-website/frontend/web/"
        
        <Directory "/path/to/ecommerce-website/frontend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>
    
    
    <VirtualHost *:80>
        ServerName backend.yii2-ecommerce.localhost
        DocumentRoot "/path/to/ecommerce-website/backend/web/"
        
        <Directory "/path/to/ecommerce-website/backend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>
    ```
1. Abrir el archivo `common/config/params-local.php`  y reemplazar su contenido en mi caso para desarrollo reemplace `frontendUrl` por:
    ```php
    <?php
    return [
      'frontendUrl' => 'http://localhost/comercio/frontend', 
    ];
    ```

## Traspilar assets
El proyecto usa webpack y para contruirlo los archivos de fuente estan en `frontend/scss` y `backend/js`.

#### Traspilar para producción
Ejecutar `npm run prod` 

