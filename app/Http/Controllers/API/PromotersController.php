<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PromotedStoreRequest;
use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use App\Models\StructurePromoted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StructureCoordinator::promotersList()->get();
    }

    public function promoteds($id)
    {
        return StructurePromoted::with('member')->with('structure')->where('structure_coordinator_id', $id)->orderBy('id', 'desc')->get();
    }

    public function goals($id)
    {
        $promoter= StructureCoordinator::with('member')->find($id);
        $promoteds= StructurePromoted::with('member')->with('structure')->where('structure_coordinator_id', $id)->orderBy('id', 'desc')->count();

        return [
            'structure_coordinator_id'=> $promoter->id,
            'firstname'=> $promoter->member->firstname,
            'lastname'=> $promoter->member->lastname,
            'electoral_key'=> $promoter->member->electoral_key,
            'section'=> $promoter->section,
            'goal'=> $promoter->goal,
            'total_promoteds'=> $promoteds

        ];

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storePromoted(PromotedStoreRequest $request)
    {
        $postStructureCoordinator= $request->only(['structure_coordinator_id']);
        $postMember= $request->only([
            'firstname',
            'lastname',
            'sex',
            'birth_date',
            'electoral_key',
            'electoral_key_validity',
            'curp',
            'section',
            'section_type',
            'address',
            'neighborhood',
            'zip_code',
            'membership',
            'political_organization',
            'school_grade_id',
            'activity_id',
            'mobile_phone',
            'house_phone',
            'email',
            'has_social_networks',
            'facebook',
            'instagram',
            'twitter',
            'tiktok',
            'credential_front',
            'credential_back',
        ]);  
        

        try{

            DB::beginTransaction();

            $validateSection= StructureCoordinator::where('id', $postStructureCoordinator['structure_coordinator_id'])->where('section', $postMember['section'])->first();

            if($validateSection!=null){
                $structure= Structure::where('section', $postMember['section'])->first();
            }else{
                return ['El promotor no puede agregar promovidos para esta sección'];
            }

            $member= new Member();
            $postMember['position_id']= 6;

            if(isset($postMember['birth_date'])){ 
                $postMember['birth_date']= Carbon::createFromFormat('d/m/Y', $postMember['birth_date'])->format('Y-m-d'); 
            }


            /*$member->firstname= trim($postMember['firstname']);
            $member->lastname= trim($postMember['lastname']);
            $member->sex= trim($postMember['sex']);  
            $member->electoral_key= trim($postMember['electoral_key']);
            $member->electoral_key_validity= trim($postMember['electoral_key_validity']);
            $member->curp= trim($postMember['curp']);
            $member->section= trim($postMember['section']);
            $member->section_type= trim($postMember['section_type']);
            $member->address= trim($postMember['address']);
            $member->neighborhood= trim($postMember['neighborhood']);
            $member->zip_code= trim($postMember['zip_code']);
            $member->membership= trim($postMember['membership']);
            $member->political_organization= trim($postMember['political_organization']);
            $member->school_grade_id= trim($postMember['school_grade_id']);
            $member->activity_id= trim($postMember['activity_id']);
            $member->mobile_phone= trim($postMember['mobile_phone']);
            $member->house_phone= trim($postMember['house_phone']);
            $member->email= trim($postMember['email']);
            $member->has_social_networks= trim($postMember['has_social_networks']);
            $member->facebook= trim($postMember['facebook']);
            $member->instagram= trim($postMember['instagram']);
            $member->twitter= trim($postMember['twitter']);
            $member->tiktok= trim($postMember['tiktok']);
            $member->credential_front= trim($postMember['credential_front']);
            $member->credential_back= trim($postMember['credential_back']);*/
            $id= $member->create($postMember)->id;

            $promoted = new StructurePromoted();
            $promoted->structure_id= $structure->id;
            $promoted->structure_coordinator_id= $postStructureCoordinator['structure_coordinator_id'];
            $promoted->member_id= $id;
            $promoted->save();

            DB::commit();

            return StructurePromoted::with('member')->with('structure')->find($promoted->id);

        }catch (\Exception $e) {
            
            DB::rollback(); 
            return $e->getMessage();

        }

    }

    public function updatePromoted(PromotedStoreRequest $request, $promoted_id)
    {
        $postStructureCoordinator= $request->only(['structure_coordinator_id']);
        $postMember= $request->only([
            'firstname',
            'lastname',
            'sex',
            'birth_date',
            'electoral_key',
            'electoral_key_validity',
            'curp',
            'section',
            'section_type',
            'address',
            'neighborhood',
            'zip_code',
            'membership',
            'political_organization',
            'school_grade_id',
            'activity_id',
            'mobile_phone',
            'house_phone',
            'email',
            'has_social_networks',
            'facebook',
            'instagram',
            'twitter',
            'tiktok',
            'credential_front',
            'credential_back',
        ]);  
        

        try{

            DB::beginTransaction();

            $validateSection= StructureCoordinator::where('id', $postStructureCoordinator['structure_coordinator_id'])->where('section', $postMember['section'])->first();

            if($validateSection!=null){
                $structure= Structure::where('section', $postMember['section'])->first();
            }else{
                return ['El promotor no puede agregar promovidos para esta sección'];
            }

            $promoted = StructurePromoted::find($promoted_id);
            $promoted->structure_id= $structure->id;
            $promoted->save();

            $member= Member::find($promoted->member_id);
            if(isset($postMember['birth_date'])){ 
                $postMember['birth_date']= Carbon::createFromFormat('d/m/Y', $postMember['birth_date'])->format('Y-m-d'); 
            }
            $id= $member->update($postMember);

            DB::commit();

            return StructurePromoted::with('member')->with('structure')->find($promoted->id);

        }catch (\Exception $e) {
            
            DB::rollback(); 
            return $e->getMessage();

        }

    }    

    public function deletePromoted($promoted_id)
    {
        $structurePromoted= StructurePromoted::findOrFail($promoted_id);
        $member_id= $structurePromoted->member_id;
        $structurePromoted->delete();
        return Member::findOrFail($member_id)->delete();
        
        
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
