<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as IlluminateRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * the current in-coming request.
     *
     * @var array
     */
    protected $form_request;


    /* Model for the current request.
     *
     * @var array
     */
    protected $model;


    /**
     * Constructor
     * @param IlluminateRequest $request
     * @return void
     **/
    public function __construct(IlluminateRequest $request)
    {
        // current request is an object of illuminate request
        $this->form_request = $request;
    }


    /**
     * Check if the user is authorized to do action (policy method name).
     * Policy check
     *
     * @param string $action
     * @return bool
     **/
    protected function can($action)
    {
        return $this->form_request->user()->can($action, $this->model);
    }


    /**
     * Check if the user is authorized to do action (permission slug).
     * permission check
     *
     * @param string $permission
     * @return bool
     **/
    protected function canDo($permission)
    {
        return $this->form_request->user()->hasPermission($permission);
    }


    /**
     * Check if the user is authorized to do action (permission slug).
     * permission check
     *
     * @param string $role
     * @return bool
     **/
    protected function canAccess($role)
    {
        return $this->form_request->user()->hasRole($role);
    }

    /**
     * Check the process is create.
     *
     * @return bool
     **/
    protected function isCreate()
    {
        if ($this->is('*/create*')) {
            return true;
        }
        return false;
    }

    /**
     * Check if the in-coming request is of method type POST.
     *
     * @return bool
     **/
    protected function isStore()
    {

        if ($this->form_request->isMethod('POST')) {
            return true;
        }

        return false;
    }

    /**
     * Check the process is edit.
     *
     * @return bool
     **/
    protected function isEdit()
    {
        if ($this->is('*/edit')) {
            return true;
        }
        return false;
    }

    /**
     * Check if the in-coming request is of method type PUT or PATCH.
     *
     * @return bool
     **/
    protected function isUpdate()
    {

        if ($this->form_request->isMethod('PUT') ||
            $this->form_request->isMethod('PATCH')
        ) {
            return true;
        }

        return false;

    }


    /**
     * Check if the in-coming request is of method type DELETE.
     *
     * @return bool
     **/
    protected function isDelete()
    {

        if ($this->form_request->isMethod('DELETE')) {
            return true;
        }

        return false;

    }

    protected function isAuthorized()
    {
        //TODO:
        return true;
        if ($this->form_request->user()->isSuperAdmin()) {
            return true;
        }

        if ($this->isCreate() || $this->isStore()) {
            // Determine if the user is authorized to create an item,
            return $this->can('create');
        }

        if ($this->isEdit() || $this->isUpdate()) {
            // Determine if the user is authorized to update an item,
            return $this->can('update');
        }

        if ($this->isDelete()) {
            // Determine if the user is authorized to delete an item,
            return $this->can('destroy');
        }

        // Determine if the user is authorized to view this model,
        return $this->can('view');
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    abstract function rules();

    public function attributes()
    {
        $validationFields = array_keys($this->rules());
        $attributes = [];

        foreach ($validationFields as $field) {
            //Handling _id case [ex: object_id => object]
            $arr = preg_split("/_id$/x", trim($field), null, PREG_SPLIT_NO_EMPTY);
            $newField = array_first($arr);
            if ($newField !== $field) {
                $attributes[$field] = str_replace('_', ' ', $newField);
            }
        }
        return $attributes;
    }
}
