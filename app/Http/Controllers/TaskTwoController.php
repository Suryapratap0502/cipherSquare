<?php

namespace App\Http\Controllers;

use App\Models\TaskTwoModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TaskTwoController extends Controller
{
    public function index()
    {
        $data['coloumn_two'] = TaskTwoModel::all();
        $data['coloumn_name'] = Schema::getColumnListing('task_two');
        $columnCount = Schema::getColumnListing('task_two');

        $arr = array('id', 'updated_at', 'created_at');
        foreach ($columnCount as $key => $val) {
            if (in_array($val, $arr)) {
                if (($key = array_search($val, $columnCount)) !== false) {
                    unset($columnCount[$key]);
                }
            }
        }

        $data['finel_count'] = count($columnCount);
        $data['columnCount'] = $columnCount;
        return view('task_two/index', $data);
    }
    // Add Column
    public function add_coloumn(Request $request)
    {
        $coloumn_name = $request->coloumn_name;
        Schema::table('task_two', function (Blueprint $table) use ($coloumn_name) {
            $table->integer($coloumn_name)->default(0);
        });
    }
    // Update Row Data
    public function update(Request $request)
    {
        $columns = $request->column_name;
        $rows = $request->row_id;
        if (!empty($rows)) {
            foreach ($rows as $values) {
                $data = [];
                for ($y = 1; $y <= count($columns); $y++) {

                    $text = 'row_' . $values . "_" . $columns[$y - 1];

                    $data[$columns[$y - 1]] = $request->$text;
                }

                $response = TaskTwoModel::where('id', $values)->update($data);
                
            }
            if ($response) {
                return response()->json(['code' => 200, 'message' => 'Data Updated']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Data Not Updated']);
            }
        } else {
            return response()->json(['code' => 400, 'message' => 'Something Went Wrong']);
        }
    }
}
