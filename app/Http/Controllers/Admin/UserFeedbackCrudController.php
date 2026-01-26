<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserFeedbackRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserFeedbackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserFeedbackCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UserFeedback::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-feedback');
        CRUD::setEntityNameStrings('user feedback', 'user feedbacks');
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

        $this->crud->addColumn([
            'name'      => 'font.font_name',
            'label'     => 'Font',
            'type'      => 'text',
            'searchLogic' => function ($q, $column, $search) {
                $q->orWhereHas('font', function ($query) use ($search) {
                    $query->where('font_name', 'like', "%{$search}%");
                });
            },
        ]);

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

        $this->crud->column('rating')
                ->label('Rating')
                ->type('number');

        $this->crud->column('comment')
                ->label('Comment')
                ->type('text')
                ->limit(100);

        $this->crud->column('feedback_date')
                ->label('Feedback Date')
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

        $this->crud->addField([
            'name'        => 'font_id',
            'label'       => 'Font',
            'type'        => 'select',          
            'entity'      => 'font',
            'attribute'   => 'name', //Long changed this from "font_name", db wrong name 
            'model'       => 'App\Models\Font',
            'wrapper'     => ['class' => 'form-group col-md-6'],
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name'        => 'user_id',
            'label'       => 'User',
            'type'        => 'select',          
            'entity'      => 'user',
            'attribute'   => 'name',
            'model'       => 'App\Models\User',
            'wrapper'     => ['class' => 'form-group col-md-6'],
            'allows_null' => false,
        ]);

        $this->crud->field('rating')
                ->label('Rating (1-5)')
                ->type('number')
                ->attributes(['min' => 1, 'max' => 5])
                ->required(true);

        $this->crud->field('comment')
                ->label('Comment')
                ->type('textarea')
                ->required(true);

        $this->crud->field('feedback_date')
                ->label('Feedback Date')
                ->type('datetime')
                ->default(now()->format('Y-m-d H:i:s'))
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
        $this->setupCreateOperation();
    }
}