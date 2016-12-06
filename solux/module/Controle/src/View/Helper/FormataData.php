<?php
namespace Controle\View\Helper;
use Zend\View\Helper\AbstractHelper;

class FormataData extends AbstractHelper
{
    public function __invoke($data)
    {
        $dados = explode("-", $data);         
       
        return $dados[2] . "/" . $dados[1] . "/" . $dados[0];
    }
}