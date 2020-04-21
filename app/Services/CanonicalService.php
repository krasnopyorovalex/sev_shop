<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CanonicalService
 * @package App\Services
 */
class CanonicalService
{
    /**
     * @param Model $entity
     * @return Model
     */
    public function check(Model $entity): Model
    {
        $numberPage = (int) request('page');

        if ($numberPage) {
            $entity->title .= " - страница №{$numberPage}";
            $entity->description .= " - страница №{$numberPage}";
        }

        return $entity;
    }

}
