<?php

    return [
        'users'   =>
            [
                'administrator' => 'Cuenta de Administrador. Está cuenta tiene más privilegios',
                'deleted'       => 'Usuario borrado',
                'disabled'      => 'Cuenta de usuario desactivada',
                'edit_user'     => 'Editar usuario',
                'edit'          =>
                    [
                        '2fa_disabled'        => 'Autentificación de dos factores desactivada',
                        '2fa_enabled'         => 'Autentificación de dos factores activada',
                        '2fa_user'            => 'Sólo el usuario puede habilitar la autentificación de dos factores, porque se tiene que configurar en cuentas propias del usuario de apps de autentificación.',
                        '2fa_warning'         => 'Advertencia: Desactivar la autentificación de dos factores borrará el token secreto de este usuario. El usuario deberá volver a configurar sus apps de autentificación si quieren volver a habilitar la autentificación de dos factores.',
                        'account_disabled'    => 'Cuenta desactivada',
                        'account_enabled'     => 'Cuenta activada',
                        'delete'              => 'Borrar usuario',
                        'delete_confirmation' => '¿Estás seguro de que quieres borrar esta cuenta de :site? Esta acción no se puede deshacer',
                        'deletion_warning'    => 'Advertencia: El borrado de la cuenta de :user no puede deshacerse. Todas las imágenes de este usuario serán borradas permanentemente en 3 días',
                        'errors_occurred'     => 'Ha ocurrido un error. Por favor corrige este error.|Han ocurrido varios errores, por favor corrígelos.',
                        'title'               => 'Editar usuario: :name',
                        'updated'             => 'Información del usuario actualizada',
                        'new_password_help'   => 'Deja este campo vacío para no actualizar la contraseña del usuario.',
                        'save'                => 'Guardar',
                        'preferences'         =>
                            [
                                'updated'                               => 'Preferencias actualizadas',
                                'embed_name_help'                       => 'Varias aplicaciones de chat pueden mostrar una previsualización de imágenes en su propia interfaz. Esto también incluye el nombre del autor en la vista enmarcada. Este nombre puede ser cambiado.',
                                'embed_name_url'                        => 'URL asociada al nombre de la previsualización',
                                'embed_name_url_help'                   => 'Cuando el nombre del autor es mostrado, es posible asociar un enlace a una URL cualquiera, que se abrirá cuando alguien haga click en su nombre.',
                                'save'                                  => 'Guardar',
                                'title'                                 => 'Preferencias',
                                'twitter_username'                      => 'Cuenta de Twitter',
                                'twitter_username_help'                 => 'Es posible compartir enlaces en Twitter. Estas imágenes serán previsualizadas en Twitter cards, estas tarjetas pueden ser asociadas a tu propia cuenta de Twitter.',
                                'default_url_exclude_gallery_extension' => 'Enlazar directamente a la imagen por defecto',
                                'default_url_help'                      => 'Es posible obtener la URL de la página de previsualización de la imagen después de subirla, o directamente de la propia imagen.',
                                'default_url_include_gallery_extension' => 'Enlazar a la previsualización de la imagen por defecto',
                                'embed_name'                            => 'Mostrar nombre añadido a las imágenes previsualizadas',
                                'no_domains_available'                  => 'No hay dominios disponibles',
                                'default_domain'                        => 'Dominio por defecto',
                                'default_deletion_time'                 =>
                                    [
                                        'days'    => 'Días',
                                        'help'    => 'Es posible borrar automáticamente imágenes subidas después de cierto tiempo. Si rellenas todos los campos con 0, esta función será desactivada. Es posible cambiar el tiempo de borrado de cada imagen después.',
                                        'hours'   => 'Horas',
                                        'minutes' => 'Minutos',
                                        'months'  => 'Meses',
                                        'name'    => 'Tiempo de borrado por defecto',
                                        'years'   => 'Años',
                                    ],
                            ],
                        'reset_upload_token'  => 'Resetear token de subida',
                        'upload_token_reset'  => 'El token de subida ha sido reseteado',
                    ],
                'id'            => 'ID',
                'last_login'    => 'Última vez visto',
                'no_users'      => 'No hay usuarios',
                'title'         => 'Usuarios',
                'username'      => 'Nombre de usuario',
                'new_user'      => 'Nuevo usuario',
                'new'           =>
                    [
                        'create'  => 'Crear',
                        'created' => 'Nuevo usuario añadido: :user, con contraseña \':password\'',
                        'title'   => 'Nuevo usuario',
                    ],
            ],
        'domains' =>
            [
                'added'            => 'Dominio añadido',
                'create'           => 'Añadir',
                'delete_domain'    => 'Borrar dominio',
                'deleted'          => 'Dominio borrado',
                'domain'           => 'Dominio',
                'errors_occurred'  => 'Ha ocurrido un error. Por favor corrige este error.|Han ocurrido varios errores, por favor corrígelos.',
                'id'               => 'ID',
                'name'             => 'Nombre',
                'no_domains'       => 'No hay dominios',
                'owner'            => 'Dueño',
                'protocol'         =>
                    [
                        'http'     => 'http',
                        'https'    => 'https',
                        'protocol' => 'Protocolo',
                    ],
                'title'            => 'Dominios',
                'delete'           => 'Borrar dominio',
                'deletion_warning' => 'El proceso de borrado de un dominio no puede ser deshecho. Los dominios pueden volver a ser añadidos.',
            ],
    ];
