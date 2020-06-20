<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Citizen
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Citizen extends Model
{
	protected $fillable = ['name', 'date_of_birth'];

	protected $hidden = ['created_at', 'updated_at'];

	public function buildingTenant()
	{
		return $this->hasMany(BuildingTenant::class, 'citizen_id', 'id');
	}

	public function cars()
	{
		return $this->hasMany(Car::class, 'car_id', 'id');
	}
}
