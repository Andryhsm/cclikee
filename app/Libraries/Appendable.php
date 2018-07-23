<?php
namespace App\Libraries;


trait Appendable
{
    protected function getAppendable()
    {
        $arr = [];
        if (!method_exists($this, "getAppendKeys")) {
            return $arr;
        }
        foreach ($this->getAppendKeys() as $key) {
            $getter = 'get' . ucwords(snakeToCamel($key));
            if (method_exists($this, $getter)) {
                $arr[$key] = $this->$getter();
            } else {
                $getter = snakeToCamel($key);
                if (method_exists($this, $getter)) {
                    $arr[$key] = $this->$getter();
                }
            }

        }
        return $arr;
    }

}