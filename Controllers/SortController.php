<?php

namespace Vitlabs\OrderableModel\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Serenity\District;

class SortController extends Controller
{
    public function saveSort(Request $request)
    {
        // Get input data
        $model = $request->input('model');
        $old = $request->input('oldIDs');
        $new = $request->input('newIDs');

        // Does model exist ?
        if ( ! class_exists($model))
        {
            return $this->error("Model class [$model] does not exist.");
        }

        // Is model orderable ?
        if ( ! (with(new \ReflectionClass($model))->implementsInterface('Vitlabs\OrderableModel\Contracts\OrderableModelContract')))
        {
            return $this->error("Model [$model] must implements interface Vitlabs\OrderableModel\Contracts\OrderableModelContract.");
        }

        // Check if counts equals each other
        if(($count = count((array)$old)) != count((array)$new))
        {
            return $this->error('Counts of "old" and "new" arrays do not equal.');
        }

        // Get order column name
        $columnName = $model::getOrderColumnName();

        // Let's sort ...
        DB::transaction(function() use ($model, $old, $new, $count, $columnName)
        {
            // Old orders
            $orders = [];

            // Retrieve entities
            $entities = $model::findMany($old);

            // Save old orders
            foreach ($entities as $key => $entity)
            {
                $orders[$key] = $entity->{$columnName};
            }

            // Set new order
            foreach ($new as $key => $id)
            {
                // Get entity
                $entity = $entities->find($id);

                // Set new order
                $entity->{$columnName} = $orders[$key];

                // Save entity
                $entity->save();
            }
        });

        // Sorting success
        return $this->success();
    }

    protected function error($message = '')
    {
        return [
            'result' => false,
            'message' => $message
        ];
    }

    protected function success()
    {
        return [
            'result' => true
        ];
    }
}
