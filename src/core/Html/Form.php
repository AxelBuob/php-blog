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
        //$value = isset($options['value']) ? $options['value'] : '';

        $label = "<label class='mt-3 form-label' for='{$name}'>{$label}</label>";

        if($type === 'textarea')
        {
            $input = "<textarea class='form-control' name='{$name}'>{$this->getValue($name)}</textarea>";
        }
        elseif($type === 'password' || $type === 'email')
        {
            $input = "<input class='form-control'  type='{$type}' name='{$name}' placeholder='{$placeholder}'>";
        }
        elseif($type === 'hidden' && isset($options['value']))
        {
            $input = "<input class='form-control' type='{$type}' name='{$name}' value='{$options['value']}'>";
        }
        elseif($type === 'file')
        {
            $input = "<input class='form-control'  type='{$type}' name='{$name}'>";  
        }
        else {
            $input = "<input class='form-control' type='{$type}' name='{$name}' placeholder='{$placeholder}' value='{$this->getValue($name)}'>";
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
        return "<div class='my-3' ><button class='btn btn-warning text-uppercase fw-light' type='submit'>{$value}</button></div>";
    }

    public function select($name, $label, $options)
    {
        $label = htmlspecialchars($label, ENT_QUOTES);
        $input = "<select class='form-control' name={$name}>";
        $label = "<label class='mt-3 form-label' for='{$name}'>{$label}</label>";
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