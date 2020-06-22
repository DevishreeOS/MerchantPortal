<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Log;

class ClientDetailsController extends Controller
{
    public function index()
    {
        try
        {
            $clientList=DB::table('tblclientdetails')->paginate(2);
            Log::info("Get list of Clients successfully");
            return view('ListOfClientDetails',compact('clientList'));
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function create()
    {
        try
        {
            Log::info("view ClientRegistration page successfully");
            return view('ClientRegistration');
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function save(Request $request)
    {
        try
        {
            $request->validate([
                'companyName'=>'required',
                'companyLogo'=>'required'
            ]);
            $file =  $request->file('companyLogo');
            $contents = $file->openFile()->fread($file->getSize());
       
            $companyLogo=$contents;
            $companyName=$request->companyName;         
            DB::insert('insert into tblclientdetails(CompanyName,CompanyLogo,CreatedBy,UpdatedBy,CreatedOn,UpdatedOn,isDeleted)values(?,?,?,?,?,?,?)',[$companyName,$companyLogo,'Devishree','Devishree','2020-06-09','2020-06-09',0]);
            Log::info("Inserted new ClientDetails successfully");
            return Redirect::back(); 
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function show($clientID)
    {
        try
        {
            $clientDetails=DB::select('select CompanyName,CompanyLogo,CreatedBy,UpdatedBy,CreatedOn,UpdatedOn from tblclientdetails where ClientID=?',[$clientID]);
            Log::info("Show about particular ClientDetails successfully");
            return view('ViewClientDetails',compact('clientDetails'));
        }
        
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function edit($clientID)
    {
        try
        {
            $clientDetails=DB::select('select CompanyName,CompanyLogo,ClientID from tblclientdetails where ClientID=?',[$clientID]);
            return view('EditClientDetails',compact('clientDetails'));
        }
        
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function update(Request $request)
    {
        try
        {
            if($request->companyLogo)
            {
             $file =  $request->file('companyLogo');
            $contents = $file->openFile()->fread($file->getSize());
       
            $companyLogo=$contents;
            }
            else
            {
            $pos = strpos($request->hiddenImage, 'base64,');
            $blobData= base64_decode(substr($request->hiddenImage, $pos + 7));
            $companyLogo=$blobData;
            }
            $companyName=$request->companyName;
            DB::update('update tblclientdetails set CompanyName=?,CompanyLogo=? where ClientID=?',[$companyName,$companyLogo,$request->clientID]);
            Log::info("Updated clientdeetails successfully");
            echo "updated";
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    public function destroy($clientID)
    {
        try
        {
            DB::delete('delete from tblclientdetails where ClientID=?',[$clientID]);
            Log::info("Deleted clientDetails successfully");
            return Redirect::back();
        }
        catch(Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
    
}
