<div class="modal editCountry" tabindex="-1" wire:ignore.self role="dialog" data-keyboard="false" data-backdoor="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form wire:submit.prevent="update">
           <input type="hidden" wire:model="cid">
            <div class="form-group">
              <label for="">Continent</label>
              <select class="form-control" wire:model="continent">
              <option value=" ">No Selected</option>
                @foreach($continents as $continent)
                <option value="{{$continent->id}}">{{$continent->continent_name}}</option>
                @endforeach
              </select>
                <span class="text-danger">@error("continent") {{$message}} @enderror</span>
            </div>
            <div class="form-group">
              <label for="">Country Name</label>
              <input type="text" class="form-control" placeholder="Country name" wire:model="country_name">
              <span class="text-danger">@error("country_name") {{$message}} @enderror</span>
            </div>
            <div class="form-group">
            <label for="">Capital Name</label>
              <input type="text" class="form-control" placeholder="Capital name" wire:model="capital_name">
              <span class="text-danger">@error("capital_name") {{$message}} @enderror</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form> 
      </div>
    
    </div>
  </div>
</div>