<div>
      @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
          @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

    @if ($showTable)
        <!-- Table Section -->
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary" wire:click="toggleTable()">{{ __("parents.add_parent") }}</button>
                <div class="table-wrapper">
                            <table id="example2" class="table table-bordered table-hover ">
                                    <thead>
                                    <tr>
                                        <th>{{__("parents.f_name")}}</th>
                                        <th>{{__("parents.l_name")}}</th>
                                        <th>{{__("parents.email")}}</th>
                                        <th>{{__("parents.relation")}}</th>
                                        <th>{{__("parents.nationality")}}</th>
                                        <th>{{__("parents.Relegion")}}</th>
                                        <th>{{__("parents.Phone")}}</th>
                                        <th>{{__("parents.Address")}}</th>
                                        <th>{{__("parents.process")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parents as $parent)
                                        <tr>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->first_name[LaravelLocalization::getCurrentLocale()] }}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->last_name[LaravelLocalization::getCurrentLocale()] }}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->email }}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->relation[LaravelLocalization::getCurrentLocale()] }}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{$parent->nationality->name[LaravelLocalization::getCurrentLocale()]}}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{$parent->relegion->name[LaravelLocalization::getCurrentLocale()]}}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->phone }}</td>
                                            <td class="border border-gray-400 px-4 py-2">{{ $parent->address[LaravelLocalization::getCurrentLocale()] }}</td>
                                            <td>
                                            <button type="button" class="btn  btn-outline-success btn-sm" wire:click="edit({{ $parent->id }})">Edit</button>
                                            <button type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="if (confirm('Are you sure you want to delete this parent?')) { @this.call('delete', {{ $parent->id }}) }">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                </div>
            </div>
        </div>
    @else
        <!-- Form Section -->
        <div class="card">
            <div class="card-body">
                 <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-md">
                        <form wire:submit.prevent="saveParent">
                            <!-- Email & Password -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label >{{__("parents.en_f_name")}}</label>
                                        <input type="text"
                                            wire:model="en_first_name"
                                            class="form-control">
                                        @error('en_first_name')
                                            <div  class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label >{{__("parents.ar_f_name")}}</label>
                                        <input type="text"
                                            wire:model="ar_first_name"
                                            class="form-control">
                                        @error('ar_first_name')
                                            <div  class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label>{{__("parents.en_l_name")}}</label>
                                    <input type="text"
                                        wire:model="en_last_name"
                                        class="form-control">
                                    @error('en_last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label>{{__("parents.ar_l_name")}}</label>
                                    <input type="text"
                                        wire:model="ar_last_name"
                                        class="form-control">
                                    @error('ar_last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label>{{__("parents.en_relation")}}{{__("parents.father")}}/{{__("parents.mother")}}</label>
                                    <input type="text"
                                        wire:model="en_relation"
                                        class="form-control">
                                    @error('en_relation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label>{{__("parents.ar_relation")}}{{__("parents.father")}}/{{__("parents.mother")}}</label>
                                    <input type="text"
                                        wire:model="ar_relation"
                                        class="form-control">
                                    @error('ar_relation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.gender")}}</label>
                                            <select wire:model="gender_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($genders as $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->name[LaravelLocalization::getCurrentLocale()] }}</option>
                                                @endforeach
                                            </select>
                                        @error('gender_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.nationality")}}</label>
                                            <select wire:model="nationality_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($nationalities as $nationality)
                                                        <option value="{{ $nationality->id }}">{{ $nationality->name[LaravelLocalization::getCurrentLocale()] }}</option>
                                                @endforeach
                                            </select>
                                        @error('nationality_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.Relegion")}}</label>
                                            <select wire:model="relegion_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($relegions as $relegion)
                                                        <option value="{{ $relegion->id }}">{{ $relegion->name[LaravelLocalization::getCurrentLocale()] }}</option>
                                                @endforeach
                                            </select>
                                        @error('relegion_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label >{{__("parents.Phone")}}</label>
                                    <input type="text"
                                        wire:model="phone"
                                        class="form-control">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.en_Address")}}</label>
                                    <input type="text"
                                        wire:model="en_address"
                                        class="form-control">
                                    @error('en_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.ar_Address")}}</label>
                                    <input type="text"
                                        wire:model="ar_address"
                                        class="form-control">
                                    @error('ar_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{__("parents.email")}}</label>
                                        <input type="email"
                                            wire:model="email"
                                            class="form-control">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" wire:click="toggleTable">Cancel</button>
                        </form>
                    </div>
            </div>
        </div>
    @endif

</div>
