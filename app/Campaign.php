<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campaign extends Model
{
    public function getCampaingsByUser($userId)
    {
        $result = DB::table('campaigns AS c')
            ->leftJoin('campaign_users AS cu', 'c.id', '=', 'cu.campaign_id')
            ->join('users AS u', 'u.id', '=', 'c.user_id')
            ->where('c.user_id', $userId)
            ->orWhere('cu.user_id', $userId)
            ->select('c.*', 'u.email', 'u.name AS userName')
            ->get();

        return $result;
    }
}
