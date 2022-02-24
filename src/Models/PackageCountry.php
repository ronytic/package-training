<?php

namespace ProcessMaker\Package\PackageTraining\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class PackageCountry extends Model
{
    protected $table = 'package_countries';

    protected $fillable = [
        'id', 'country', 'region', 'country_id', 'status'
    ];

    public static function store(Request $request)
    {
        $country = new self;
        $country->country = $request->input('country', '');
        $country->region = $request->input('region', '');
        $country->country_id = $request->input('country_id', '');
        $country->status = $request->input('status', '');
        $country->save();

        return $country;
    }


    public function updatePackageCountry(Request $request)
    {
        $this->country = $request->input('country', $this->country);
        $this->region = $request->input('region', $this->region);
        $this->country_id = $request->input('country_id', $this->country_id);

        $this->save();

        return $this;
    }

    public static function searchCountry($countryId)
    {
        $data = self::where('status', 'ENABLED')
            ->when($countryId != '', function ($query) use ($countryId) {
                return $query->where('country_id', $countryId);
            })
            ->get();
        return $data;
    }

    public static function getAll()
    {
        $data = self::where('status', 'ENABLED')
            ->get();
        return $data;
    }
}
