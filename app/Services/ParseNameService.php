<?php

namespace App\Services;

class ParseNameService
{
    private $first;
    private $name;
    private $honorific;
    private $honorifics;
    private $last;
    private $middle;
    private $suffix;
    //private $suffixes;

    public function __construct(string $name)
    {
        $this->first = '';
        $this->honorific = '';
        $this->honorifics = ['dr','mr','mrs','ms','mx','sr'];
        $this->last = '';
        $this->middle = '';
        $this->name = $name;
        $this->suffix = '';
        //$this->suffixes = ['I','II','III','IV','Jr','Sr'];

        $this->init();
    }

    public function firstName(): Attribute
    {
        return $this->first;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function init()
    {
        $this->isolateSuffix();
        $this->isolateHonorific();

        $parts = explode(' ', $this->name);

        if(count($parts) === 2){

            $this->first = $parts[0];
            $this->last = $parts[1];
        }
    }

    private function isolateHonorific()
    {
        //value to look for
        $search = strtolower(substr($this->name,0,2));

        if(in_array($search, $this->honorifics)){

            $parts = explode(' ', $this->name);

            $this->honorific = ucfirst($search).'.';

        }
    }

    private function isolateSuffix()
    {
        if(strpos($this->name, ',')){

            $parts = explode(',', $this->name);

            //replace value without the suffix
            $this->name = $parts[0];

            //store the suffix
            $this->suffix = $parts[1];
        }
    }


}
