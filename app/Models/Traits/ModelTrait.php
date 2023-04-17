<?php

namespace App\Models\Traits;


trait ModelTrait
{
    /**
     * @return bool
     */
    public function checkRelationship(): bool
    {
        if (isset($this->listRelationships)) {
            foreach ($this->listRelationships as $relationship) {
                if (count($this->$relationship)) {
                    return false;
                }
            }
            return true;
        }
    }
}
