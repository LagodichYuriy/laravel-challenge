<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Country
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Country extends Model
{
	const ID_CANADA = 124; # ISO 3166-1

	protected $fillable = ['id', 'name', 'code', 'code_long'];

	protected $hidden = ['created_at', 'updated_at'];
}
