<?php


//--------------------------------------------------------------------------
// Artist Permit
//--------------------------------------------------------------------------

// Artist Permit 
Breadcrumbs::for('admin.artist_permit.index', function ($trail) {
    $trail->push('Artist Permit', route('admin.artist_permit.index'));
});

//Artist Permit New Request
Breadcrumbs::for('admin.artist_permit.request', function($trail){
    $trail->push('Artist Permit Request List', route('admin.artist_permit.request'));
});

//Artist List
Breadcrumbs::for('admin.artist.index', function($trail){
    $trail->push('Artist List', route('admin.artist.index'));
});

//Artist Permit > Application details
Breadcrumbs::for('admin.artist_permit.applicationdetails', function ($trail, $permit) {
    $trail->parent('admin.artist_permit.index');
    $trail->push(ucwords($permit->company->company_name) , route('admin.artist_permit.applicationdetails', $permit->permit_id));
});

//Artist Permit > Application approval
Breadcrumbs::for('admin.artist_permit.approval', function ($trail, $permit) {
    // dd($permit);
    $trail->parent('admin.artist_permit.applicationdetails', $permit);
    $trail->push('Application Approval', route('admin.artist_permit.approval', $permit->permit_id));
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


// Permit Duration
Breadcrumbs::for('permit_duration.index', function ($trail) {
    $trail->push('Permit Duration List', route('permit_duration.index'));
});

// Permit Duration > Create
Breadcrumbs::for('permit_duration.create', function ($trail) {
    $trail->parent('permit_duration.index');
    $trail->push('New Permit Duration', route('permit_duration.create'));
});

//Procedure > Index
Breadcrumbs::for('procedure.index', function($trail){
    $trail->push('New Procedure', route('procedure.create'));
});

//Procedure > Create
Breadcrumbs::for('procedure.create', function($trail){
     $trail->parent('procedure.index');
    $trail->push('New Procedure', route('procedure.create'));
});




//--------------------------------------------------------------------------
// Dashboard
//--------------------------------------------------------------------------

//Dashboard
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});


