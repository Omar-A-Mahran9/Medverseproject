<?php

namespace App\Http\Resources;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class eventsResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allevent=Events::latest()->get();
        return [
            'id' => $this->id,
            'coursetitle'=> $this->eventname,
            'CarName'=>$this->eventdate,
            'main_title' => $this->eventlink,
            'description'=>  $this->eventlocation ,
            'publish_date'=>$this->created_at->format('Y-m-d '),
            'courseImg'=>$this->image,
        ];
        {
            //     coursetitle: "Course1",
            //     category: "Popular",
            //     courseImg: "courses.svg",
            //     instructorDetails: {
            //         image: "Ellipse.svg",
            //         instructorname: "Dianne Russell",
            //         instructortitle: "Manchester, Kentucky",
            //     },
            // },
 }
}
}