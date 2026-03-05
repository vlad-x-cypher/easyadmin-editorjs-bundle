<?php

namespace VladX\EasyadminEditorjsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyadminEditorjsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
