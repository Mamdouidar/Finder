<?php

namespace App\Http\Controllers;

use App\Http\Resources\AiResource;
use App\Models\Ai;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AiController extends Controller
{
    public function index()
    {
        //return AiResource::collection(Ai::all());
        $python =  "C:\Users\mamdo\AppData\Local\Programs\Python\Python39\python";
        $path = app_path(). "\http\controllers\main.py";

        $result = shell_exec($python." ".$path);
        //$result = "python ". $path;

        var_dump($result);
    }

    public function store(Request $request)
    {
        $python =  "C:\Users\mamdo\AppData\Local\Programs\Python\Python39\python";
        $path = app_path(). "\http\controllers\main.py";

        $attributes = $request->validate([
            'image' => ['required', 'image']
        ]);

        $file = $request->file('image');
        $name = '/images/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['image'] = $name;

        Ai::create($attributes);

        $result = shell_exec($python." ".$path . escapeshellarg(" "));

        //sleep(30);

        return response()->json([
            'result' => $result
        ]);
        
        /*
        $process = new Process(['C:\Users\mamdo\AppData\Local\Programs\Python\Python39\python', 'P:/finder/sourcecode/main.py']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output_data = $process->mustRun()->getOutput();

        return response()->json([
            'result' => $output_data
        ]); 
        */
    }
}
