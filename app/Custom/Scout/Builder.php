<?php

namespace App\Custom\Scout;

class Builder extends \Laravel\Scout\Builder
{
    /**
     * Add a constraint to the search query.
     *
     * @param  string  $field
     * @param  string $operator
     * @param  mixed  $value
     * @return $this
     */
    public function where($field, $operator = '=', $value = null)
    {
        $this->wheres[$field] = [
            'operator' => $operator,
            'value' => $value
        ];

        return $this;
    }
}
