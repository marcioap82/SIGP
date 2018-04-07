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
        $this->notebook->setSize(600, 200);
        $this->form->add($this->notebook);
        $page1 = new TTable;
        $page2 = new TTable;
        $page1->style = 'padding: 10px';
        $page2->style = 'padding: 10px';
         // adds two pages in the notebook
        $this->notebook->appendPage('Dados Pessoais', $page1);
        $this->notebook->appendPage('Endereço', $page2);
        $nome = new TEntry('nome');
        
        $nome->setTip('informe seu nome completo');
        $nome->setSize(400);
        $rg = new TEntry('rg');
        $rg->setTip('informe seu RG civil');
        $cpf = new TEntry('cpf');
        $datanasc = new TDate('datanasc');
       
        //$datanasc->setMask('dd/mm/yyyy');
         $datanasc->setValue('07/03/1982');
        $cpf->setTip('informe seu cpf sem pontos,apenas o numero');
        $page1->addRowSet(new TLabel('Nome'), $nome );
        $page1->addRowSet(new TLabel('RG'), $rg );
        $page1->addRowSet(new TLabel('CPF'), $cpf);
        $page1->addRowSet(new TLabel('Data de Nascimento'),$datanasc);
        
        
        $button1 = new TButton('action1');
        $button1->setAction(new TAction(array($this, 'onSalvar')), 'Salvar');
        $button1->setImage('fa:check-circle-o green');
        
       
         
          $panel = new TPanelGroup('Cadastro de Pessoa');
          $panel->add($this->form);
          $panel->addFooter($button1);
          
          $vbox = new TVBox;
          $this->form->setFields(array($nome, $rg, $cpf, $button1, $datanasc));
          //$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
          $vbox->add($panel);
          
           parent::add($vbox);
        
        
     }
     
      public function onSalvar()
    {
       try{
        TTransaction::open('sigp');
        
        $data = $this->form->getData('Pessoa');
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
