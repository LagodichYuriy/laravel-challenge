<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

use DB;

/**
 * Class BuildingTenant
 *
 * @package App
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class BuildingTenant extends Model
{
	protected $fillable = ['building_id', 'citizen_id'];

	protected $hidden = ['created_at', 'updated_at'];

	public function building() { return $this->belongsTo(Building::class); }
	public function citizen()  { return $this->belongsTo(Citizen::class);  }
}
