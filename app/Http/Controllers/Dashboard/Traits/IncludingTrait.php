<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Including;

trait IncludingTrait
{

    public function store_including($ar_content, $en_content, $id, $namespace, $type)
    {
        Including::create([
            'ar' => [
                'name' => $ar_content
            ],
            'en' => [
                'name' => $en_content
            ]
            ,
            'type' => $type,
            'includable_id' => $id,
            'includable_type' => $namespace,
        ]);
    }//END OF store_including

    public function update_including($model, $ar_con_inc, $en_con_inc, $ar_con_exc, $en_con_exc)
    {
        foreach ($model->includes as $inc) {
            if ($inc->type === 0) {
                $inc->update(
                    [
                        'ar' => [
                            'name' => $ar_con_exc
                        ],
                        'en' => [
                            'name' => $en_con_exc
                        ]
                    ]
                );
            }
            if ($inc->type === 1) {
                $inc->update(
                    [
                        'ar' => [
                            'name' => $ar_con_inc
                        ],
                        'en' => [
                            'name' => $en_con_inc
                        ]
                    ]
                );
            }
        }
    }

    public function delete_including($includes)
    {
        foreach ($includes as $inc) {
            $inc->delete();
        }
    }//END OF delete_including
}//END OF TRAIT
