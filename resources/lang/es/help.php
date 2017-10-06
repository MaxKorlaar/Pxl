<?php

    return [
        'setup' =>
            [
                'sharex' =>
                    [
                        'heading'         => 'Configurando ShareX',
                        'log_in'          => 'Inicia sesión para ver la configuración personalizada para ShareX.',
                        'instructions'    => 'El soporte para la aplicación ShareX (para Windows) está directamente integrado en Pxl. Es una aplicación muy avanzada y gratuita que se integra muy bien con Pxl. Es muy fácil de configurar para funcionar con Pxl.',
                        'custom_uploader' => 'Para configurar ShareX en conjunto de Pxl, debes de seguir las siguientes instrucciones:<ol>
<li>Abre ShareX y selecciona Destinaciones en la parte izquierda de la ventana</li>
<li>Pulsa en configuración de destinación</li>
<li>Baja en la lista de la izquierda y pulsa en \'Cargadores personalizados\'</li>
<li>Haz click en el botón de \'Importar\' y selecciona \'Desde URL...\'</li>
<li>Copia el enlace mostrado debajo de estas instrucciones y haz click en OK</li>
<li>Revisa que el nombre del cargador de imágenes sea \':uploader_name\' y cierra la ventana</li>
<li>En la ventana principal de ShareX, selecciona destinaciones en la parte izquierda de la ventana, después selecciona cargador de imágenes, y haz click en \'Cargador de imágenes personalizado\'</li></ol>',
                    ],
                'title'  => 'Instalando',
                'curl'   =>
                    [
                        'heading'      => 'Usando cURL',
                        'instructions' => 'Es posible subir archivos usando cURL en tu terminal en Mac y Linux. Para ello, se requieren los parámetros \'user\', \'upload-token\' y \'file\', que están explicados debajo en la categoría de \'Subidor personalizado\'. También es importante que uses el header \'Accept: application/json\', porque si no serás redireccionado a la página principal si ocurre un error.',
                    ],
                'data'   =>
                    [
                        'heading'      => 'Subidor personalizado',
                        'instructions' => 'Para usar un subidor personalizado, se requieren los siguiente parámetros en tu petición:',
                        'file'         => 'Esta es la imagen que quieres subir',
                        'log_in'       => 'Inicia sesión para ver esto',
                        'method'       => 'Método HTTP',
                        'name'         => 'Este campo no es necesario. Si este campo está presente, su valor se usará para nombrar la imagen en vez de usar el nombre del archivo. El nombre de la imagen puede ser visto en tu Galería y al compartir la página de previsualización de tu imagen.',
                        'target'       => 'URL',
                        'target_help'  => 'Usa el header \'Accept: application/json\' para recibir todos los errores en JSON. Si no te es posible cambiar los headers, puedes añadir \'?return=json\' a la URL. Si no necesitas recibir el enlace de una imagen en una petición JSON, añade \'?return=json_on_error\' para sólo recibir el link de la imagen cuando se suba correctamente.',
                    ],
            ],
    ];
