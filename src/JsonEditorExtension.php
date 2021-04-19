<?php

namespace GiocoPlus\JsonEditor;

use GiocoPlus\Admin\Extension;

class JsonEditorExtension extends Extension
{
    public $name = 'json-editor';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';
}
