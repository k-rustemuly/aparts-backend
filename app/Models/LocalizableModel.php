<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class LocalizableModel extends Model {

    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = [];

    /**
     * Magic method for retrieving a missing attribute.
     *
     * @param string $attribute
     * @return mixed
     */
    public function __get($attribute)
    {
        if (in_array($attribute, $this->localizable)) {
            $localeSpecificAttribute = $attribute.'_'.App::currentLocale();
            return $this->{$localeSpecificAttribute};
        }
        return parent::__get($attribute);
    }
}
