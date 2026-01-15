<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\Region;
use App\Models\District;

class ImportGeoNames extends Command
{
    protected $signature = 'import:geonames';
    protected $description = 'Import countries, Tanzania regions and districts from GeoNames';

    public function handle()
    {
        $this->importCountries();
        $this->importTanzaniaLocations();

        $this->info('✅ GeoNames import completed successfully.');
    }

    /**
     * IMPORT COUNTRIES
     */
    private function importCountries()
    {
        $path = storage_path('app/imports/countryInfo.txt');

        if (!file_exists($path)) {
            $this->error('❌ countryInfo.txt not found');
            return;
        }

        $lines = file($path);

        foreach ($lines as $line) {
            if (str_starts_with($line, '#')) continue;

            $data = explode("\t", trim($line));

            Country::updateOrCreate(
                ['iso_code' => $data[0]],
                [
                    'name' => $data[4],
                    'nationality' => $data[5] ?? null,
                ]
            );
        }

        $this->info('✔ Countries imported');
    }

    /**
     * IMPORT TANZANIA REGIONS & DISTRICTS
     */
    private function importTanzaniaLocations()
    {
        $country = Country::where('iso_code', 'TZ')->first();

        if (!$country) {
            $this->error('❌ Tanzania not found in countries table');
            return;
        }

        $path = storage_path('app/imports/TZ.txt');

        if (!file_exists($path)) {
            $this->error('❌ TZ.txt not found');
            return;
        }

        $lines = file($path);

        // STEP 1: IMPORT REGIONS (ADM1)
        $regionMap = [];

        foreach ($lines as $line) {
            $data = explode("\t", trim($line));

            if (($data[7] ?? null) === 'ADM1') {
                $admin1Code = $data[10]; // admin1_code
                $region = Region::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'admin1_code' => $admin1Code,
                    ],
                    [
                        'name' => $data[1],
                        'geoname_id' => $data[0],
                    ]
                );

                $regionMap[$admin1Code] = $region->id;
            }
        }

        // STEP 2: IMPORT DISTRICTS (ADM2)
        foreach ($lines as $line) {
            $data = explode("\t", trim($line));

            if (($data[7] ?? null) === 'ADM2') {
                $admin1Code = $data[10]; // admin1_code

                if (!isset($regionMap[$admin1Code])) continue;

                District::updateOrCreate(
                    [
                        'geoname_id' => $data[0],
                    ],
                    [
                        'name' => $data[1],
                        'region_id' => $regionMap[$admin1Code],
                    ]
                );
            }
        }

        $this->info('✔ Tanzania regions & districts imported');
    }
}
