<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->column('id')->type('number');

        $this->crud->column('name')
                ->label('Full Name')
                ->type('text')
                ->sortable(true);

        $this->crud->column('email')
                ->label('Email')
                ->type('email');

        // $this->crud->column('username')
        //         ->label('Username')
        //         ->type('text');

        $this->crud->column('role')
                ->label('Role')
                ->type('select_from_array')
                ->options(['user' => 'User', 'admin' => 'Admin']);

        $this->crud->column('created_at')
                ->label('Registered')
                ->type('datetime');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation();

        $this->crud->field('name')
                ->label('Full Name')
                ->type('text')
                ->sortable(true)
                ->required(true);
                



        $this->crud->field('email')
                ->label('Email')
                ->type('email')
                ->required(true);

        $this->crud->field('password')
                ->label('Password')
                ->type('password')
                ->required(true)
                ->hint('Minimum 8 characters');

        $this->crud->field('role')
                ->label('Role')
                ->type('select_from_array')
                ->options(['user' => 'User', 'admin' => 'Admin'])
                ->default('user')
                ->required(true);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->removeField('password'); // don't show by default

        $this->crud->addField([
            'name'  => 'password',
            'label' => 'New Password (leave empty to keep current)',
            'type'  => 'password',
            'hint'  => 'Only fill if you want to change password',
        ]);
    }
}
