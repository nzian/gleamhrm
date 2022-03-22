<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'name', 'brand', 'location', 'condition', 'entry_date', 'active', 'allocated'];

    public function alloctedAsstes()
    {
        return $this->hasMany(HandOverAsset::class, 'asset_id', 'id');
    }

    public function returnedAssets()
    {
        return $this->hasMany(ReturnedAsset::class, 'asset_id', 'id');
    }
    public static function isAsetAvailable($id)
    {
        $asset = self::find($id);
        return $asset->allocated == 1 ? false : true;
    }
}