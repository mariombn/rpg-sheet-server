<?php

namespace App\Http\Controllers\Api\v1;

use App\Campaign;
use App\CampaignUser;
use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth('api')->user()->id;
        $campaingModel = new Campaign();
        $campaingCollection = $campaingModel->getCampaingsByUser($userId);
        return $this->responseJson(true, $campaingCollection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userForm = $request->only(['name', 'description']);
        $userId = auth('api')->user()->id;
        $campaingModel = new Campaign();
        $campaingModel->name = $userForm['name'];
        $campaingModel->description = $userForm['description'];
        $campaingModel->user_id = $userId;
        $campaingModel->system_id = 1;
        $campaingModel->save();
        return $this->responseJson(true, $campaingModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = auth('api')->user()->id;
        $campaingModel = Campaign::find($id);
        if ($this->validUserMester($campaingModel, $userId)) {
            return $this->responseJson(true, $campaingModel);
        } else {
            return $this->responseJson(true, $campaingModel);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function inviteUser(Request $request, $id)
    {
        $userId = auth('api')->user()->id;
        $userMail = $request->only(['user_email']);

        $campaingModel = Campaign::find($id);

        if ($this->validUserMester($campaingModel, $userId)) {
            $userInvitedId = User::getUserIdByMail($userMail);
            $campaingUserModel = new CampaignUser();
            $campaingUserModel->campaign_id = $id;
            $campaingUserModel->user_id = $userInvitedId;
            try {
                $campaingUserModel->save();
                return $this->responseJson(true, $campaingUserModel);
            } catch (\Exception $e) {
                return $this->responseJson(false, [], 'This email already has an invitation or is already in this Campaign');
            }
        }
        return $this->responseJson(false, [], 'Only the Master of the Dungeon can invite people to the Campaign');
    }

    /**
     * @param Campaign $campaign
     * @param $userId
     * @return bool
     */
    private function validUserMester(Campaign $campaign, $userId)
    {
        return ($campaign->user_id == $userId) ? true : false;
    }
}
