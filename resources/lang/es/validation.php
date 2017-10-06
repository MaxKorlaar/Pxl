<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | The following language lines contain the default error messages used by
        | the validator class. Some of these rules have multiple versions such
        | as the size rules. Feel free to tweak each of these messages here.
        |
        */

        'accepted'             => ':attribute debe ser aceptado.',
        'active_url'           => ':attribute no es una dirección URL válida.',
        'after'                => ':attribute debe ser una fecha después de :date.',
        'after_or_equal'       => ':attribute debe ser una fecha igual o después de :date.',
        'alpha'                => ':attribute sólo puede contener letras.',
        'alpha_dash'           => ':attribute sólo puede contener letras, números y guiones.',
        'alpha_num'            => ':attribute sólo puede contener letras y números.',
        'array'                => ':attribute debe ser una lista.',
        'before'               => ':attribute debe ser una fecha anterior al :date.',
        'before_or_equal'      => ':attribute debe ser una fecha igual o anterior al :date.',
        'between'              => [
            'numeric' => ':attribute debe estar entre :min y :max.',
            'file'    => ':attribute debe tener un peso entre :min y :max kilobytes.',
            'string'  => ':attribute debe tener una longitud entre :min y :max caracteres.',
            'array'   => ':attribute debe tener entre :min y :max ítems.',
        ],
        'boolean'              => ':attribute debe ser verdadero (true) o falso (false).',
        'confirmed'            => 'La confirmación y :attribute no coinciden.',
        'date'                 => ':attribute no es una fecha válida.',
        'date_format'          => ':attribute no sigue el formato :format.',
        'different'            => ':attribute y :other deben ser diferentes.',
        'digits'               => ':attribute debe tener :digits dígitos.',
        'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
        'dimensions'           => ':attribute tiene unas dimensiones de imagen no válidas.',
        'distinct'             => ':attribute tiene un valor duplicado.',
        'email'                => ':attribute debe ser una dirección email válida.',
        'exists'               => 'El atributo :attribute seleccionado no es válido.',
        'file'                 => ':attribute debe ser un archivo.',
        'filled'               => ':attribute debe ser rellenado.',
        'image'                => ':attribute debe ser una imagen.',
        'in'                   => 'El atributo :attribute seleccionado no es válido.',
        'in_array'             => 'El campo :attribute no existe en :other.',
        'integer'              => ':attribute debe ser un número entero.',
        'ip'                   => ':attribute debe ser una dirección IP válida.',
        'json'                 => ':attribute debe ser un texto JSON válida.',
        'max'                  => [
            'numeric' => ':attribute no debe ser mayor que :max.',
            'file'    => ':attribute no debe pesar más de :max kilobytes.',
            'string'  => ':attribute no debe tener más de :max caracteres.',
            'array'   => ':attribute no debe tener más de :max ítems.',
        ],
        'mimes'                => ':attribute debe ser un archivo de tipo: :values.',
        'mimetypes'            => ':attribute debe ser un archivo de tipo: :values.',
        'min'                  => [
            'numeric' => ':attribute no debe ser menor que :min.',
            'file'    => ':attribute debe pesar más de :min kilobytes.',
            'string'  => ':attribute no debe tener menos de :min caracteres.',
            'array'   => ':attribute no debe tener menos de :min ítems.',
        ],
        'not_in'               => 'El valor :attribute seleccionado no es válido.',
        'numeric'              => ':attribute debe ser un número.',
        'present'              => 'El campo :attribute debe estar presente.',
        'regex'                => 'El formato de :attribute no es válido.',
        'required'             => 'El campo :attribute debe estar presente.',
        'required_if'          => 'El campo :attribute es necesario cuando :other es :value.',
        'required_unless'      => 'El campo :attribute es necesario mientras que :other no sea :values.',
        'required_with'        => 'El campo :attribute es necesario cuando :values está presente.',
        'required_with_all'    => 'El campo :attribute es necesario cuando :values está presente.',
        'required_without'     => 'El campo :attribute es necesario cuando :values no está presente.',
        'required_without_all' => 'El campo :attribute es necesario cuando ninguno de los valores de :values están presentes.',
        'same'                 => 'El campo :attribute y :other deben ser idénticos.',
        'size'                 => [
            'numeric' => ':attribute debe ser :size.',
            'file'    => ':attribute debe pesar :size kilobytes.',
            'string'  => ':attribute debe tener :size caracteres.',
            'array'   => ':attribute debe tener :size ítems.',
        ],
        'string'               => ':attribute debe ser un texto.',
        'timezone'             => ':attribute debe ser una zona horaria válida.',
        'unique'               => ':attribute ya ha sido seleccionado.',
        'uploaded'             => ':attribute no se ha podido subir.',
        'url'                  => 'El formato de :attribute no es válido.',

        /*
        |--------------------------------------------------------------------------
        | Custom Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | Here you may specify custom validation messages for attributes using the
        | convention "attribute.rule" to name the lines. This makes it quick to
        | specify a specific custom language line for a given attribute rule.
        |
        */

        'custom' => [
            'attribute-name' => [
                'rule-name' => 'custom-message',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Custom Validation Attributes
        |--------------------------------------------------------------------------
        |
        | The following language lines are used to swap attribute place-holders
        | with something more reader friendly such as E-Mail Address instead
        | of "email". This simply helps us make messages a little cleaner.
        |
        */

        'attributes' => [
            'password_confirmation'     => 'confirmación de contraseña',
            'current_password'          => 'contraseña actual',
            'new_password'              => 'nueva contraseña',
            'new_password_confirmation' => 'confirmación de nueva contraseña',
            'username'                  => 'nombre de usuario',
        ],

    ];
