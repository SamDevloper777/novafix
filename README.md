# NovaFix Update Guide

## Steps to Apply Fix

### Step 1: Install Dependencies
Run the following command to install necessary dependencies:
```sh
composer install
```

### Step 2: Modify `AppServiceProvider.php`
Navigate to `app/Providers/AppServiceProvider.php` and comment out the following lines:
```php
// view()->share('dateFilter','All');
// view()->share('search_value','');
// view()->share('Types',Type::all());
// view()->share('NewCountReq',RequestModel::where('technician_id',NULL)->get()->count());
// view()->share('ConformCountReq',RequestModel::where('status',1)->get()->count());
// view()->share('RejectedCountReq',RequestModel::where('status',3)->get()->count());
// view()->share('WorkdoneCountReq',RequestModel::where('status',4)->get()->count());
// view()->share('DeliveredCountReq',RequestModel::where('status',5)->get()->count());
// view()->share('PendingCountReq',RequestModel::where('status',0)->get()->count());
// view()->share('allReq',RequestModel::all()->count());
```

## Notes
- Ensure you have the latest version of Composer installed before running `composer install`.
- If you face any issues, check the Laravel logs for debugging: `storage/logs/laravel.log`.
- These changes will prevent global sharing of certain variables within views.

## License
This project is licensed under the MIT License.

