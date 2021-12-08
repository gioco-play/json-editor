<?php

namespace GiocoPlus\JsonEditor;

use GiocoPlus\Admin\Form\Field;
use GiocoPlus\Admin\Form\NestedForm;

class Editor extends Field
{
    protected $view = 'laravel-admin-json-editor::editor';

    protected static $css = [
        'vendor/laravel-admin-ext/json-editor/jsoneditor/dist/jsoneditor.min.css',
    ];

    protected static $js = [
        'vendor/laravel-admin-ext/json-editor/jsoneditor/dist/jsoneditor.min.js',
    ];

    public function render()
    {
        $json = old($this->column, $this->value());

        if (empty($json)) {
            $json = '{}';
        }

        if (!is_string($json)) {
            $json = json_encode($json);
        } else {
            $json = json_encode(json_decode($json));   //兼容json里有类似</p>格式，首次初始化显示会丢失的问题
        }
        $this->value = $json;

        $options = json_encode(config('admin.extensions.json-editor.config'));

        if (empty($options)) {
            $options = "{}";
        }

        $name = $this->variables()["name"];
        $defaultKey = NestedForm::DEFAULT_KEY_NAME;
        $this->script = <<<EOT
// create the editor
var {$name}="{$name}".replace(/{$defaultKey}/g, window.index);
var container = document.getElementById("{$name}");
var options = {$options};
window['editor_'+"{$name}"] = new JSONEditor(container, options);

// set json
var json = {$json};
window['editor_'+"{$name}"].set(json);

// get json
$('button[type="submit"]').click(function() {
var json = window['editor_'+"{$name}"].get()
$('input[id='+"{$name}"+'_input]').val(JSON.stringify(json))
});
EOT;

        return parent::render();
    }
}
