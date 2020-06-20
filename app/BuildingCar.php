<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class CitizenCar
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class BuildingCar extends Model
{
	protected $fillable = ['building_id', 'car_id'];

	protected $hidden = ['created_at', 'updated_at'];

	public function building()
	{
		return $this->belongsTo(Building::class);
	}

	public function car()
	{
		return $this->belongsTo(Car::class);
	}
}
