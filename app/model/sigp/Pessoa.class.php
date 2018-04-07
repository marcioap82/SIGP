<?php
class Pessoa extends TRecord
{
    const TABLENAME = 'Pessoa';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
    /**
     * Constructor method
     */
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        parent::addAttribute('nome');
        parent::addAttribute('rg');
        parent::addAttribute('cpf');
        parent::addAttribute('id_pessoa');
      }
    }
