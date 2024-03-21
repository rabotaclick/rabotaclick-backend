<?php declare(strict_types=1);

namespace App\Traits;

trait FilterDataTrait
{
    public function filterData(array $data): array
    {
        foreach($data as $key => $value) {
            if(is_null($value)) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
