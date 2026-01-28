<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FontRequest;
use App\Models\FontImage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\FontFile;
use App\Models\Font;
use Illuminate\Support\Facades\Storage;
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

                
        $this->crud->addColumn([
            'name'  => 'files_count',
            'label' => 'Files',
            'type'  => 'closure',
            'function' => function ($entry) {
                return $entry->files->count() . ' files';
            },
        ]);



        // Column for images with delete
        $this->crud->addColumn([
            'name'  => 'images_preview',
            'label' => 'Images',
            'type'  => 'custom_html',
            'value' => function ($entry) {
                $html = '';
                foreach ($entry->images as $image) {
                    $html .= '<div style="display: inline-block; margin: 5px; position: relative;">';
                    $html .= '<img src="' . Storage::url($image->image_url) . '" style="max-width: 80px; height: auto;">';
                    
                    // Delete form
                    $html .= '<form action="' . route('admin.font.image.delete', ['font' => $entry->id, 'image' => $image->id]) . '" method="POST" style="display:inline;">';
                    $html .= csrf_field();
                    $html .= method_field('DELETE');
                    $html .= '<button type="submit" onclick="return confirm(\'Delete this image?\')" style="position: absolute; top: 0; right: 0; color: red; font-weight: bold; background: none; border: none; cursor: pointer;">X</button>';
                    $html .= '</form>';
                    
                    $html .= '</div>';
                }
                return $html ?: 'No images';
            },
        ]);


        // Same for files (text links)
        $this->crud->addColumn([
            'name'  => 'files_list',
            'label' => 'Files',
            'type'  => 'custom_html',
            'value' => function ($entry) {
                $html = '';
                foreach ($entry->files as $file) {
                    $html .= '<div>';
                    $html .= '<a href="' . Storage::url($file->file_url) . '" target="_blank">' . basename($file->file_url) . '</a>';
                    $html .= ' <a href="' . route('admin.font.file.delete', ['font' => $entry->id, 'file' => $file->id]) . '"';
                    $html .= ' onclick="return confirm(\'Delete this file?\')" style="color: red;">[X]</a>';
                    $html .= '</div>';
                }
                return $html ?: 'No files';
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


        $this->crud->addField([
            'name'      => 'images[]',
            'label'     => 'Images (multiple)',
            'type'      => 'upload',
            'upload'    => true,
            'multiple'  => true,
            'disk'      => 'public',
            'mime_types' => ['image'],
        ]);

        $this->crud->addField([
            'name'      => 'files[]',
            'label'     => 'Font Files (multiple)',
            'type'      => 'upload',
            'upload'    => true,
            'multiple'  => true,
            'disk'      => 'public',
            'mime_types' => ['font/ttf', 'font/otf', 'font/woff', 'font/woff2'],
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


    protected function setupShowOperation()
    {
        $this->setupListOperation();

        // Show all images
        $this->crud->addColumn([
            'name'  => 'images',
            'label' => 'Images',
            'type'  => 'custom_html',
            'value' => function ($entry) {
                $html = '';
                foreach ($entry->images as $image) {
                    $html .= '<img src="' . Storage::url($image->image_url) . '" style="max-width: 200px; margin: 5px;">';
                }
                return $html ?: 'No images';
            },
        ]);

        // Show all files
        $this->crud->addColumn([
            'name'  => 'files',
            'label' => 'Files',
            'type'  => 'custom_html',
            'value' => function ($entry) {
                $html = '';
                foreach ($entry->files as $file) {
                    $html .= '<div><a href="' . Storage::url($file->file_url) . '" target="_blank">' . basename($file->file_url) . '</a></div>';
                }
                return $html ?: 'No files';
            },
        ]);
    }




    /**
     * Override store to handle multiple file uploads
     */
    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        $request = $this->crud->validateRequest();

        // Create the main font record (without files)
        $item = $this->crud->create($request->except(['images', 'files']));

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('font_images', 'public');
                    \App\Models\FontImage::create([
                        'font_id'     => $item->id,
                        'image_url'   => $path,
                        'image_type'  => $image->getMimeType(),
                    ]);
                }
            }
        }

        // Handle multiple font file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('font_files', 'public');
                    \App\Models\FontFile::create([
                        'font_id'     => $item->id,
                        'file_url'    => $path,
                        'file_format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
        }

        // Let Backpack finish the save
        return $this->crud->performSaveAction($item->getKey());
    }

    /**
     * Override update (same logic, but for editing)
     */
    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        $request = $this->crud->validateRequest();

        // Get the ID of the current font
        $id = $this->crud->getCurrentEntryId();

        // Update the main font record
        $item = $this->crud->update($id, $request->except(['images', 'files']));

        // Handle new image uploads (append only)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('font_images', 'public');
                    \App\Models\FontImage::create([
                        'font_id'     => $item->id,
                        'image_url'   => $path,
                        'image_type'  => $image->getMimeType(),
                    ]);
                }
            }
        }

        // Handle new file uploads (append only)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('font_files', 'public');
                    \App\Models\FontFile::create([
                        'font_id'     => $item->id,
                        'file_url'    => $path,
                        'file_format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
        }

        return $this->crud->performSaveAction($item->getKey());
    }

    public function deleteImage(Font $font, FontImage $image)
    {
        $this->crud->hasAccessOrFail('update');

        if ($font->id !== $image->font_id) {
            abort(403, 'Unauthorized');
        }

        // Delete from storage
        Storage::disk('public')->delete($image->image_url);

        // Delete record
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function deleteFile(Font $font, FontFile $file)
    {
        $this->crud->hasAccessOrFail('update');

        if ($font->id !== $file->font_id) {
            abort(403, 'Unauthorized');
        }

        Storage::disk('public')->delete($file->file_url);
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }



}
