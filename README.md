#novafix
step:1-composer i
step:2-go to AppServiceProvider.php
comment this line  // view()->share('dateFilter','All');
        // view()->share('search_value','');
        // view()->share('Types',Type::all());
        // view()->share('NewCountReq',RequestModel::where('technician_id',NULL)->get()->count());
        // view()->share('ConformCountReq',RequestModel::where('status',1)->get()->count());
        // view()->share('RejectedCountReq',RequestModel::where('status',3)->get()->count());
        // view()->share('WorkdoneCountReq',RequestModel::where('status',4)->get()->count());
        // view()->share('DeliveredCountReq',RequestModel::where('status',5)->get()->count());
        // view()->share('PendingCountReq',RequestModel::where('status',0)->get()->count());
        // view()->share('allReq',RequestModel::all()->count());
