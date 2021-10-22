<?php

namespace Core\Html;

/**
 * Classe permettant de générer des formulaires
 */

class Form
{
    /**
     * Undocumented variable
     *
     * @var [array] données utilisé par le formulaire
     */
    private $data;

    /**
     * Undocumented variable
     *
     * @var string Tag utilisé pour entourer les champs
     */
    public $surround = 'p';

    /**
     * Undocumented function
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Undocumented function
     *
     * @param [string] $html Code HTML à entourer
     * @return string
     */
    private function surround($html)
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * Undocumented function
     *
     * @param [string] $index L'index de la valeur a recuperer
     * @return string
     */
    private function getValue($index)
    {
        if(is_object($this->data))
        {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;  
    }

    /**
     * Undocumented function
     *
     * @param [] $name Input name
     * @return string
     */
    public function input($name, $label = null, $placeholder = null, $options = [])
    {   
        $name = htmlspecialchars($name, ENT_QUOTES);
        $label = htmlspecialchars($label, ENT_QUOTES);
        $placeholder = htmlspecialchars($placeholder, ENT_QUOTES);

        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = "<label for='{$name}'>{$label}</label>";
        if($type === 'textarea')
        {
            $input = "<textarea name='{$name}'>{$this->getValue($name)}</textarea>";
        }
        else {
            $input = "<input type='{$type}' name='{$name}' placeholder='{$placeholder}' value='{$this->getValue($name)}'>";
        }
        return $label . $input;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function submit($value)
    {
        return "<button type='submit'>{$value}</button>";
    }

    public function select($name, $label, $options)
    {
        $label = htmlspecialchars($label, ENT_QUOTES);
        $input = "<select name={$name}>";
        foreach($options as $key =>$value)
        {
            $attributes = '';
            if($key == $this->getValue($name))
            {
                $attributes = 'selected';
            }
            $input .= "<option {$attributes} value='{$key}'>{$value}</option>";
        }
        $input .= "</select>";
        return $label . $input;
    }
}