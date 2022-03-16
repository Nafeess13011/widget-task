<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::all();
        $i = 0;
        $res = array();
        foreach ($data as $row)
        {
            $res[$i]['id'] = $row->id;
            $res[$i]['seqno'] = $i + 1;
            $res[$i]['pack_size'] = $row->pack_size;

            $i++;
            # code...
            
        }
        $data['result'] = $res;
        return view('homepage', $data);
    }
    public function add_pack(Request $request, $id = "")
    {
        if ($id > 0)
        {
            $model = Task::where(['id' => $id])->get();
            $res = array();
            foreach ($model as $row)
            {
                $res['id'] = $row->id;
                $res['pack_size'] = $row->pack_size;

                $res['page_title'] = 'Edit Pack';
                # code...
                
            }
        }
        else
        {

            $res['id'] = 0;
            $res['pack_size'] = '';
            $res['page_title'] = 'Add Pack';
        }

        $data['result'] = $res;
        return view('add_pack', $data);
    }
    public function pack_add_process(Request $request)
    {

        $request->validate(['pack_size' => 'required']);

        if ($request->post('pack_id') > 0)
        {
            $model = Task::find($request->post('pack_id'));
            $request->session()
                ->flash('pack_add_success', 'Pack updated successfully');
        }
        else
        {

            $model = new Task();
            $request->session()
                ->flash('pack_add_success', 'Pack add successfully');
        }
        $model->pack_size = $request->post('pack_size');
        $model->save();

        return redirect('index');

    }
    public function openprocessorder()
    {
        return view("processorder");
    }
    public function processOrder(Request $request)
    {
        $validation = Validator::make($request->all() , ['widgets' => 'required']);

        if ($validation->fails())
        {
            $res['flag'] = false;
            $res['message'] = false;
        }
        else
        {
            $packsRes = Task::orderBy('pack_size', 'ASC')->get();
            $pack = array();
            $requestedWidgets = $request->post('widgets');
            foreach ($packsRes as $packs)
            {
                $pack[] = $packs;
            }
            $processedArray = array();
            $remaining = $requestedWidgets;
            do
            {
                //$pack = getArrayofRows($conn);
                $retainId = $pack[0]['id'];
                $retain = $pack[0]['pack_size'];
                for ($i = 0;$i < count($pack);$i++)
                {

                    if ($pack[$i]['pack_size'] >= $remaining)
                    {
                        if ($pack[$i]['pack_size'] > $remaining && $i != 0)
                        {
                            $retainId = $pack[$i - 1]['id'];
                            $retain = $pack[$i - 1]['pack_size'];
                        }
                        else
                        {
                            $retainId = $pack[$i]['id'];
                            $retain = $pack[$i]['pack_size'];
                        }
                        break;
                    }
                    else
                    {
                        $retainId = $pack[$i]['id'];
                        $retain = $pack[$i]['pack_size'];
                    }
                }
                $remaining = $remaining - $retain;
                $processedArray[] = array(
                    'id' => $retainId,
                    'size_alotted' => $retain,
                    'remaining' => $remaining
                );
                //processRequest($ourPacks,$requestedWidgets);
                
            }
            while ($remaining > 0);
            //print_r($processedArray);
            $target_column = array_column($processedArray, 'size_alotted');
            $occrncs = array_diff(array_count_values($target_column) , ['size_alotted']);
            $i = 0;
            $final = null;
            foreach ($occrncs as $key => $value)
            {
                $final[$i]['pack_size'] = $key;
                $final[$i]['size'] = $value;
                $i++;
            }
            $res['flag'] = true;
            $res['total_occurrences'] = $final;
        }
        echo json_encode($res);
    }

    public function delete(Request $request, $id)
    {
        Task::find($id)->delete();
        $request->session()
            ->flash('pack_add_success', "Pack deleted successfully");
        return redirect('index');
    }
}

