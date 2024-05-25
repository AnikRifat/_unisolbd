<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ApplyPriceModifierScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $customerGroup = Auth::check() ? Auth::user()->customerGroups?->first() : null;

        if ($customerGroup && isset(json_decode($customerGroup->rules, true)['discount'])) {
            // Apply the discount to the selling price
            $discount = json_decode($customerGroup->rules, true)['discount'];
            $builder->select('*')->selectRaw('selling_price * (1 - ? / 100) as discount_price', [$discount]);
        }
    }
}
