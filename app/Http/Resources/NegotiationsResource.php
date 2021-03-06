<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NegotiationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // Editable Data
            'id' => $this->id,
            'active' => $this->active,
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
            'contact' => $this->contact,
            'created_at' => $this->created_at,
            'deadline' => $this->deadline,
            'type' => $this->type,
            'status' => $this->status,
            'neg_process_id' => $this->neg_process_id,
            'updated_at' => $this->updated_at,
            'groups' => getGroups($this->related_users),
            // Render Data
            'extras' => [
                'sharedWith' => getSharedUsers($this->related_users),
            ],
            'owner' => $this->user,
            'commission_type' => $this->commission_type,
            'commission_amount' => $this->commission_amount,
        ];
    }
}

function getSharedUsers($arr)
{
    $finalArr = [];
    foreach ($arr as $a) {
        $newArr = [];
        $newArr['id'] = $a['id'];
        $newArr['email'] = $a['email'];
        $newArr['name'] = $a['name'];
        $newArr['last_name'] = $a['last_name'];
        $newArr['related_groups'] = $a['related_groups'];

        array_push($finalArr, $newArr);
    }

    return $finalArr;
}

function getGroups($arr)
{
    $finalArr = [];
    foreach ($arr as $a) {
        foreach ($a['related_groups'] as $g) {
            array_push($finalArr, $g['group_id']);
        }
    }

    return array_unique($finalArr);
}
