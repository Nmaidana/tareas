<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'tarea' => [
        'title' => 'Tareas',

        'actions' => [
            'index' => 'Tareas',
            'create' => 'New Tarea',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            
        ],
    ],

    'dependencia' => [
        'title' => 'Dependencias',

        'actions' => [
            'index' => 'Dependencias',
            'create' => 'New Dependencia',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            
        ],
    ],

    'item' => [
        'title' => 'Items',

        'actions' => [
            'index' => 'Items',
            'create' => 'New Item',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'tarea_id' => 'Tarea',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];