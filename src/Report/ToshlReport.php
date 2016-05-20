<?php

namespace Laratoshl\Report;

use Laratoshl\Toshl;

/**
 * Class ToshlReport
 * @author Dnaiel Schmelz
 * @package Laratoshl
 */
class ToshlReport
{

    /**
     * @var null
     */
    public $Toshl = null;


    /**
     * ToshlReport constructor.
     * @param Toshl $Toshl
     */
    public function __construct(Toshl $Toshl)
    {
        $this->Toshl = $Toshl;
    }
        
    
}