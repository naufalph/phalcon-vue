<?php

namespace MyApp\Models;

use Phalcon\Mvc\Model;

class Patients extends Model
{
    public $id, $name, $sex, $religion,  $phone,  $address, $nik;
  
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalconApp");
        $this->setSource("Patients");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Patients[]|Patients|\Phalcon\Mvc\Model\ResultSetInterface
     */

}
