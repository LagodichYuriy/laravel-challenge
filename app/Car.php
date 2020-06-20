<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Car
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Car extends Model
{
	protected $fillable = ['color_id', 'brand_id', 'plate_number'];

	protected $hidden = ['created_at', 'updated_at'];

	public function color()
	{
		return $this->belongsTo(Color::class);
	}

	public function brand()
	{
		return $this->belongsTo(CarBrand::class);
	}

	public function buildingCar()
	{
		return $this->hasMany(BuildingCar::class);
	}
}
