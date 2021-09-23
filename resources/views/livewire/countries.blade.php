<div>
    <div class="row mb-3 p-2">
        <div class="col-md-3">
            <label for="">Continent</label>
            <select wire:model="byContinent" class="form-control">
               <option value="">No selected</option>
               @foreach ($continents as $continent)
                <option value="{{$continent->id}}">{{$continent->continent_name}}</option>  
               @endforeach 
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Search</label>
            <input type="text" class="form-control" wire:model.debounce.350ms="search">
        </div>
        <div class="col-md-2">
            <label for="">Per Page</label>
            <select wire:model="perPage" class="form-control">
               <option value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>     
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Order By</label>
            <select wire:model="orderBy" class="form-control">
               <option value="country_name">Country Name</option>
               <option value="capital_name">Capital City</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Sort By</label>
            <select wire:model="sortBy" class="form-control">
               <option value="asc">Asc</option>
               <option value="desc">Desc</option>
            </select>
        </div>
        
    </div> 
    <button class="btn btn-primary btn-sm mb-3" wire:click="OpenAddCountryModal()" style="font-family: revert;font-weight: bold;">New Country<i class="fa fa-plus"></i></button>
    <div>
        @if($checkedCountry)
            <button class="btn btn-danger" wire:click="deleteCountries()">Selected Countries {{ count($checkedCountry) }}</button>
        @endif
    </div>
    <table class="table table-hover table-bordered ">
        <thead class="thead-inverse">
            <tr>
                <th></th>
                <th>Continent</th>
                <th>Country</th>
                <th>Capital City</th>
                <th>Action </th>
            </tr>
        </thead>
            <tbody>
           @forelse($countries as $country)
            <tr class="{{$this->isChecked($country->id)}}">
                <td><input type="checkbox" value="{{$country->id}}" wire:model="checkedCountry" ></td>
                <td>{{$country->continent->continent_name}}</td>
                <td>{{$country->country_name}}</td>
                <td>{{$country->capital_name}}</td>
                <td>
                    <button class="btn btn-danger btn-sm" wire:click="deleteConfirm({{$country->id}})">Delete</button>
                    <button class="btn btn-success btn-sm" wire:click="OpenEditCountryModal({{$country->id}})">Edit</button>
                </td>
            </tr>
        
           @empty
             <code>No Country Found</code>
           @endforelse
            </tbody>
    </table>
    @if(count($countries))
    {{$countries->links()}}
    @endif
    @include('modals.add-modal')
    @include('modals.edit-modal')
</div>
