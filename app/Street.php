<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Street
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Street extends Model
{
	protected $fillable = ['city_id', 'name'];

	protected $hidden = ['created_at', 'updated_at'];

	public function city()
	{
		return $this->belongsTo(City::class);
	}
}
