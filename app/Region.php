<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Region
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Region extends Model
{
	protected $fillable = ['country_id', 'name', 'code'];

	protected $hidden = ['created_at', 'updated_at'];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
