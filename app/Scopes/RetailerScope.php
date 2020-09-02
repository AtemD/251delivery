<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class RetailerScope implements Scope
{
	public function apply(Builder $builder, Model $model)
	{
		$builder->role('retailer');
	}
}