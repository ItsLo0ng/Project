<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FontRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FontCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FontCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Font::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/font');
        CRUD::setEntityNameStrings('font', 'fonts');
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
                ->label('Font Name')
                ->type('text');

        $this->crud->addColumn([
            'name'      => 'category.name',
            'label'     => 'Category',
            'type'      => 'text',
            'searchLogic' => function ($q, $column, $search) {
                $q->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            },
        ]);

        $this->crud->column('designer')
                ->label('Designer')
                ->type('text');

        $this->crud->column('date_added')
                ->label('Date Added')
                ->type('date');

        $this->crud->addColumn([
            'name'      => 'user.name',
            'label'     => 'Uploaded by',
            'type'      => 'text',
        ]);

        // Optional: show number of files / images
        $this->crud->addColumn([
            'name'      => 'files_count',
            'label'     => 'Files',
            'type'      => 'number',
            'value'     => fn($entry) => $entry->files()->count(),
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
                ->label('Font Name')
                ->type('text')
                ->required(true);

        $this->crud->addField([
            'name'        => 'category_id',
            'label'       => 'Category',
            'type'        => 'select',          
            'entity'      => 'category',
            'attribute'   => 'name',
            'model'       => 'App\Models\FontCategory',
            'wrapper'     => ['class' => 'form-group col-md-6'],
            'allows_null' => false,            
            'default'     => null,
        ]);

        $this->crud->field('designer')
                ->label('Designer / Author')
                ->type('text');

        $this->crud->field('description')
                ->label('Description')
                ->type('textarea')
                ->hint('You can use rich text formatting');

        $this->crud->field('date_added')
                ->label('Date Added')
                ->type('datetime')
                ->default(now()->format('Y-m-d'))
                ->required(true);

        // Hidden – current logged-in user
        $this->crud->field('user_id')
                ->type('hidden')
                ->value(backpack_user()->id);
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
