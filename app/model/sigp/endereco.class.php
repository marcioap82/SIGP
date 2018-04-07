<?php
class Pessoa extends TRecord
{
    const TABLENAME = 'endereco';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
    /**
     * Constructor method
     */
        public function __construct($id = NULL)
        {
            parent::__construct($id);
            parent::addAttribute('rua');
            parent::addAttribute('cep');
            parent::addAttribute('bairro');
            parent::addAttribute('id_pessoa');
        }
    }
