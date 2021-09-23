<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\Continent;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
class Countries extends Component
{
    use WithPagination;
    public $continent,$country_name,$capital_name;
    public $upd_continent,$upd_country_name,$upd_capital_name,$cid;
    protected $listeners = ["delete","deleteCheckedCountries"];
    public $checkedCountry = [];
    protected $paginationTheme = 'bootstrap';
    public $byContinent;
    public $search;
    public $perPage = 5;
    public $orderBy = "country_name";
    public $sortBy ="asc";

    public function render()
    {
        return view('livewire.countries',[

            "continents"=>Continent::orderBy("continent_name","asc")->get(),
            "countries"=>Country::when($this->byContinent,function($query){
                $query->where("continent_id","=",$this->byContinent);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)         

        ]);
    }
    public function OpenAddCountryModal(){

        $this->continent ="";
        $this->country_name ="";
        $this->capital_name ="";

        return $this->dispatchBrowserEvent('OpenAddCountryModal');
    }
    public function save(){
      
        $this->validate([

            "continent"=>"required",
            "country_name"=>"required|unique:countries",
            "capital_name"=>"required",
        ]);
        $save = Country::create([

            "continent_id"=>$this->continent,
            "country_name"=>$this->country_name,
            "capital_name"=>$this->capital_name
        ]);
        if($save){
            $this->dispatchBrowserEvent('CloseAddCountryModal');

        }
        $this->checkedCountry = [];
    }

    public function OpenEditCountryModal($id){
    
        $info = Country::findOrFail($id);

        $this->continent = $info->continent_id;
        $this->country_name = $info->country_name;
        $this->capital_name = $info->capital_name;
        $this->cid = $info->id;

        return $this->dispatchBrowserEvent('OpenEditCountryModal');

    }

    public function update(){
        $cid = $this->cid;
        $this->validate([
            "continent"=>"required",
            "country_name"=>'required|unique:countries,country_name,'.$cid,
            "capital_name"=>"required",

        ],
        [
            "continent.required"=>"You must select a continent",
            "country_name.required"=>"You must select a country name",
            "country_name.unique"=>"Country name Already Exits",
            "capital_name.required"=>"You must select a capital name",
            
        ]);
        $info = Country::findOrFail($cid);
        
        $update = $info->update([

                "continent_id"=>$this->continent,
                "country_name"=>$this->country_name,
                "capital_name"=>$this->capital_name
            ]);
        
        if($update){
            $this->dispatchBrowserEvent('CloseEditCountryModal');
        }
        $this->checkedCountry = [];

    }
    public function deleteConfirm($id){
        $info = Country::findOrFail($id);
        $this->dispatchBrowserEvent('SwalConfirm',[

            "title"=> "Are you Sure?",
            "html"=> "you want to delete <strong>".$info->country_name."</strong>",
            "id"=>$info->id
        ]);
    }

    public function delete($id){
        $info = Country::findOrFail($id);
        $deleted = $info->delete();
        if($deleted){
            $this->dispatchBrowserEvent('deleted',[
                "title"=>"country"
            ]);
        }
        $this->checkedCountry = [];
    }
    public function deleteCountries(){
        $this->dispatchBrowserEvent('Swal:deleteCountries',[
            "title"=> "Are you Sure?",
            "html"=> "you want to delete this countries",
            "checkedIDs"=>$this->checkedCountry
        ]);
    }
    public function deleteCheckedCountries($ids){

        $deleted = Country::whereKey($ids)->delete();
        $this->checkedCountry = [];
        if($deleted){
            $this->dispatchBrowserEvent('deleted',[
                "title"=>"countries"
            ]);
        }

    }

    public function isChecked($countryId){
        return in_array($countryId,$this->checkedCountry) ? "bg-info text-white" : "";
    }

}
