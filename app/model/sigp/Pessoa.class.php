<?php
class Pessoa extends TRecord
{
    const TABLENAME = 'Pessoa';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
 
    /**
     * Constructor method
     */
   private $endereco;
     
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        parent::addAttribute('nome');
        parent::addAttribute('rg');
        parent::addAttribute('cpf');       
        parent::addAttribute('datanasc');
        parent::addAttribute('id_endereco');
        
      }
      
      public function set_endereco(endereco $object)
        {      
            $this->endereco = $object;
            $this->id_endereco = $object->id;
            
        }
        
        public function get_endereco()
        {
            // loads the associated object
            if (empty($this->endereco))
                $this->endereco = new endereco($this->id_endereco);
        
            // returns the associated object
            return $this->endereco;
        }
        
        
    }
