<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Address;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('companies')->get();
        return view('home', compact('data'));
    }

    public function store_companies(Request $request){
        $id = $request->get('id', false);
        $attr['id_user']= Auth::id();
        $attr['name_company']= $request->name_company;
        $attr['cnpj']= $request->cnpj;
        $attr['phone']= $request->phone;
        $attr['name_person']= $request->name_person;
        $attr['email']= $request->email;

        
        $address_companie['cep'] = $request->cep;
        $address_companie['public_place'] = $request->public_place;
        $address_companie['neighborhood'] = $request->neighborhood;
        $address_companie['adjunct'] = $request->adjunct;
        $address_companie['number_house'] = $request->number_house;
        $address_companie['city'] = $request->city;
        $address_companie['state'] = $request->state;
        $address_companie['status'] = 1;

        try{
            if($id){
                $company = Companies::find($id);
                $company->fill($attr);
                $company->save();
                flash("Produto Atualizado!")->success();
                return redirect()->route('home');
            }
            else{
                $verify = DB::table('companies')->where('cnpj', '=', $attr['cnpj'])->first();
    
                if(empty($verify)){
                    
                    Companies::create($attr);
                    $address_save = DB::table('companies')->where('cnpj', '=', $attr['cnpj'])->first();
                    $address_companie['id_company'] = $address_save->id;
                    Address::create($address_companie);
                    flash("Empresa Registrada!")->success();
                    return redirect()->route('home');
                }
                else{
                    flash("Empresa já Existe!")->warning();
                    return redirect()->route('home');
                }
            }     
        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }  
    }

    public function read($id){
        $companie_head = Companies::find($id);
        $address_head = DB::table('addresses')->where('id_company', '=', $id)->get();
        $employee = DB::table('users')->where('id', '=', $companie_head->id_user)->first("name");
        return view('read', compact('companie_head', 'address_head', 'employee'));
    }

    public function delete($id){ 
        try{
            $head = Companies::find($id);
            $address = Address::where('id_company', '=', $head->id)->get('id');

            foreach($address as $value){
                Address::find($value->id)->delete(); // Deleta todos os endereços da empresa
            }

            $head->delete();
            return redirect()->route('home');

        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }
    }

    public function delete_Address($id){
        $head = Address::find($id);
        $id_company = $head->id_company;
        if($head->status == 1){
            
            flash("Você tentou excluir o endereço principal. Selecione outro endereço como principal e tente novamente!")->warning();
            return redirect()->route('read', [$id => $id_company]);
        }
        else{
            $head->delete();
            flash("Endereço Excluido com sucesso")->success();
            return redirect()->route('read', [$id => $id_company]);
        }

    }


    public function store_address(Request $request){

        $id = $request->get('id', false);
        $address_companie['id_company'] = $request->id_company;
        $address_companie['cep'] = $request->cep;
        $address_companie['public_place'] = $request->public_place;
        $address_companie['neighborhood'] = $request->neighborhood;
        $address_companie['adjunct'] = $request->adjunct;
        $address_companie['number_house'] = $request->number_house;
        $address_companie['city'] = $request->city;
        $address_companie['state'] = $request->state;
        $address_companie['status'] = $request->status;


        if($request->status == 'on'){
            
            $get_id = DB::table('addresses')->where('id_company', '=', $address_companie['id_company'])->where('status', '=', 1)->first();
            Address::find($get_id->id)->update(['status' => 0]);  
            $address_companie['status'] = 1;
        }
        else{
            $address_companie['status'] = 0;
        }

        try{
            if($id){
                $address = Address::find($id);
                $address->fill($address_companie);
                $address->save();
                flash("Endereço Atualizado!")->success();
                return redirect()->route('read', [$id => $address_companie['id_company']]);
                }
            else{
                Address::create($address_companie);
                flash("Endereço Registrado!")->success();
                return redirect()->route('read', [$id => $address_companie['id_company']]);
            }
        }     
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }  
    }
    
    public function read_address($id){
        $read_address = Address::find($id);
        $companie_head = DB::table('companies')->where('id', '=', $read_address->id_company)->first();
        $address_head = DB::table('addresses')->where('id_company', '=', $companie_head->id)->get();
        $employee = DB::table('users')->where('id', '=', $companie_head->id_user)->first("name");
        $modal = 1;
        return view('read', compact('companie_head', 'address_head','read_address','modal','employee'));
    } 
}
