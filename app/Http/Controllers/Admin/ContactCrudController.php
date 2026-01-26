<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Contact::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact');
        CRUD::setEntityNameStrings('contact', 'contacts');
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
                ->label('Name')
                ->type('text');

        $this->crud->column('email')
                ->label('Email')
                ->type('text');

        $this->crud->column('subject')
                ->label('Subject')
                ->type('text');

        $this->crud->column('message')
                ->label('Message')
                ->type('text')
                ->limit(100);

        $this->crud->column('date_sent')
                ->label('Date Sent')
                ->type('datetime');

        $this->crud->column('status')
                ->label('Status')
                ->type('text');

        $this->crud->addColumn([
            'name'      => 'user.name',
            'label'     => 'User',
            'type'      => 'text',
            'searchLogic' => function ($q, $column, $search) {
                $q->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            },
        ]);
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
                ->label('Name')
                ->type('text')
                ->required(true);

        $this->crud->field('email')
                ->label('Email')
                ->type('text')
                ->required(true);

        $this->crud->field('subject')
                ->label('Subject')
                ->type('text');

        $this->crud->field('message')
                ->label('Message')
                ->type('textarea')
                ->required(true);

        $this->crud->field('date_sent')
                ->label('Date Sent')
                ->type('datetime')
                ->default(now()->format('Y-m-d H:i:s'))
                ->required(true);

        $this->crud->field('status')
                ->label('Status')
                ->type('select_from_array')
                ->options(['pending' => 'Pending', 'answered' => 'Answered', 'closed' => 'Closed'])
                ->default('pending')
                ->required(true);

        $this->crud->addField([
            'name'        => 'user_id',
            'label'       => 'User',
            'type'        => 'select',
            'entity'      => 'user',
            'attribute'   => 'name',
            'model'       => 'App\Models\User',
            'allows_null' => true,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}