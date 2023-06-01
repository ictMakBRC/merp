<?php

namespace App\Http\Livewire\DocumentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DocumentManagement\DmDocumentResource;
use App\Models\DocumentManagement\DmDocumentResourceCategory;

class DocumentResourcesComponent extends Component
{
    use WithFileUploads, WithPagination;

    public $perPage = 10;

    public $search = '';

    public $search_folder = '';

    public $orderBy = 'created_at';

    public $orderAsc = true;

    public $delete_id;

    public $edit_id;

    protected $paginationTheme = 'bootstrap';

    public $createNew = false;

    public $toggleForm = false;

    //Document Categories fields
    public $name;

    public $home_folder;

    //Document Resources fields
    public $resource_category_id;

    public $title;

    public $file;

    public $expiry_date;

    public $status;

    public $insititution_data;

    public $folder_name;

    public $folder_type;

    public $parent_id = 0;

    public $documents;

    public $sub_folders;

    public $folder_open = false;

    public $folder_documents;

    public $is_pair;

    public $category_type;

    public $category_name;

    public $current_category;

    public $target_insitutions = [];
    public $multiple = false;
    public $current_folder_name;

    public $current_folder;

    public $pair_department_id = [];

    public $category_expires;

    public $details;

    public $active_status;

    public $to_date;

    public $parent_folder;

    public $folder_code;

    public $document_category = 0;
    public $multiple_docs =[];
    public $expired;
    public $name_read_only;
    public $edit_doc_id;
    public $folder_id;
    public $parent_document_id;
    public $new_version = false;
    public $parent_document_name, $version_number, $release_notes;
    public function openFolder($id)
    {
        $this->folder_open = true;
        $this->current_folder = DmDocumentResourceCategory::with('parent')->where('id', $id)->first();
        $this->current_folder_name = $this->current_folder->name;
        $this->createNew = false;
        $this->parent_id = $this->current_folder->id;
        $this->folder_code = $this->current_folder->type;
        $this->folder_type = $this->current_folder->type;
    }

    public function closeFolder()
    {
        $this->folder_open = false;
        $this->current_folder = null;
        $this->current_folder_name = null;
        $this->createNew = false;
        $this->parent_id = null;
        $this->folder_code = null;
        $this->folder_type = null;
    }

    public function archiveDocument($id)
    {
        $document = DmDocumentResource::where('id', $id)->first();
        $document->status = 3;
        $document->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Your document successfully archived!']);
    }

    public function newVersion($id)
    {
        $document = DmDocumentResource::where('id', $id)->first();
        if($document){
        $this->new_version = true;
        $this->parent_document_id = $document->id;
        $this->parent_document_name = $document->title;
        $this->resource_category_id = $document->resource_category_id;
        $this->createNew = true;
        $this->updatedDocumentCategoryId();
        }
    }

    public function UnArchiveDocument($id)
    {
        $document = DmDocumentResource::where('id', $id)->first();
        $document->status = 1;
        $document->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Your document successfully archived!']);
    }

    public function createCategory()
    {
        $category = new DmDocumentResourceCategory();
        $category->name = 'SOPS';
        $category->name_read_only ='sop';
        $category->status = 1;
        $category->code = 'SOP002';
        $category->expires = 0;
        $category->save();
    }
    public function render()
    {       
       
        if ($this->active_status) {
            $status = 3;
        } else {
            $status = 1;
        }
        if ($this->folder_open) {
            $data['folders'] = $this->sub_folders = $categories= DmDocumentResourceCategory::where('parent_id', $this->parent_id)->get();
            if ($this->folder_code == 'Shared') {
                $this->documents = DmDocumentResource::search($this->search)->where('resource_category_id', $this->parent_id)->with('category','user')->where(['status' => 1])->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')->get();
            } else {
                $this->documents = DmDocumentResource::search($this->search)->where('resource_category_id', $this->parent_id)->with('category')->where(['department_id' => auth()->user()->department_id, 'status' => $status])
                ->when($this->expired, function ($query) {
                    $query->where('expiry_date', '<=', $this->to_date)->where('expiry_date', '!=', null);
                })->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')->get();
            }
        } else {
            $this->documents = DmDocumentResource::search($this->search)->where(['department_id' => auth()->user()->department_id, 'status' => $status])
            ->when($this->expired, function ($query) {
                $query->where('expiry_date', '<=', $this->to_date)->where('expiry_date', '!=', null);
            })
            ->when($this->document_category, function ($query) {
                $query->where('resource_category_id', $this->document_category);
            })->with('category')->limit(10)->get();
            $data['folders'] = DmDocumentResourceCategory::where('parent_id', $this->parent_id)->get();
            $data['folder_lists'] = $categories = DmDocumentResourceCategory::all();
            $data['total_documents'] = DmDocumentResource::where(['department_id' => auth()->user()->department_id])->with('category')->get();
        }   
        $data['categories'] = $categories ;
        if(!$categories){
            $this->createCategory();
          }

        return view('livewire.document-management.document-resources-component',$data)->layout('livewire.document-management.layouts.app');
    }
}
