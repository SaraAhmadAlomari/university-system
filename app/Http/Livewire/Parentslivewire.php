<?php

namespace App\Http\Livewire;

use App\Models\MyParent;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Religion;

use Livewire\Component;

class Parentslivewire extends Component
{
    public $showTable=true;
    // Properties for the table and form
    public $parents, $genders, $nationalities, $relegions;

    // Form fields
    public $parentId = null;
    public $en_first_name, $ar_first_name;
    public $en_last_name, $ar_last_name;
    public $email, $phone;
    public $en_address, $ar_address;
    public $en_relation, $ar_relation;
    public $nationality_id, $gender_id, $relegion_id;

    // Component Lifecycle Hook
    public function mount()
    {
        $this->fetchData();
    }
    public function fetchData()
    {
        $this->parents = MyParent::with(['nationality', 'relegion'])->get();
        $this->genders = Gender::all();
        $this->nationalities = Nationality::all();
        $this->relegions = Religion::all();
    }
    public function resetForm()
    {
        $this->parentId = null;
        $this->reset([
            'en_first_name',
            'ar_first_name',
            'en_last_name',
            'ar_last_name',
            'email',
            'phone',
            'en_address',
            'ar_address',
            'en_relation',
            'ar_relation',
            'nationality_id',
            'gender_id',
            'relegion_id'
        ]);
    }
    public function saveParent()
    {
        $this->validate([
            'email' => 'required|email|unique:my_parents,email,' . $this->parentId,
            'en_first_name' => 'required|string|max:255',
            'ar_first_name' => 'required|string|max:255',
            'en_last_name' => 'required|string|max:255',
            'ar_last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'en_address' => 'required|string|max:255',
            'ar_address' => 'required|string|max:255',
            'en_relation' => 'required|string|max:100',
            'ar_relation' => 'required|string|max:100',
            'nationality_id' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'relegion_id' => 'required|exists:religions,id',
        ]);

        $parent = $this->parentId ? MyParent::findOrFail($this->parentId) : new MyParent();

        $parent->first_name = ['en' => $this->en_first_name, 'ar' => $this->ar_first_name];
        $parent->last_name = ['en' => $this->en_last_name, 'ar' => $this->ar_last_name];
        $parent->address = ['en' => $this->en_address, 'ar' => $this->ar_address];
        $parent->relation = ['en' => $this->en_relation, 'ar' => $this->ar_relation];
        $parent->email = $this->email;
        $parent->phone = $this->phone;
        $parent->nationality_id = $this->nationality_id;
        $parent->gender_id = $this->gender_id;
        $parent->relegion_id = $this->relegion_id;

        $parent->save();

        session()->flash('success', $this->parentId ? 'Parent updated successfully!' : 'Parent added successfully!');
        $this->toggleTable();
        $this->fetchData();
    }
    public function edit($id)
    {
        $parent = MyParent::findOrFail($id);

        $this->parentId = $parent->id;
        $this->en_first_name = $parent->first_name['en'];
        $this->ar_first_name = $parent->first_name['ar'];
        $this->en_last_name = $parent->last_name['en'];
        $this->ar_last_name = $parent->last_name['ar'];
        $this->email = $parent->email;
        $this->phone = $parent->phone;
        $this->en_address = $parent->address['en'];
        $this->ar_address = $parent->address['ar'];
        $this->en_relation = $parent->relation['en'];
        $this->ar_relation = $parent->relation['ar'];
        $this->nationality_id = $parent->nationality_id;
        $this->gender_id = $parent->gender_id;
        $this->relegion_id = $parent->relegion_id;

        $this->showTable = false;
    }

    public function delete($id)
    {
        MyParent::findOrFail($id)->delete();
        session()->flash('success', 'Parent deleted successfully!');
        $this->fetchData();

    }

    public function render()
    {
        return view('livewire.parents.parentslivewire');
    }
    public function toggleTable(){
        $this->showTable=!$this->showTable;
    }
}
