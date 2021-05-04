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

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach :date sein.',
    'alpha'                => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Zahlen und Bindestriche enthalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array'                => ':attribute muss ein Feld sein.',
    'before'               => ':attribute muss ein Datum vor :date sein.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'file'    => ':attribute muss zwischen :min und :max Kilobytes liegen.',
        'string'  => ':attribute muss zwischen :min und :max Buchstaben haben.',
        'array'   => ':attribute muss zwischen :min und :max Bestandteile haben.',
    ],
    'boolean'              => ':attribute Feld muss wahr oder falsch sein.',
    'confirmed'            => ':attribute Bestätigung stimmt nicht überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute stimmt nicht mit dem Format :format überein.',
    'different'            => ':attribute und :other müssen unterschiedlich sein.',
    'digits'               => ':attribute müssen :digits Ziffern sein.',
    'digits_between'       => ':attribute müssen zwischen :min und :max Ziffern sein.',
    'distinct'             => ':attribute Feld hat einen doppelten Wert.',
    'email'                => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'exists'               => 'gewählte :attribute ist ungültig.',
    'filled'               => ':attribute Feld ist erforderlich.',
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => 'selected :attribute ist ungültig.',
    'in_array'             => ':attribute Feld gibt es nicht in :other.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'ip'                   => ':attribute muss eine gültige IP-Adresse sein.',
    'json'                 => ':attribute muss ein gültiger JSON-String sein.',
    'max'                  => [
        'numeric' => ':attribute darf nicht größer als :max sein.',
        'file'    => ':attribute darf nicht größer als :max Kilobytes sein.',
        'string'  => ':attribute darf nicht länger als :max Buchstaben sein.',
        'array'   => ':attribute darf nicht mehr als :max Bestandteile haben.',
    ],
    'mimes'                => ':attribute muss eine Datei des Typs :values sein.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min Kilobytes haben.',
        'string'  => ':attribute muss mindestens :min Zeichen haben.',
        'array'   => ':attribute muss mindestens :min Bestandteile haben.',
    ],
    'not_in'               => 'gewählte :attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Nummer sein.',
    'present'              => ':attribute Feld muss vorhanden sein.',
    'regex'                => ':attribute Format ist ungültig.',
    'required'             => ':attribute Feld ist erforderlich.',
    'required_if'          => ':attribute Feld ist erforderlich, wenn :other :value ist.',
    'required_unless'      => ':attribute Feld ist erforderlich, bis :other in :values ist.',
    'required_with'        => ':attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all'    => ':attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_without'     => ':attribute Feld ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute Feld ist erforderlich, keine :values vorhanden sind.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size sein.',
        'file'    => ':attribute muss :size Kilobytes haben.',
        'string'  => ':attribute muss :size Zeichen haben.',
        'array'   => ':attribute muss :size Bestandteile haben.',
    ],
    'string'               => ':attribute muss ein String sein.',
    'timezone'             => ':attribute muss eine gültige Zone sein.',
    'unique'               => ':attribute ist schon benutzt worden.',
    'url'                  => ':attribute Format ist ungültig.',


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
        'up_18' => [
            'required' => 'Please confirm your +18 age ',
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

    'attributes' => [],

];
