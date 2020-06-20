<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Building
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Building extends Model
{
	protected $fillable = ['street_id', 'building_number'];

	protected $hidden = ['created_at', 'updated_at'];

	public function street()
	{
		return $this->belongsTo(Street::class);
	}

	public function tenants()
	{
		return $this->hasMany(BuildingTenant::class, 'building_id', 'id');
	}
}
