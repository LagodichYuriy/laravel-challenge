<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class City
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class City extends Model
{
	protected $fillable = ['region_id', 'name'];

	protected $hidden = ['created_at', 'updated_at'];

	public function region()
	{
		return $this->belongsTo(Region::class);
	}
}
