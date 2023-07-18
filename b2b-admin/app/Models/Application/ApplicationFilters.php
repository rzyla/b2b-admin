<?php

namespace App\Models\Application;

use Illuminate\Support\Facades\Session;

class ApplicationFilters
{
    private string $separator = '_';

    public function set(string $prefix, string $key, ?string $value, ?string $type = null)
    {
        session([$this->sessionKey($prefix, $key, $type) => $value]);
    }

    public function get(string $prefix, string $key, ?string $type = null)
    {
        return session($this->sessionKey($prefix, $key, $type));
    }

    public function getArray(string $prefix, ?string $type = null) : array
    {
        $array = [];
        $search = explode($this->separator, $this->sessionPartKey($prefix, $type));

        foreach(session()->all() as $key => $value)
        {
            $explode = explode($this->separator, $key);

            if((array_key_exists(0, $search) && array_key_exists(0, $explode) && $search[0] == $explode[0])
                && (array_key_exists(1, $search) && array_key_exists(1, $explode) && $search[1] == $explode[1])
                && array_key_exists(2, $explode))
            {
                $array[$explode[2]] = $value;
            }
        }

        return $array;
    }

    public function exists(string $prefix, string $key, ?string $type = null)
    {
        return array_key_exists($this->sessionKey($prefix, $key, $type), session()->all());
    }

    private function sessionKey(string $prefix, string $key, ?string $type = null) : string
    {
        return empty($type) 
            ? $prefix . $this->separator . $key 
            : $prefix . $this->separator . $type . $this->separator . $key;
    }

    private function sessionPartKey(string $prefix, ?string $type = null) : string
    {
        return empty($type) 
            ? $prefix 
            : $prefix . $this->separator . $type;
    }
}