<?php

namespace App\Services\Csp\Policies;

use \Spatie\Csp\Directive;
use \Spatie\Csp\Policies\Basic;

class ContentPolicy extends Basic
{
    public function configure()
    {
        parent::configure();
        
        $this->addDirective(Directive::SCRIPT, '*.jquery.com');
        $this->addDirective(Directive::SCRIPT, '*.jsdelivr.net');
        $this->addDirective(Directive::SCRIPT, 'unpkg.com');

        $this->addDirective(Directive::SCRIPT, 'unsafe-eval');
        
        $this->addDirective(Directive::STYLE, '*.jsdelivr.net');
        $this->addDirective(Directive::STYLE, '*.googleapis.com');
        
        $this->addDirective(Directive::IMG, '*.webshopapp.com');

        $this->addDirective(Directive::FONT, '*.gstatic.com');

        $this
        ->addDirective(Directive::SCRIPT, 'self')
        ->addDirective(Directive::STYLE, 'self')
        ->addNonceForDirective(Directive::SCRIPT)
        ->addNonceForDirective(Directive::STYLE);
    }
}