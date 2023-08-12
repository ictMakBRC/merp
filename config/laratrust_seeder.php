<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'SuperAdmin' => [
            'employee' => 'm,c,r,u,d',
            'inventory'=>'m,c,r,u,d',
            'assets' => 'm,c,r,u,d'
        ],
        'HrAdmin' => [
            'employee' => 'm,c,r,u,d,x',
        ] ,
        'HrSupervisor' => [
            
            'employee' => 'm,c,r,u,a',
        ],

        'HrUser' => [
            
            'employee' =>'c,r,u' ,
        ],
        'AssetsAdmin' => [
            'assets'=>'m,c,r,u,d' , 
        ],
        'AssetsUser' => [
            'assets' => 'c,r,u',
        ]
        ,
        'InvAdmin' => [
            'inventory' =>'m,c,r,u,d,a',
        ],
        'InvSupervisor' => [
            'inventory'=>'a,c,r,u,d',
            
        ],
        'InvUser' => [
            'inventory'=>'c,r,u,d' ,
            
        ]
       
    ],

    'permissions_map' => [
        'm' => 'manage',
        'a' => 'approve',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'x' => 'accept'
    ]
];
