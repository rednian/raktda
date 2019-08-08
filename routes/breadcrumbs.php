<?php


//--------------------------------------------------------------------------
// Artist Permit
//--------------------------------------------------------------------------

// Artist Permit 
Breadcrumbs::for('admin.artist_permit.index', function ($trail) {
    $trail->push('Artist Permit', route('admin.artist_permit.index'));
});

//Artist Permit > Application details
Breadcrumbs::for('admin.artist_permit.applicationdetails', function ($trail, $permit) {
    $trail->parent('admin.artist_permit.index');
    $trail->push(ucwords($permit->company->company_name) , route('admin.artist_permit.applicationdetails', $permit->permit_id));
});

//Artist Permit > Application check artist
Breadcrumbs::for('admin.artist_permit.checkApplication', function ($trail, $permit) {
    $trail->parent('admin.artist_permit.applicationdetails', $permit);
    $trail->push(ucwords($permit->artistpermit[0]->artist->name). ' Application details', route('admin.artist_permit.checkApplication', [
        'permit'=>$permit->permit_id, 
        'artist'=>$permit->artistpermit[0]->artist_id
    ]));
});




//--------------------------------------------------------------------------
// Settings
//--------------------------------------------------------------------------

//Permit Type
Breadcrumbs::for('permit_type.index', function ($trail) {
    $trail->push('Permit Type', route('permit_type.index'));
});

// Permit Type > Create
Breadcrumbs::for('permit_type.create', function ($trail) {
    $trail->parent('permit_type.index');
    $trail->push('New Permit Type', route('permit_type.create'));
});



//--------------------------------------------------------------------------
// Dashboard
//--------------------------------------------------------------------------

//Dashboard
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});


