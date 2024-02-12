<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists();
            return '';
            break;
            default : 
            return inertia('Modules/Utility/Backups/Index');
        }
    }
    

    public function create()
    {
        $data = Artisan::call('backup:run');
        
        if($data == 0){
            return back()->with([
                'message' => 'Backup was successfully. Thanks',
                'data' => '',
                'type' => 'bxs-check-circle',
                'color' => 'success'
            ]); 
        }else{

        }
    }

    public function lists(){
        $files = Storage::files('Laravel');

        $fileDetails = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'path' => $file,
                // 'url' => route('file.show', ['filename' => basename($file)]),
                'date' => Carbon::createFromTimestamp(Storage::lastModified($file))->toDateTimeString(),
            ];
        });

        return $fileDetails->toJson();
    }

    public function download($filename)
    {
        $filePath = '/app/Laravel/' . $filename;

        return $this->streamFile($filePath);
    }

    private function streamFile($filePath)
    {
        return new StreamedResponse(function () use ($filePath) {
            $stream = fopen(storage_path($filePath), 'rb');

            while (!feof($stream)) {
                echo fread($stream, 1024);
            }

            fclose($stream);
        }, 200, [
            'Content-Type' => mime_content_type(storage_path($filePath)),
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ]);
    }
}
