<?php
class CadastroPessoa extends TPage
{
    protected $form; // form
    protected $notebook;
    
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    public function __construct()
    {
        parent::__construct();
        $this->form = new TForm();
        
        $this->notebook = new BootstrapNotebookWrapper(new TNotebook);
        $this->notebook->setSize(700, 200);
        $this->form->add($this->notebook);
        $page1 = new TTable;
        $page1->style='border-color:#333; padding:1px 2px 3px 2px;';
        $page2 = new TTable;
        $imagem = new TImage('/images/adianti.png');
       
         // adds two pages in the notebook
        $this->notebook->appendPage('Dados Pessoais', $page1);
        $this->notebook->appendPage('Endereço', $page2);
        //dados pessoais
        $nome = new TEntry('nome');
        
        $nome->setTip('informe seu nome completo');
        $nome->setSize(400);
        $rg = new TEntry('rg');
        $rg->setTip('informe seu RG civil');
        $cpf = new TEntry('cpf');
        $datanasc = new TDate('datanasc');
        //dados de endereço
        $logradouro = new TEntry('logradouro');
        $logradouro->setSize(400);
        $cep = new TEntry('cep');
        $bairro = new TEntry('bairro');
        $numero = new TEntry('numero');
        $bairro->setSize(300);
      
        //$datanasc->setMask('dd/mm/yyyy');
         $datanasc->setValue('07/03/1982');
        $cpf->setTip('informe seu cpf sem pontos,apenas o numero');
        $page1->addRowSet(new TLabel('Nome'), $nome );
        $page1->addRowSet(new TLabel('RG'), $rg );
        $page1->addRowSet(new TLabel('CPF'), $cpf);
        $page1->addRowSet(new TLabel('Data de Nascimento'),$datanasc);
        //adiciona na pagian os dados de endereço
        $page2->addRowSet(new TLabel('LOGRADOURO:'), $logradouro);
        $page2->addRowSet(new TLabel('Cep:'), $cep);
        $page2->addRowSet(new TLabel('Bairro:'), $bairro);
        $page2->addRowSet(new TLabel('NUMERO:'), $numero);
        //validação dos campos 
        $nome->addValidation('NOME', new TRequiredValidator);
        $rg->addValidation('RG', new TRequiredValidator);
        $cpf->addValidation('CPF', new TRequiredValidator);
        $datanasc->addValidation('Data de Nascimento', new TRequiredValidator);
        $logradouro->addValidation('logradouro', new TRequiredValidator);
        $cep->addValidation('CEP', new TRequiredValidator);
        $bairro->addValidation('BAIRRO', new TRequiredValidator);
        $numero->addValidation('NUMERO', new TRequiredValidator);
                  
        $button1 = new TButton('action1');
        $button1->setAction(new TAction(array($this, 'onSalvar')), 'Salvar');
        $button1->setImage('fa:check-circle-o green');
        
       
         
          $panel = new TPanelGroup('Cadastro de Pessoa');
          $panel->add($this->form);
          $panel->addFooter($button1);
          
          $vbox = new TVBox;
          $this->form->setFields(array($nome, $rg, $cpf, $button1, $datanasc,$logradouro, $cep, $bairro, $numero));
          $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
          $vbox->add($panel);
          
           parent::add($vbox);
        
        
     }
     
      public function onSalvar()
    {
       try{
        TTransaction::open('sigp');
         
        $data = $this->form->getData('Pessoa');
        $endereco = new endereco;
        $endereco->logradouro = $data->logradouro;
        $endereco->cep = $data->cep;
        $endereco->numero = $data->numero;
        $endereco->bairro = $data->bairro;
        $endereco->store();
        $data->endereco = $endereco;            
        $data->store(); 
        $this->form->setData($data);     
        
        new TMessage('info','Dados Armazenado com Sucesso');
        TTransaction::close();
        }catch(Exception $e)
        {
            new TMessage('erro', $e->getMessage());
        }
    }
}
