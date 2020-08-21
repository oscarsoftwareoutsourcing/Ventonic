<?php

namespace App\Repositories;

use \Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class UploadRepository
{
    private $name;
    private $extension;
    private $stored;
    private $storedPath;
    private $allowed_upload = [];
    private $min_sizes = ['width' => '480', 'height' => '480'];
    private $max_sizes = ['width' => '1280', 'height' => '900'];
    private $error_msg = '';

    public function __construct()
    {
        //
    }

    public function upload(
        $file,
        $store,
        $originalName = false,
        $verifySize = false,
        $checkAllowed = false
    ) {
        if (!$file->getError()) {
            $this->extension = strtolower($file->getClientOriginalExtension());
            $this->name = ($originalName)?$file->getClientOriginalName():uniqid('', true) .
                                '.' . $this->extension;

            /** si esta configurada la opción de Amazon Web Sevice Storage */
            if (!empty(env('AWS_BUCKET', ''))) {
                $store = 's3';
                $this->name = auth()->user()->uuid . '/' . $this->name;
            }

            if (in_array($this->extension, $this->allowed_upload) || !$checkAllowed) {
                if ($verifySize == true && !$this->verifySize($file)) {
                    $this->error_msg = __(
                        'El archivo debe tener al menos :minwidth px X :minheight , ' .
                        'y no debe ser mayor a :maxwidth px X :maxheight px',
                        [
                            'minwidth' => $this->min_sizes['width'],
                            'minheight' => $this->min_sizes['height'],
                            'maxwidth' => $this->max_sizes['width'],
                            'maxheight' => $this->max_sizes['height']
                        ]
                    );
                } else {
                    $upload = Storage::disk($store)->put($this->name, File::get($file));
                    if ($upload) {
                        //$this->stored = 'storage/files/'. $this->name;
                        $this->stored = 'storage/'. $store . '/' . $this->name;
                        $this->storedPath = config('filesystems.disks.' . $store . '.root') . '/' . $this->name;

                        /** si esta configurada la opción de Amazon Web Sevice Storage */
                        if (!empty(env('AWS_BUCKET', ''))) {
                            $this->stored = Storage::disk('s3')->url($this->name);
                            $this->storedPath = $upload;
                        }

                        return true;
                    } else {
                        $this->error_msg = __('Error al subir el archivo, verifique e intente de nuevo');
                    }
                }
            } else {
                $this->error_msg = __('La extensión del archivo es inválida. Verifique e intente nuevamente');
            }
        } else {
            $this->error_msg = __(
                'Error al procesar el archivo. Verifique que este correcto y ' .
                'sea del tamaño permitido e intente nuevamente'
            );
        }
        session()->flash('message', [
            'type' => 'other', 'class' => 'warning', 'title' => __('Alerta!'), 'msg' => $this->error_msg
        ]);
        return false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getErrorMessage()
    {
        return $this->error_msg;
    }

    public function getStored()
    {
        return $this->stored;
    }

    public function getStoredPath()
    {
        return $this->storedPath;
    }

    public function delete($file, $store)
    {
        if (Storage::disk($store)->exists($file)) {
            Storage::disk($store)->delete($file);
        }
    }

    public function verifySize($file)
    {
        $size = getimagesize($file);
        $min_width = $this->min_sizes['width'];
        $min_height = $this->min_sizes['height'];
        $max_width = $this->max_sizes['width'];
        $max_height = $this->max_sizes['height'];
        return ($size[0]>=$min_width && $size[1]>=$min_height && $size[0]<=$max_width && $size[1]<=$max_height);
    }
}
